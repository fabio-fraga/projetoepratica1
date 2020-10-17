<?php

session_start();

define('RANDOM', rand(1000, 10000));

$_SESSION['conf'] = RANDOM; 

echo 'Código: ' . RANDOM . PHP_EOL;

include 'enviar_email.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Confirmação de Conta</title>
</head>
<body>

    <h1>Fórum For All</h1>

    <h2>Confirmar conta:</h2>

    <ul>
        <li>ID: <strong><?= $nome ?></strong></li>
        <li>E-mail: <strong><?= $email ?></strong></li>
        <li>Senha: <strong><?= $senha ?></strong></li>

        <form action="cad_conf_validacao.php" method="POST">

              <legend>Digite o código enviado para o seu e-mail:</legend>
                <input type="number" name="codigo" placeholder="Código">
                <input type="submit" value="Confirmar"> 

        </form>
   </ul>

</body>
</html>
