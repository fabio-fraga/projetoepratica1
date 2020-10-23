<?php

session_start();

include 'bd.php';
$men_erro =".";

$email = $_POST['email'];
$senha = sha1($_POST['senha']);
$stmt = $pdo->prepare("
	SELECT * FROM USERS
	WHERE US_EMAIL = ? AND US_PASSW = ?
");

$stmt->execute([$email, $senha]);

$linhas = $stmt->fetchAll();



if(sizeof($linhas) == 0){
	if($email != $linhas[0]['US_EMAIL'] || $senha != $linhas[0]['US_PASSW']){
	
	$men_erro = "Email ou senha inválidos!";
	include 'login.php';
}
}
else{

$_SESSION['login'] = $linhas[0]['US_ID'];

header('location: home.php');
}

?>