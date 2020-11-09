<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fórum For All - Página Inicial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'templates/header.php'; ?>

</head>

<body>

<main>
    
    <h1 class="text-center mx-5 mb-3">Ficou em dúvida sobre como responder determinada questão? Faça login para criar tópicos, responder perguntas e interagir com a comunidade do Fórum For All!</h1>       
    
    <div class="container mb-2">
    
        <form class="form-signin text-center border border-light p-5" action="login_validacao.php" method="POST">

            <p class="h4 mb-4">Login</p>

            <input type="text" name="login_user" placeholder="Digite seu nome de usuário ou e-mail:" class="form-control mb-4">
            <input type="password" name="senha" placeholder="Digite sua senha:" class="form-control mb-4">

            <p class="text-danger"><strong><?=$men_erro?></strong></p>

            <input class="btn btn-primary" type="submit" value="Entrar">

            </form>
   
        </div>
    
    <h1 class="text-center">Não possui uma conta? <a href="cadastro.php">Cadastre-se</a>!</h1>   

    </div>

</main>

</body>

<?php

include 'templates/footer.php';

?>