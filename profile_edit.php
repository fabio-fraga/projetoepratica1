<?php 

session_start();

include 'bd.php';

$nome = $_POST['name'];
$email = $_POST['email'];
$linkedin = $_POST['linkedin'];
$github = $_POST['github'];
$nascimento = $_POST['birth'];
$descricao = $_POST['description'];
$senha = $_POST['passw'];

$stmt = $pdo->prepare("
  UPDATE USERS
  SET
  US_NAME = ?,
  US_EMAIL = ?,
  US_LINKEDIN = ?,
  US_GITHUB = ?,
  US_BIRTH = ?,
  US_DESCRIPTION = ?,
  US_PASSW = ?
  WHERE US_ID = ?
");

$stmt->execute([$nome, $email, $linkedin, $github, $nascimento, $descricao, $senha, $_SESSION['login']]);

header('location: profile.php');

?>