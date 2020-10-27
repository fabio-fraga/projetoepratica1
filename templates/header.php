<link rel="stylesheet" type="text/css" href="styles/main.css">i
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>

<script>
  $(function () {
    $('.dropdown-toggle').dropdown();
  });
   $(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });
</script>

<?php 

session_start();

include 'bd.php';

$stmt = $pdo->prepare("
  SELECT * FROM USERS
  WHERE US_ID = ?
");

$stmt->execute([$_SESSION['login']]);

$consulta = $stmt->fetchAll();

?>

<nav class="mb-1 navbar fixed-top navbar-expand-lg scrolling-navbar navbar-dark elegant-color">
  <img class="rounded-circle z-depth-0" class="rounded-circle" height="35" src="img/Logo-Forum.png">
  <a class="navbar-brand ml-1" href="/">F4All</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="documentation/proposta _projeto_e_pratica_1_forum_ifpe.pdf" target="blank">Documentação</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://github.com/FabioMouradeFraga/projetoepratica1" target="blank">GitHub</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ajuda.php">Ajuda</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sobre.php">Sobre</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <div class="md-form my-0 mr-2">
        <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar..." aria-label="Search">
      </div>
      <li class="nav-item avatar mt-1">
        <a class="nav-link p-0">

        <?php for ($i = 0; $i < sizeof($consulta); $i++): ?>
          <?php if($_SESSION['login'] == $consulta[$i]['US_ID']): ?>

            <?php if ($consulta[$i]['US_IMAGE'] != null): ?> 

              <img src="<?= $consulta[$i]['US_IMAGE'] ?>" class="rounded-circle z-depth-0" alt="avatar image" height="35">

            <?php endif ?>

          <?php endif ?>

        <?php endfor ?>

        </a>
      </li>
      <li class="nav-item dropdown mt-1">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-7" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Acesso</a>

        <?php if (isset($_SESSION['login'])): ?>

          <div class="dropdown-menu dropdown-pink" aria-labelledby="navbarDropdownMenuLink-7">
            <a class="dropdown-item" href="profile.php">Perfil</a>
            <a class="dropdown-item" href="logout.php">Sair</a>
          </div>

        <?php else: ?>

          <div class="dropdown-menu dropdown-pink" aria-labelledby="navbarDropdownMenuLink-7">
            <a class="dropdown-item" href="login.php">Login</a>
            <a class="dropdown-item" href="cadastro.php">Cadastrar</a>
          </div>

        <?php endif ?>

      </li>
    </ul>
    </div>   
</nav>
