 <?php 
session_start();
if(!isset($_SESSION['login'])){
header('location: home.php');
exit();
}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <title>Editar Perfil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
include 'templates/header.php';

?>

<body>
    
  <main>
<?php if($_SESSION['login'] == $consulta[0]['US_ID']): ?>

          <form enctype="multipart/form-data" method="POST" action="profile_edit.php">
<div class="container mt-3">
    
	<div class="row">
      <div class="col-md-3">
        <div class="text-center">

          <?php if ($consulta[0]['US_IMAGE'] == null): ?>                
                <svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-person-circle d-block m-auto" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                  <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                  <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                </svg>
              <?php else: ?>
                <img src="<?= $consulta[0]['US_IMAGE'] ?>" width="150" height="150" class="avatar img-circle">
              <?php endif ?>

          <h6>Nova foto de perfil</h6>
          
          <input type="file" class="form-control-file" name="image">
        </div>
      </div>
      
      <div class="col-md-9 personal-info" style="padding-left: 300px">
        <h3>Editar perfil</h3>
        
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Linkedin:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="linkedin" placeholder="LinkedIn" value="<?= $consulta[0]['US_LINKEDIN'] ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">GitHub:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="github" placeholder="GitHub" value="<?= $consulta[0]['US_GITHUB'] ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Data de Nascimento:</label>
            <div class="col-lg-8">
              <input class="form-control" type="date"  placeholder="Data de Nascimento" name="birth" placeholder="Nascimento" value="<?= $consulta[0]['US_BIRTH'] ?>">
            </div>
            <div class="form-group">
            <label class="col-lg-3 control-label">Descrição:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" placeholder="Descrição" name="description" value="<?= $consulta[0]['US_DESCRIPTION'] ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Salvar">
              <span></span>
              <a href="/my_profile.php?id=<?=$consulta[0]['US_ID']?>" class="btn btn-default">Cancelar</a>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
</form>
<?php endif ?>

    
    
  </main>


<?php

include 'templates/footer.php';

?>
</body>
</html>