<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Perfil</title>
  
<?php

include 'templates/header.php';
include 'bd.php';

$stmt = $pdo->prepare("
  SELECT * FROM USERS
  WHERE US_ID = ?
");

$stmt->execute([$_SESSION['login']]);

$consulta = $stmt->fetchAll();

?>

  <div id="div-principal-profile">

    <div id="div-form-profile">

      <?php for ($i = 0; $i < sizeof($consulta); $i++): ?>
        <?php if($_SESSION['login'] == $consulta[$i]['US_ID']): ?>

          <form method="POST" action="profile_edit.php">
              <h1 id="titulo-profile">Editar Informações</h1>
              <input class="inputs-form-profile" type="text" name="name" placeholder="Nome"value="<?= $consulta[$i]['US_NAME'] ?>">
              <input class="inputs-form-profile" type="text" name="email" placeholder="E-mail"value="<?= $consulta[$i]['US_EMAIL'] ?>">
              <input class="inputs-form-profile" type="text" name="linkedin" placeholder="LinkedIn"value="<?= $consulta[$i]['US_LINKEDIN'] ?>">
              <input class="inputs-form-profile" type="text" name="github" placeholder="GitHub"value="<?= $consulta[$i]['US_GITHUB'] ?>">
              <input class="inputs-form-profile" type="date" name="birth" placeholder="Nascimento"value="<?= $consulta[$i]['US_BIRTH'] ?>">
              <input class="inputs-form-profile" type="text" name="description" placeholder="Descrição"value="<?= $consulta[$i]['US_DESCRIPTION'] ?>">
              <input class="inputs-form-profile" type="text" name="passw" placeholder="Senha"value="<?= $consulta[$i]['US_PASSW'] ?>">
              <input class="inputs-form-profile" type="submit" value="Alterar">
          </form>

        <?php endif ?>
      <?php endfor?>

    </div>

  </div>

<?php

include 'templates/footer.php';

?>
