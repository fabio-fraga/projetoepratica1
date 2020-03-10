<link rel="stylesheet" type="text/css" href="css-adicionar.css">

<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$validaremail = explode('@', $email);
$errodepreenchimento = 0;
$errodeemail = 0;
$errodenome = 0;
?>

<?php if (empty($nome) || empty($email)): ?>
   <?php $errodepreenchimento = 1; ?>
   <?php include 'paginainicial.html' ?>
   <div id="erro">Preencha todos os campos!</div>
<?php endif ?>

<?php if ($validaremail[1] != 'discente.ifpe.edu.br' && $validaremail[1] != 'igarassu.ifpe.edu.br'): ?>
  <?php $errodeemail = 1; ?>
<?php endif ?>

<?php if (preg_match("/([a-zA-ZÁ-Úá-ú ]+)/", $nome) == false && $errodepreenchimento == 0 && $errodeemail == 0): ?>
  <?php $errodenome = 1; ?>
  <?php include 'paginainicial.html' ?>
  <div id="erro">Nenhum caractere especial ou número pode ser usado no campo de nome!</div>
<?php endif ?>

<?php if ($errodeemail == 1 && $errodepreenchimento == 0 && $errodenome == 0): ?> 
   <?php include 'paginainicial.html' ?>
   <div id="erro">É necessário que você possua um e-mail institucional!</div>
<?php endif ?>

<?php if ($validaremail[1] == 'discente.ifpe.edu.br' || $validaremail[1] == 'igarassu.ifpe.edu.br'): ?>
  <?php $errodeemail = 0; ?>
<?php endif ?>

<?php if ($errodepreenchimento == 0 && $errodeemail == 0 && $errodenome == 0): ?>
   <h3>Confirmar conta:</h3>
   <ul>
        <li>Nome: <strong><?= $nome ?></strong></li>
        <li>E-mail: <strong><?= $email ?></strong></li>
        <form>
          <fieldset>
              <legend>Digite o código enviado para o seu e-mail:</legend>
                <input type="text" name="codigo" placeholder="Código">
                <input type="submit" value="Confirmar"> 
            </fieldset>
        </form>
   </ul>
<?php endif ?>
