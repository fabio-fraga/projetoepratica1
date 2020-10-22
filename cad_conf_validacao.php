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

    echo "Conta Confirmada!";

    unset($_SESSION['codigo']);
    unset($_SESSION['login']);
    unset($_SESSION['nome']);
  	unset($_SESSION['email']);
  	unset($_SESSION['linkedin']);
  	unset($_SESSION['github']);
  	unset($_SESSION['birth']);
  	unset($_SESSION['senha']);
    
} else {
    echo "Código incorreto!";
}

?>
