<?php

session_start();

$codigo = $_POST['codigo'];

if ($codigo == $_SESSION['codigo']) {

    include 'bd.php';

    $stmt = $pdo->prepare("
    INSERT INTO USERS(US_NAME, US_EMAIL, US_LINKEDIN, US_GITHUB, US_BIRTH, US_PASSW)
    VALUES(?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
    	$_SESSION['nome'],
  		$_SESSION['email'],
  		$_SESSION['linkedin'],
  		$_SESSION['github'],
  		$_SESSION['birth'],
  		$_SESSION['senha']
  	]);

    echo "Conta Confirmada!";

    session_destroy($_SESSION['codigo']);
    session_destroy($_SESSION['login']);
    session_destroy($_SESSION['nome']);
  	session_destroy($_SESSION['email']);
  	session_destroy($_SESSION['linkedin']);
  	session_destroy($_SESSION['github']);
  	session_destroy($_SESSION['birth']);
  	session_destroy($_SESSION['senha']);
    
} else {
    echo "Código incorreto!";
}

?>
