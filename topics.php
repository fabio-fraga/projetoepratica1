<?php

session_start();

use League\CommonMark\GithubFlavoredMarkdownConverter;

require 'vendor/autoload.php';

session_start();

include 'bd.php';

$subject = $_POST['subject'];
$title = htmlentities($_POST['title']);
$date = date("Y-m-d H:i:s");
$date_save = $date;
$user = $_SESSION['login'];
$img_nome = $_FILES['img']['name'];

$erro_campos = false;
$erro_caracteres_title = false;
$erro_type_img = false;
$report_erro = '';

$converter = new GithubFlavoredMarkdownConverter([
    'html_input' => 'strip',
    'allow_unsafe_links' => false,
]);

$subject = $converter->convertToHtml($subject);

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

if (empty($title) || empty_text($title) || empty($subject) || empty_text($subject)) {
	$erro_campos = true;
	$report_erro = 'Preencha todos os campos obrigatórios!';
  include 'home.php';
}

if (strlen($title) > 255 && $erro_campos == false) {
	$erro_caracteres_title = true;
	$report_erro = 'O título do tópico não pode conter mais de 255 caracteres!';
	include 'home.php';
}

if (substr($img_nome, -3) == 'png' && $erro_campos == false && $erro_caracteres_title == false) {
  $erro_type_img = false;
} elseif (substr($img_nome, -3) == 'jpg' && $erro_campos == false && $erro_caracteres_title == false) {
  $erro_type_img = false;
} elseif (substr($img_nome, -4) == 'jpeg' && $erro_campos == false && $erro_caracteres_title == false) {
  $erro_type_img = false;
} elseif (substr($img_nome, -4) == '' && $erro_campos == false && $erro_caracteres_title == false) {
  $erro_type_img = false;
} else {
  $erro_type_img = true;
  $report_erro = 'Formatos de imagens diferentes de PNG, JPG e JPEG não são permitidos!';
  include 'home.php';
}

if ($erro_campos == false && $erro_caracteres_title == false && $erro_type_img == false) {
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
		  INSERT INTO TOPICS(TOP_SUBJECT, TOP_TITLE, TOP_DATE, TOP_US_ID, TOP_IMAGE)
		  VALUES (?,?,?,?,?)
    ");

    $stmt->execute([$subject, $title, $date, $user, $img]);

  } else {
    $stmt = $pdo->prepare("
      INSERT INTO TOPICS(TOP_SUBJECT, TOP_TITLE, TOP_DATE, TOP_US_ID)
      VALUES (?,?,?,?)
    ");

    $stmt->execute([$subject, $title, $date, $user]);

  }

  unset($_POST);
  unset($_FILES);

  header('location: home.php');

}

?>
