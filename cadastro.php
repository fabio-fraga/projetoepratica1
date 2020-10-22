<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro</title>

<?php

include 'templates/header.php';

?>

    <div id="div-principal-cadastro">

        <h1 id="msg-boas-vindas">Ficou em dúvida sobre como responder determinada questão? Crie tópicos, responda perguntas e interaja com a comunidade do <span id="msg-forum">Fórum</span> <span id="msg-forall">For All</span> !</h1>
        
        <div id="div-form-cadastro">
            
        <form action="cad_validacao.php" method="POST">

            <h1 id="titulo-cadastro">Cadastro</h1>
            <input type="text" name="nome" placeholder="Nome de usuário - ID" id="input-nome">
            <input type="text" name="email" placeholder="Endereço de e-mail" class="inputs-form-cadastro">
            <input type="text" name="linkedin" placeholder="Endereço do seu LinkedIn" class="inputs-form-cadastro">
            <input type="text" name="github" placeholder="Endereço do seu GitHub" class="inputs-form-cadastro">
            <input type="date" name="birth" placeholder="Data do seu nascimento" class="inputs-form-cadastro">        
            <input type="password" name="senha" placeholder="Senha" class="inputs-form-cadastro"> 
            <input type="password" name="redigitar_senha" placeholder="Digite a senha novamente" class="inputs-form-cadastro">
            <input type="submit" value="Registrar" class="inputs-form-cadastro">

        </form>

        <p id="p-erro"><?=$report_erro?></p>
  
        </div>
    
        <h1 id="msg-para-login">Já possui uma conta? <a href="/">Faça login</a>!</h1>

    </div>
   
<?php 

include 'templates/footer.php';

?>
