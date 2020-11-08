<?php 

session_start();

include 'bd.php';

$linkedin = $_POST['linkedin'];
$github = $_POST['github'];
$birth = $_POST['birth'];
$description = $_POST['description'];

$erro_campos = false;
$report_erro = '';

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

if (empty($birth) || empty_text($birth)) {
  $erro_campos = true;
  $report_erro = 'Preencha todos os campos obrigatórios!';  
  include 'profile.php';
}

if ($erro_campos == false) {

if (isset($_FILES['image']) && is_uploaded_file($_FILES["image"]["tmp_name"])) {

    if (!file_exists('upload/' . $_SESSION['login'])) { 
      mkdir('upload/' . $_SESSION['login'], 0700, true);
    }
    if (strtolower(substr($_FILES['image']['name'], -4)) != '.jpg' && strtolower(substr($_FILES['image']['name'], -4)) != '.png') {
      $extensao = '.jpg';
    } else {
      $extensao = strtolower(substr($_FILES['image']['name'], -4));
    }

    $new_name = md5(time()) . $extensao;

    $img = 'upload/' . $_SESSION['login'] . '/' . $new_name;

    move_uploaded_file($_FILES['image']['tmp_name'], $img);

	$stmt = $pdo->prepare("
  		UPDATE USERS
  		SET
  		US_LINKEDIN = ?,
  		US_GITHUB = ?,
  		US_BIRTH = ?,
  		US_DESCRIPTION = ?,
  		US_IMAGE = ?
  		WHERE US_ID = ?
	");

	$stmt->execute([$linkedin, $github, $birth, $description, $img, $_SESSION['login']]);

} else {
	$stmt = $pdo->prepare("
  		UPDATE USERS
  		SET
  		US_LINKEDIN = ?,
  		US_GITHUB = ?,
  		US_BIRTH = ?,
  		US_DESCRIPTION = ?,
  		WHERE US_ID = ?
	");


	$stmt->execute([$linkedin, $github, $birth, $description, $_SESSION['login']]);
}
	unset($_FILES);
	header('location: my_profile.php?id='.$_SESSION['login']);
}
?>
