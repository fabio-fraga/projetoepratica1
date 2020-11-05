<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Página de Confirmação de Conta</title>
  <link rel="stylesheet" type="text/css" href="styles/main.css">
  <link rel="shortcut icon" href="img/favicon.ico"/>

  <?php include 'templates/header.php'; ?>
</head>

<body>


    <div class="container w-50 mb-5" id="div-principal-confirmacao-cadastro">
    

    <div class="text-center mb-3" id="div-lista-confirmacao">
    <h1 id="titulo-confirmacao">Confirmar conta:</h1>    
    <ul class="list-group">
        <li class="list-group-item">ID: <strong><?= $nome ?></strong></li>
        <li class="list-group-item">E-mail: <strong><?= $email ?></strong></li>
       
     </ul>
     </div>

       <div class="text-center mb-2" id="div-form-confirmacao">
        <form action="cad_conf_validacao.php" method="POST">
            <legend> <strong>Digite o código enviado para o seu e-mail:</strong></legend>
            <input type="number" name="codigo" id="codigo" placeholder="Código">
            <p class="text-danger mt-2"><strong><?=$conf_erro?></strong></p>
            <input class="btn btn-primary" type="submit" value="Confirmar"> 
        </form>
       </div>
  
   </div>
<?php 

include 'templates/footer.php';

?>
