<?php 

session_start();

use League\CommonMark\GithubFlavoredMarkdownConverter;

require 'vendor/autoload.php';

$topic = $_POST['id_post'];
$us = $_POST['id_us'];
$discussao = 'discussao.php?id=' . $topic;

include 'bd.php';

$comentario = $_POST['comentario'];
$date = date("Y-m-d H:i:s");
$user = $_SESSION['login'];
$erro_campo = false;
$img_nome = $_FILES['img']['name'];
$erro_type_img = false;
$report_erro = '';

$converter = new GithubFlavoredMarkdownConverter([
    'html_input' => 'strip',
    'allow_unsafe_links' => false,
]);

$comentario = $converter->convertToHtml($comentario);

function empty_text ($string) {
  $array = str_split($string);
  $cont = 0;
  for ($i = 0; $i < sizeof($array); $i++) {
    if ($array[$i] == ' ') {
      $cont++;
    }
  }
  if ($cont == sizeof($array)) {
    return true;
  }
  return false;
}

if (empty($comentario) || empty_text($comentario)) {
	$erro_campo = true;
	$report_erro = 'Ops! Você não comentou nada.';
  	include ($discussao);
}

if (substr($img_nome, -3) == 'png' && $erro_campo == false) {
  $erro_type_img = false;
} elseif (substr($img_nome, -3) == 'jpg' && $erro_campo == false) {
  $erro_type_img = false;
} elseif (substr($img_nome, -4) == 'jpeg' && $erro_campo == false) {
  $erro_type_img = false;
} elseif (substr($img_nome, -4) == '' && $erro_campo == false) {
  $erro_type_img = false;
} else {
  $erro_type_img = true;
  $report_erro = 'Formatos de imagens diferentes de PNG, JPG e JPEG não são permitidos!';
  include ($discussao);
}

if ($erro_campo == false && $erro_type_img == false) {
	if (isset($_FILES['img'])) {


    if (!file_exists('upload/' . $_SESSION['login'])) {
      mkdir('upload/' . $_SESSION['login'], 0700, true);
    }
    if (strtolower(substr($_FILES['img']['name'], -4)) != '.jpg' && strtolower(substr($_FILES['img']['name'], -4)) != '.png') {
      $extensao = '.jpg';
    } else {
      $extensao = strtolower(substr($_FILES['img']['name'], -4));
    }

    $new_name = md5(time()) . $extensao;

    $img = 'upload/' . $_SESSION['login'] . '/' . $new_name;

    move_uploaded_file($_FILES['img']['tmp_name'], $img);

    $stmt = $pdo->prepare("
    	INSERT INTO COMMENTS(COM_CONTENT, COM_DATE, COM_US_ID, COM_TOP_ID, COM_IMAGE)
		VALUES (?,?,?,?,?)
	");

	$stmt->execute([$comentario, $date, $user, $topic, $img]);

  } else {
    $stmt = $pdo->prepare("
    	INSERT INTO COMMENTS(COM_CONTENT, COM_DATE, COM_US_ID, COM_TOP_ID)
		VALUES (?,?,?,?)
	");

	$stmt->execute([$comentario, $date, $user, $topic]);

  }
}



?>