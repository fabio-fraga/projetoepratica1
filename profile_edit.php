<?php 

session_start();

include 'bd.php';

$uploaddir = 'upload/';
$uploadfile = $uploaddir . $_FILES['image']['name'];

$nome = $_POST['name'];
$linkedin = $_POST['linkedin']; 
$github = $_POST['github'];
$nascimento = $_POST['birth'];
$descricao = $_POST['description'];

move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

$stmt = $pdo->prepare("
  UPDATE USERS
  SET
  US_NAME = ?,
  US_LINKEDIN = ?,
  US_GITHUB = ?,
  US_BIRTH = ?,
  US_DESCRIPTION = ?,
  US_IMAGE = ?
  WHERE US_ID = ?
");

$stmt->execute([$nome, $email, $linkedin, $github, $nascimento, $descricao, $senha, $uploadfile, $_SESSION['login']]);

header('location: profile.php');

?>