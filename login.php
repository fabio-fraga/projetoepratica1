<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fórum For All - Página Inicial</title>
</head>

<?php

include 'templates/header_comum.html';

?>

<div id="div-principal-login">

    <h1 id="msg-boas-vindas">Ficou em dúvida sobre como responder determinada questão? Crie tópicos, responda perguntas e interaja com a comunidade do <span id="msg-forum">Fórum</span> <span id="msg-forall">For All</span> !</h1>
        
    <div id="div-form-login">
        
        <form action="login_validacao.php" method="POST">

        <h1 id="titulo-login">Login</h1>
        <input type="text" name="email" placeholder="Endereço de e-mail" id="input-email"/> 
    	<br>
    	<br>		       										
        <input type="password" name="senha" placeholder="Senha" class="inputs-form-login"/>
        <br>
    	<br>
        <input type="submit" value="Entrar" class="inputs-form-login"/>
        </form>
        
    </div>
	<br>
    
    <h1 id="msg-cadastre-se">Não possui uma conta? <a href="cadastro.php">Cadastre-se</a>!</h1>

</div>

<?php

include 'templates/footer_comum.html';

?>