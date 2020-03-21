<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Página de Cadastro</title>
    <link href="css/home-cadastro.css" rel="stylesheet">
</head>

<?php

include 'templates/header_home-cadastro.html';

?>

<div id="div-principal-cadastro">

    <h1 id="msg-boas-vindas">Ficou em dúvida sobre como responder determinada questão? Crie tópicos, responda perguntas e interaja com a comunidade do <span>Fórum</span> <span id="forall">For All</span> !</h1>
        
    <div id="div-form-cadastro">
            
<form action="cadastro_validacao.php" method="POST">

    <h1 id="titulo-cadastro">Cadastro</h1>
    <input type="text" name="nome" placeholder="Nome de usuário - ID" id="input-nome"/>
    <input type="text" name="email" placeholder="Endereço de e-mail" class="inputs-form-cadastro"/>                
    <input type="password" name="senha" placeholder="Senha" class="inputs-form-cadastro"/> 
    <input type="password" name="redigitar_senha" placeholder="Digite a senha novamente" class="inputs-form-cadastro"/>
    <input type="submit" value="Registrar" class="inputs-form-cadastro"/>

</form>

    <p id="p-erro"><?=$report_erro?></p>

<br>
<br>
<br>
  
    </div>
    
<h1 id="msg-para-login">Já possui uma conta? <a href="/">Faça login</a>!</h1>

</div>
   
<?php 

include 'templates/footer_home-cadastro.html';

?>
