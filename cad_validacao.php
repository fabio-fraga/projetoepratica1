 <?php

include 'bd.php';

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
$conf_erro='';

function empty_name ($string) {
  $array = str_split($string);
  $cont = 0;
  for ($i = 0; $i < sizeof($array); $i++) {
    if ($array[$i] == ' ') {
      $cont++;
    }
  }
  if ($cont == sizeof($array)) {
    return false;
  }
  return true;
}

if (empty($nome) || empty_name($nome) == false || empty($email) || empty($birth) || empty($senha) || empty($conf_senha)) {
  $erro_campos = true;
  $report_erro = 'Preencha todos os campos!';  
  include 'cadastro.php';
}

if (preg_match("/^[a-zA-Zá-úÁ-Úç ]+$/", $nome) == false) {
  if ($erro_campos == false) {
    $erro_nome = true;
    $report_erro = 'Caracteres especiais não podem ser utilizados no campo de ID!';  
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

$stmt = $pdo->prepare("
  SELECT * FROM USERS
  WHERE US_EMAIL = ? OR US_NAME = ?
");

$stmt->execute([$email, $nome]);


$linhas = $stmt->fetchAll();



  if($email == $linhas[0]['US_EMAIL']){
    if ($erro_campos == false && $erro_nome == false){
      $erro_email = true;
      $report_erro ="E-mail já cadastrado!";
      include'cadastro.php';
    }
  }
if($nome == $linhas[0]['US_NAME']){
  if ($erro_campos == false && $erro_nome == false){
    $erro_nome = true;
    $report_erro ="Usuario já cadastrado!";
    include'cadastro.php';
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