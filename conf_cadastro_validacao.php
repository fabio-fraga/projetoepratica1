<?php

$codigo = $_POST['codigo'];
$chave = $_POST['chave'];

if ($codigo == $chave) {
	echo "Conta Confirmada!";
} else {
	echo "Código incorreto!";
}

?>