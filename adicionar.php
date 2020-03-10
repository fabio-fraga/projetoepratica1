<link rel="stylesheet" type="text/css" href="css-adicionar.css">

<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$validaremail = explode('@', $email);
$errodepreenchimento = 0;
$errodeemail = 0;
?>

<?php if (empty($nome) || empty($email)): ?>
   <?php $errodepreenchimento = 1; ?>
   <?php include 'paginainicial.html' ?>
   <div id="erro"><p>Preencha todos os campos!</p></div>
<?php endif ?>

<?php if ($validaremail[1] != 'discente.ifpe.edu.br' && $validaremail[1] != 'igarassu.ifpe.edu.br'): ?>
  <?php $errodeemail = 1; ?>
<?php endif ?>

<?php if ($errodeemail == 1 && $errodepreenchimento == 0): ?> 
   <?php include 'paginainicial.html' ?>
   <div id="erro"><p>É necessário que você possua um e-mail institucional!</p></div>
<?php endif ?>

<?php if ($validaremail[1] == 'discente.ifpe.edu.br' || $validaremail[1] == 'igarassu.ifpe.edu.br'): ?>
  <?php $errodeemail = 0; ?>
<?php endif ?>

<?php if ($errodepreenchimento == 0 && $errodeemail == 0): ?>
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
