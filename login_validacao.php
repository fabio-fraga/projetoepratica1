<?php

session_start();

include 'bd.php';
$men_erro;

$login_user = $_POST['login_user'];
$senha = sha1($_POST['senha']);
$stmt = $pdo->prepare("
	SELECT * FROM USERS
	WHERE (US_EMAIL = ? OR US_NAME = ? ) AND US_PASSW = ?


");

$stmt->execute([$login_user, $login_user, $senha ]);

$linhas = $stmt->fetchAll();



if(sizeof($linhas) == 0){
	if($login_user != $linhas[0]['US_EMAIL'] || $login_user != $linhas[0]['US_NAME']  || $senha != $linhas[0]['US_PASSW']){
	
		$men_erro = "Email ou senha inválidos!";
		include 'login.php';

}
	}
	else{
		$_SESSION['login'] = $linhas[0]['US_ID'];

		header('location: home.php');	


	
}

?>
