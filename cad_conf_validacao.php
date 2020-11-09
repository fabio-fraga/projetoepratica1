<?php

session_start();

$codigo = $_POST['codigo'];

if ($codigo == $_SESSION['codigo']) {

  include 'bd.php';

  $stmt = $pdo->prepare("
  INSERT INTO USERS(US_NAME, US_EMAIL, US_LINKEDIN, US_GITHUB, US_BIRTH, US_PASSW)
  VALUES(?, ?, ?, ?, ?, ?)
  ");

  $senha = sha1($_SESSION['senha']);

  $stmt->execute([
  	$_SESSION['nome'],
  	$_SESSION['email'],
  	$_SESSION['linkedin'],
  	$_SESSION['github'],
  	$_SESSION['birth'],
    $senha
  		
  ]);

  unset($_SESSION['codigo']);
  unset($_SESSION['login']);
  unset($_SESSION['nome']);
  unset($_SESSION['email']);
  unset($_SESSION['linkedin']);
  unset($_SESSION['github']);
  unset($_SESSION['birth']);
  unset($_SESSION['senha']);

  header('location: login.php');
    
} else {
  
  $nome = $_SESSION['nome'];
  $email = $_SESSION['email'];
  $linkedin = $_SESSION['linkedin'];
  $github = $_SESSION['github'];
  $birth = $_SESSION['birth'];
  $senha = $_SESSION['senha'];
  $conf_erro = "Código incorreto! Por favor, verifique o código enviado para o email cadastrado.";

  include 'cad_confirmacao.php';
}

?>
