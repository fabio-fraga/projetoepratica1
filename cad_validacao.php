<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$conf_senha = $_POST['redigitar_senha'];

$erro_campos = false;
$erro_nome = false;
$erro_email = false;
$erro_senhas = false;
$tam_senha = false;
$tam_nome = false;
$report_erro = '';

?>

<?php if (empty($nome) || empty($email) || empty($senha) || empty($conf_senha)): ?>
  <?php $erro_campos = true; ?>
  <?php $report_erro = 'Preencha todos os campos!'; ?>  
  <?php include 'cadastro.php'; ?>

<?php endif ?>

<?php if (preg_match("/^[a-zA-Z0-9ç]+$/", $nome) == false): ?>
  <?php if ($erro_campos == false): ?>
    <?php $erro_nome = true; ?>
    <?php $report_erro = 'Caracteres especiais, espaços e letras acentuadas não podem ser utilizados no campo de ID!'; ?>  
    <?php include 'cadastro.php'; ?> 

    <?php endif ?>
<?php endif ?>

<?php if (strrpos($email, "@") == false): ?>
  <?php if ($erro_campos == false && $erro_nome == false): ?>
    <?php $erro_email = true; ?>
    <?php $report_erro = 'Insira um e-mail válido!'; ?>   
    <?php include 'cadastro.php'; ?>

    <?php endif ?>
<?php endif ?>

<?php if (strlen($nome) > 64): ?>
  <?php if ($erro_campos == false && $erro_nome == false && $erro_email == false): ?>
    <?php $tam_nome = true; ?>
    <?php $report_erro = 'O ID deve conter no máximo 64 caracteres!'; ?> 
    <?php include 'cadastro.php'; ?>
 
  <?php endif ?>
<?php endif ?>

<?php if (strlen($senha) < 8 || strlen($senha) > 16): ?>
  <?php if ($erro_campos == false && $erro_nome == false && $erro_email == false && $tam_nome == false): ?>
    <?php $tam_senha = true; ?>
    <?php $report_erro = 'A senha deve conter no mínimo 8 caracteres e no máximo 16!'; ?> 
    <?php include 'cadastro.php'; ?>
 
  <?php endif ?>
<?php endif ?>

<?php if ($senha != $conf_senha): ?>
  <?php if ($erro_campos == false && $erro_nome == false && $erro_email == false && $tam_nome == false && $tam_senha == false): ?>
    <?php $erro_senhas = true; ?>
    <?php $report_erro = 'As senhas não coincidem!'; ?> 
    <?php include 'cadastro.php'; ?>

    <?php endif ?>
<?php endif ?>

<?php if ($erro_campos == false && $erro_nome == false && $erro_email == false && $tam_nome == false && $tam_senha == false && $erro_senhas == false): ?>
  <?php include 'cad_confirmacao.php'; ?>

<?php endif ?>
