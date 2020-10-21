<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$linkedin = $_POST['linkedin'];
$github = $_POST['github'];
$birth = $_POST['birth'];
$senha = $_POST['senha'];
$conf_senha = $_POST['redigitar_senha'];

$erro_campos = false;
$erro_nome = false;
$erro_email = false;
$erro_senhas = false;
$tam_senha = false;
$tam_nome = false;
$report_erro = '';

if (!isset($nome) || !isset($email) || !isset($birth) || !isset($senha) || !isset($conf_senha)) {
  $erro_campos = true;
  $report_erro = 'Preencha todos os campos!';  
  include 'cadastro.php';
}

if (preg_match("/^[a-zA-Zá-úÁ-Úç ]+$/", $nome) == false) {
  if ($erro_campos == false) {
    $erro_nome = true;
    $report_erro = 'Caracteres especiais, espaços e letras acentuadas não podem ser utilizados no campo de ID!';  
    include 'cadastro.php'; 
  }
}

if (strrpos($email, "@") == false) {
  if ($erro_campos == false && $erro_nome == false) {
    $erro_email = true;
    $report_erro = 'Insira um e-mail válido!';   
    include 'cadastro.php';
  }
}

if (strlen($nome) > 64) {
  if ($erro_campos == false && $erro_nome == false && $erro_email == false) {
    $tam_nome = true;
    $report_erro = 'O ID deve conter no máximo 64 caracteres!'; 
    include 'cadastro.php';
  }
}

if (strlen($senha) < 8 || strlen($senha) > 16) {
  if ($erro_campos == false && $erro_nome == false && $erro_email == false && $tam_nome == false) {
    $tam_senha = true;
    $report_erro = 'A senha deve conter no mínimo 8 caracteres e no máximo 16!'; 
    include 'cadastro.php';
  }
}

if ($senha != $conf_senha) {
  if ($erro_campos == false && $erro_nome == false && $erro_email == false && $tam_nome == false && $tam_senha == false) {
    $erro_senhas = true;
    $report_erro = 'As senhas não coincidem!'; 
    include 'cadastro.php';
  }
}

if ($erro_campos == false && $erro_nome == false && $erro_email == false && $tam_nome == false && $tam_senha == false && $erro_senhas == false) {

  session_start();

  define('RANDOM', rand(1000, 10000));

  $_SESSION['codigo'] = RANDOM;

  $_SESSION['nome'] = $nome;
  $_SESSION['email'] = $email;
  $_SESSION['linkedin'] = $linkedin;
  $_SESSION['github'] = $github;
  $_SESSION['birth'] = $birth;
  $_SESSION['senha'] = $senha;

  echo 'Código: ' . RANDOM . PHP_EOL;

  include 'enviar_email.php';

  include 'cad_confirmacao.php';

}

?>