<?php 

session_start();

include 'bd.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bem-vindo ao F4ALL!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php include 'templates/header.php'; ?>

</head>

<body>

	<main>

		<?php 

		$stmt = $pdo->prepare("
		SELECT * FROM USERS
		WHERE US_ID = ?
		");

		$stmt->execute([$_SESSION['login'],]);

		$linhas = $stmt->fetchAll();

		$_SESSION['name'] = $linhas[0]['US_NAME'];

		$user = $_SESSION['name'];

		?>

		<?php if (isset($_SESSION['login'])): ?>
			<h1 class="text-center mb-4"><strong><?= 'Olá, ' . $user  . '!' ?></strong></h1>

		<?php else: ?>
			<h1 class="text-center mb-4"><strong>Olá! Confira os últimos tópicos! :)</strong></h1>

		<?php endif ?>


		<?php if (isset($_SESSION['login'])): ?>
			<h1 class="text-center mt-n3 mb-3"><strong><a href="pub.php">Criar Tópico</a></strong></h1>

		<?php endif ?>

		<?php 

		$stmt = $pdo->prepare("
		  SELECT * FROM TOPICS ORDER BY TOP_DATE DESC
		");

		$stmt->execute();
		$consulta = $stmt->fetchAll();

		?>

		<?php for ($i = 0; $i < sizeof($consulta); $i++): ?>
		
		<?php 

		$stmt = $pdo->prepare("
			SELECT * FROM USERS WHERE US_ID = ?
		");

		$stmt->execute([$consulta[$i]['TOP_US_ID']]);

		$con_pub = $stmt->fetchAll();

 		?> 

 		<div class="container mb-1 border border-dark"><a style="color: black" href="discussao.php">

  			<div class="row justify-content-center no-gutters">
    			<div class="col-12 text-center mt3 pt-3"><strong>Título: <?=$consulta[$i]['TOP_TITLE']?></strong></div>
  			</div>		
  			<div class="row justify-content-center no-gutters">
    			<div class="col-12 text-center offset">Assunto: <?=$consulta[$i]['TOP_SUBJECT']?></div>
  			</div>
  			<div  class="row justify-content-center no-gutters">
    			<div class="col-12 text-center">Criador: <?=$con_pub[0]['US_NAME']?></div>
  			</div>
  			<div class="row justify-content-center no-gutters">
    			<div class="col-12 text-center mb-3">Criado em: <?= date('d/m/Y H:m:s', strtotime($consulta[$i]['TOP_DATE'])) ?></div>
  			</div>

  		</a>
		</div>
		
		<?php endfor ?>

	</main>

	<?php include 'templates/footer.php'; ?>

</body>

</html>