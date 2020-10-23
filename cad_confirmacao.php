<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Página de Confirmação de Conta</title>
  <link rel="stylesheet" type="text/css" href="styles/main.css">
  <link rel="shortcut icon" href="img/favicon.ico"/>
</head>

<body>

  <header>
    <a href="/"><img src="img/Logo-Forum.png" id="logo"></a> 
        
      <form action="pesquisar.php" method="POST" id="form-pesquisa">
        <input type="text" name="pesquisar" placeholder="Clique aqui para pesquisar"/>
        <span></span>
      </form>

    <div id="div-opcoes">
      
      <ul id="ul-header">

        <?php if (isset($_SESSION['login'])): ?>
          <li class="li-header">
            <a href="logout.php" class="a-header">Sair</a></li>
          <li class="li-header"><a href="profile.php" class="a-header">Perfil</a></li>
        <?php else: ?>
          <li class="li-header"><a href="cadastro.php" class="a-header">Cadastrar</a></li>
          <li class="li-header"><a href="login.php" class="a-header">Login</a></li>
        <?php endif ?>

        <li class="li-header"><a href="sobre.php" class="a-header">Sobre</a></li>
        <li class="li-header"><a href="ajuda.php">Ajuda</a></li>
        <li class="li-header"><a href="https://github.com/FabioMouradeFraga/projetoepratica1" target="_blank" class="a-header">GitHub</a></li>
        <li class="li-header"><a href="/documentation/proposta _projeto_e_pratica_1_forum_ifpe.pdf" target="_blank">Documentação</a></li>

        </ul>

    </div>

  </header>

    <div id="div-principal-confirmacao-cadastro">
    

    <div id="div-lista-confirmacao">
    <h1 id="titulo-confirmacao">Confirmar conta:</h1>    
    <ul>
        <li>ID: <strong><?= $nome ?></strong></li>
        <li>E-mail: <strong><?= $email ?></strong></li>
        <li>LinkedIn: <strong><?= $linkedin ?></strong></li>
        <li>GitHub: <strong><?= $github ?></strong></li>
        <li>Nascimento: <strong><?= $birth ?></strong></li>
        <li>Senha: <strong><?= $senha ?></strong></li>
     </ul>
     </div>

       <div id="div-form-confirmacao">
        <form action="cad_conf_validacao.php" method="POST">
            <legend> <strong>Digite o código enviado para o seu e-mail:</strong></legend>
            <input type="number" name="codigo" id="codigo" placeholder="Código">
            <input type="submit" value="Confirmar"> 
        </form>
       </div>
  
   </div>
<?php 

include 'templates/footer.php';

?>
