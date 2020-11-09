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

  <main>

      <div class="container mt-n3 mb-3 shadow border border-light rounded">
        <form method="POST" action="cad_conf_validacao.php" class="text-center mt-n3 mb-3">
          <div class="row justify-content-center mt-5">
            <div class="col-12 pb-3">
              <h2 class=" text-center">
                <strong>Para confirmar o cadastro, digite o código que foi enviado para o seu e-mail!</strong>
              </h2>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-11 text-center mt-n2 pb-3">
                <strong>Nome de usuário: </strong><?= $nome ?>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-11 text-center mt-n2 pb-3">
                <strong>E-mail: </strong><?= $email ?>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-11 pb-3">
              <input type="number" class="form-control text-center" name="codigo" placeholder="Insira seu código aqui:" style="resize: none" value="<?= $_POST['title'] ?? '' ?>">
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-11 text-center mt-n2 pb-3">
              <p class="text-danger">
                <strong><?= $conf_erro ?>
              </strong></p>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-11 text-center mt-n4 pb-3">
              <input type="submit" value="Confirmar" class="btn btn-primary">
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-11 text-center mt-n2 pb-3">
                <strong>Após inserir o código correto, você será direcionado para a página de login!</strong>
            </div>
          </div>

        </form>
      </div>
  
  </main>

<?php include 'templates/footer.php'; ?>

</body>

</html>
