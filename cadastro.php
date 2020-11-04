<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php

include 'templates/header.php';

?>

</head>

<body>

    <main>

        <h1 class="text-center">Ficou em dúvida sobre como responder determinada questão? Cadastre-se para criar tópicos, responder perguntas e interagir com a comunidade do Fórum For All!</h1>

        <div class="container mb-2">

            <form class="form-signin text-center border border-light p-5" action="cad_validacao.php" method="POST">

                <p class="h4 mb-4">Cadastro</p>

                <input class="form-control mb-4" type="text" name="nome" placeholder="Nome de usuário" value="<?= $_POST['nome'] ?? '' ?>">
                <p class="text-danger text-left mt-n3 ml-1">(Campo obrigatório)</p>
                <input class="form-control mb-4" type="text" name="email" placeholder="Endereço de e-mail" value="<?= $_POST['email'] ?? '' ?>">
                <p class="text-danger text-left mt-n3 ml-1">(Campo obrigatório)</p>
                <input class="form-control mb-4" type="text" name="linkedin" placeholder="Endereço do seu LinkedIn" value="<?= $_POST['linkedin'] ?? '' ?>">
                <p class="text-left mt-n3 ml-1">(Campo opcional)</p>
                <input class="form-control mb-4" type="text" name="github" placeholder="Endereço do seu GitHub" value="<?= $_POST['github'] ?? '' ?>">
                <p class="text-left mt-n3 ml-1">(Campo opcional)</p>
                <input class="form-control mb-4" type="date" name="birth" placeholder="Data do seu nascimento" value="<?= $_POST['birth'] ?? '' ?>">
                <p class="text-danger text-left mt-n3 ml-1">(Campo obrigatório)</p>       
                <input class="form-control mb-4" type="password" name="senha" placeholder="Senha">
                <p class="text-danger text-left mt-n3 ml-1">(Campo obrigatório)</p>
                <input class="form-control mb-4" type="password" name="redigitar_senha" placeholder="Digite a senha novamente">
                <p class="text-danger text-left mt-n3 ml-1">(Campo obrigatório)</p>

                <p class="text-danger"><strong><?=$report_erro?></strong></p>

                <input class="btn btn-primary" type="submit" value="Registrar" class="inputs-form-cadastro">

            </form>

            </div>
    
            <h1 class="text-center">Já possui uma conta? <a href="/">Faça login</a>!</h1>

        </div>
   
    </main>

<?php 

include 'templates/footer.php';

?>

</body>
</html>