<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Editar Perfil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php 
  include 'templates/header.php';
  ?>

</head>

<?php 

include 'bd.php';

$stmt = $pdo->prepare("
  SELECT * FROM USERS
  WHERE US_ID = ?
");

$stmt->execute([$_SESSION['login']]);

$consulta = $stmt->fetchAll();

?>

<body>
  <main>
    
  <div">

    <div">

        <?php if($_SESSION['login'] == $consulta[0]['US_ID']): ?>

          <form enctype="multipart/form-data" method="POST" action="profile_edit.php">
              <h1>Editar Informações</h1>

              <?php if ($consulta[0]['US_IMAGE'] == null): ?>                
                <svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-person-circle d-block m-auto" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                  <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                  <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                </svg>
              <?php else: ?>
                <img src="<?= $consulta[0]['US_IMAGE'] ?>">
              <?php endif ?>
              <input type="text" name="linkedin" placeholder="LinkedIn"value="<?= $consulta[0]['US_LINKEDIN'] ?>">
              <input type="text" name="github" placeholder="GitHub"value="<?= $consulta[0]['US_GITHUB'] ?>">
              <input type="date" name="birth" placeholder="Nascimento"value="<?= $consulta[0]['US_BIRTH'] ?>">
              <input type="text" name="description" placeholder="Descrição"value="<?= $consulta[0]['US_DESCRIPTION'] ?>">
              <p><?= $report_erro ?></p>
              <input type="file" name="image">
              <input type="submit" value="Alterar">
          </form>

        <?php endif ?>

    </div>

  </div>

  </main>
<?php

include 'templates/footer.php';

?>

</body>

</html>