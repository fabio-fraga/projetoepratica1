<?php

session_start();

$codigo = $_POST['codigo'];

if ($codigo == $_SESSION['conf']) {
	echo "Conta Confirmada!";
	session_destroy($_SESSION['conf']);
} else {
	echo "Código incorreto!";
}

?>
