<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$conf_senha = $_POST['redigitar_senha'];

$erro_campos = false;
$erro_nome = false;
$erro_email = false;
$erro_senhas = false;
$tamanho_senha = false;
?>

<?php if (empty($nome) || empty($email) || empty($senha) || empty($conf_senha)): ?>
  <?php $erro_campos = true; ?>
  <?php include ('cadastro.html'); ?>  

  <div>
    <p>Preencha todos os campos!</p>
  </div>  

<?php endif ?>

<?php if (preg_match("/^[a-zç]+$/", $nome) == false): ?>
  <?php if ($erro_campos == false): ?>
    <?php $erro_nome = true; ?>
    <?php include ('cadastro.html'); ?>  

    <div>
      <p>Números, caracteres especiais, espaços, letras maiúsculas e letras acentuadas não podem ser utilizados no campo de ID!</p>
    </div>

    <?php endif ?>
<?php endif ?>

<?php if (strrpos($email, "@") == false): ?>
  <?php if ($erro_campos == false && $erro_nome == false): ?>
    <?php $erro_email = true; ?>
    <?php include ('cadastro.html'); ?>  

    <div>
      <p>Insira um e-mail válido!</p>
    </div>

    <?php endif ?>
<?php endif ?>

<?php if (strlen($senha) < 8 || strlen($senha) > 16): ?>
  <?php if ($erro_campos == false && $erro_nome == false && $erro_email == false): ?>
    <?php $tamanho_senha = true; ?>
    <?php include ('cadastro.html'); ?>
 
    <div>
      <p>A senha deve conter no mínimo 8 caracteres e no máximo 16!</p>
    </div>

  <?php endif ?>
<?php endif ?>

<?php if ($senha != $conf_senha): ?>
  <?php if ($erro_campos == false && $erro_nome == false && $erro_email == false && $tamanho_senha == false): ?>
    <?php $erro_senhas = true; ?>
    <?php include ('cadastro.html'); ?>

    <div>
      <p>As senhas não coincidem!</p>
    </div>

    <?php endif ?>
<?php endif ?>

<?php if ($erro_campos == false && $erro_nome == false && $erro_email == false && $erro_senhas == false && $tamanho_senha == false): ?>
  <?php include ('conf_cadastro.html'); ?>

<?php endif ?>
