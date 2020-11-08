


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Profile User</title>
<?php 
include 'templates/header.php'; 

include'bd.php';


?>
  <?php 
$stmt = $pdo->prepare("
   SELECT * FROM USERS LEFT JOIN TOPICS ON TOP_US_ID = US_ID WHERE US_ID = ? ORDER BY TOP_DATE DESC
    ");

    $stmt->execute([$_GET['id']]);

    $consulta = $stmt->fetchAll();
     ?>


<div class="container mt-5">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body mt-5">
                  <div class="d-flex flex-column align-items-center text-center">

                      <?php if ($consulta[0]['US_IMAGE'] == null): ?> 
                                  <img  src="upload/standard.png" class="rounded-circle" width="150" height="150">
                           <?php else: ?>

                           <img  src="<?= $consulta[0]['US_IMAGE'] ?>" class="rounded-circle" width="150" height="150">

                    <?php endif ?>

                    <div class="mt-3">
                      <h4><p class="text-primary mb-1"><?= $consulta[0]['US_DESCRIPTION'] ?></p></h4>
                      <?php if ($_SESSION['login'] == $_GET['id']): ?>

                      <p><a href="editprofile.php">Editar perfil</a></p>
                      <?php endif ?>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                    <span class="text-primary"><a href="<?= $consulta[0]['US_GITHUB'] ?>">Meu Github</a></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 26 26" width="24px" height="24px"><path d="M21.125,0H4.875C2.182,0,0,2.182,0,4.875v16.25C0,23.818,2.182,26,4.875,26h16.25 C23.818,26,26,23.818,26,21.125V4.875C26,2.182,23.818,0,21.125,0z M8.039,22.069H4L3.977,9.977h4.039L8.039,22.069z M5.918,8.394 H5.893c-1.318,0-2.171-0.908-2.171-2.042c0-1.159,0.879-2.041,2.222-2.041c1.344,0,2.171,0.882,2.196,2.041 C8.14,7.485,7.287,8.394,5.918,8.394z M22.042,22.07h-4.075v-6.571c0-1.588-0.421-2.671-1.842-2.671 c-1.084,0-1.671,0.731-1.955,1.437c-0.104,0.253-0.13,0.604-0.13,0.957v6.849H9.945L9.922,9.977h4.095l0.023,1.705 c0.521-0.806,1.394-1.953,3.48-1.953c2.584,0,4.521,1.688,4.521,5.317V22.07z"/></svg> Linkedin</h6>
                    <span class="text-primary"><a href="<?= $consulta[0]['US_LINKEDIN'] ?>">Meu Linkedin</a></span>
                  </li>
                   <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             width="26" height="26" viewBox="0 0 36.447 36.447" style="enable-background:new 0 0 36.447 36.447;"
             xml:space="preserve">
          <g>
            <g>
              <path d="M30.224,3.948h-1.098V2.75c0-1.517-1.197-2.75-2.67-2.75c-1.474,0-2.67,1.233-2.67,2.75v1.197h-2.74V2.75
                c0-1.517-1.197-2.75-2.67-2.75c-1.473,0-2.67,1.233-2.67,2.75v1.197h-2.74V2.75c0-1.517-1.197-2.75-2.67-2.75
                c-1.473,0-2.67,1.233-2.67,2.75v1.197H6.224c-2.343,0-4.25,1.907-4.25,4.25v24c0,2.343,1.907,4.25,4.25,4.25h24
                c2.344,0,4.25-1.907,4.25-4.25v-24C34.474,5.855,32.567,3.948,30.224,3.948z M25.286,2.75c0-0.689,0.525-1.25,1.17-1.25
                c0.646,0,1.17,0.561,1.17,1.25v4.896c0,0.689-0.524,1.25-1.17,1.25c-0.645,0-1.17-0.561-1.17-1.25V2.75z M17.206,2.75
                c0-0.689,0.525-1.25,1.17-1.25s1.17,0.561,1.17,1.25v4.896c0,0.689-0.525,1.25-1.17,1.25s-1.17-0.561-1.17-1.25V2.75z M9.125,2.75
                c0-0.689,0.525-1.25,1.17-1.25s1.17,0.561,1.17,1.25v4.896c0,0.689-0.525,1.25-1.17,1.25s-1.17-0.561-1.17-1.25V2.75z
                 M31.974,32.198c0,0.965-0.785,1.75-1.75,1.75h-24c-0.965,0-1.75-0.785-1.75-1.75v-22h27.5V32.198z"/>
              <rect x="6.724" y="14.626" width="4.595" height="4.089"/>
              <rect x="12.857" y="14.626" width="4.596" height="4.089"/>
              <rect x="18.995" y="14.626" width="4.595" height="4.089"/>
              <rect x="25.128" y="14.626" width="4.596" height="4.089"/>
              <rect x="6.724" y="20.084" width="4.595" height="4.086"/>
              <rect x="12.857" y="20.084" width="4.596" height="4.086"/>
              <rect x="18.995" y="20.084" width="4.595" height="4.086"/>
              <rect x="25.128" y="20.084" width="4.596" height="4.086"/>
              <rect x="6.724" y="25.54" width="4.595" height="4.086"/>
              <rect x="12.857" y="25.54" width="4.596" height="4.086"/>
              <rect x="18.995" y="25.54" width="4.595" height="4.086"/>
              <rect x="25.128" y="25.54" width="4.596" height="4.086"/>
                </svg>
                        Nascimento</h6>
                    <span class="text-primary"><?= $consulta[0]['US_BIRTH'] ?></span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8" style="margin-top: 16%;" >
              <div class="card mb-3">
                <div class="card-body mt-5">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Usuario</h6>
                    </div>
                    <div class="col-sm-9 text-primary">
                      <p><?= $consulta[0]['US_NAME'] ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">E-mail</h6>
                    </div>
                    <div class="col-sm-9 text-primary">
                      <p><?= $consulta[0]['US_EMAIL'] ?></p>
                    </div>
                  </div>
                </div>
              </div>


                    </div>
                  </div>
                </div>
              </div>

  <?php for ($i = 0; $i < sizeof($consulta); $i++): ?> 

        <?php if($consulta[$i]['TOP_TITLE'] == null) continue ?>
              
      <div class="container mb-3 shadow border border-light rounded">
            <div class="row justify-content-center">
              <div class="col-2 pt-3">
                <?php if ($consulta[$i]['US_IMAGE'] == null || $consulta[$i]['US_IMAGE'] == 'upload/' . $_SESSION['login']): ?>
                    <svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-person-circle d-block m-auto" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                      <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                      <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                </svg>
                        <?php else: ?>
                          <img class="img-topics rounded-circle d-block m-auto" src="<?= $consulta[$i]['US_IMAGE'] ?>">
                    <?php endif ?>
              </div>
              <div class="col-5 text-left pt-3">
                <strong><?= $consulta[$i]['TOP_TITLE'] ?></strong>
              </div>
              <div class="col-3 text-right pt-3">Criado <time class="timeago" datetime="<?= date('Y-m-d H:i:s', strtotime($consulta[$i]['TOP_DATE'])) ?>"></time>
              </div>
                <?php if (isset($_SESSION['login']) && $consulta[$i]['TOP_US_ID'] == $_SESSION['login']): ?>
                  <div class="col-2">
                    <a class="delete" href="delete.php?id=<?= $consulta[$i]['TOP_ID'] ?>">
                      <svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-trash-fill d-block m-auto pt-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                    </svg>
                  </a>
                  </div>
                <?php else: ?>
                  <div class="col-2"></div>
                <?php endif ?>
            </div>
            <div class="row justify-content-center">
              <div class="col-2 text-center ml-n2">Criado por: <?= $consulta[$i]['US_NAME'] ?></div>
              <div class="col-10"></div>
            </div>
            <div class="row justify-content-center pb-3">
              <div class="col-2"></div>
              <div class="col-8 text-center">
                <a class="a-topics" href="discussao.php?id=<?=$consulta[$i]['TOP_ID'] ?>">
                  <strong>Clique aqui para visualizar toda a discussão!</strong>
                </a>
              </div>
              <div class="col-2"></div>
            </div>
        </div>

            </div>
          </div>
        </div>
    </div>
    <?php endfor ?>
    <script>
        $('.delete').on('click', evt => {
          if (!confirm("Quer realmente apagar o seu Tópico?")) evt.preventDefault()
        })
      </script>

    <?php include 'templates/footer.php' ?>


