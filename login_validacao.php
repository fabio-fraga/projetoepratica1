<?php

session_start();

include 'bd.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $pdo->prepare("
	SELECT * FROM USERS
	WHERE US_EMAIL = ? AND US_PASSW = ?
");

$stmt->execute([$email, $senha]);

$linhas = $stmt->fetchAll();

if(sizeof($linhas) == 0){
	header('location: index.php');
}

$_SESSION['login'] = $linhas[0]['US_ID'];

header('location: home.php');

?>