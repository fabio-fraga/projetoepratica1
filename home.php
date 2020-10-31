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

		<?php if (!isset($_SESSION['login'])): ?>
			<h1 class="text-center mb-4"><strong>Olá! Confira os últimos tópicos! :)</strong></h1>
		<?php endif ?>


		<?php if (isset($_SESSION['login'])): ?>
				<div class="container mb-3  border border-light rounded">
					<form method="POST" action="topics.php"class="text-center mt-n3 mb-3">
						<div class="row justify-content-center ml-4 mt-5">


							<div class="col-10 text-left ml-n5 pb-3">
								<div class="row justify-content-center ml-4">
									<p class=" text-center">Crie Toicos e Tire Suas Dulvidas</p>
								</div>
							</div>

							<div class="col-10 text-left ml-n5 pb-3">
								<div class="row justify-content-center ml-4">
									<textarea type="text" class="form-control" name="title" placeholder="Titulo do Topico." style="resize: none"></textarea>
								</div>
							</div>

								<div class="col-10 text-left ml-n5 pb-3">
							<div class="row justify-content-center ml-4">
								<textarea type="text" class="form-control" name="subject" placeholder="Qual sua dulvida?" style="resize: none"></textarea>
								</div>

							</div>
							<div class="col-10 text-left ml-n5 pb-3">
								<div class="row justify-content-center ml-4 mb-2	">
									<input type="submit" value="Publicar" class="btn btn-primary">
								</div>

							</div>

						</div>
					</form>
				</div>

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

 		<div class="container mb-3 shadow border border-light rounded">

  			<div class="row justify-content-center ml-4">
  				<div class="col-1 pt-3">


  					<?php if ($con_pub[0]['US_IMAGE'] == null): ?>
                    		<img class="img-topics img-fluid ml-n4 rounded" src="upload/standard.png">
                    <?php else: ?>
                    		<img class="img-topics img-fluid ml-n4 rounded" src="<?= $con_pub[0]['US_IMAGE'] ?>">
             <?php endif ?>
  				</div>
    			<div class="col-7 text-left ml-n5 pt-3">
    				<strong><?= $con_pub[0]['US_NAME'] ?></strong>
    			</div>
    			<div class="col-3 text-left pt-3">Criado <time class="timeago" datetime="<?= date('Y-m-d H:m:s', strtotime($consulta[$i]['TOP_DATE'])) ?>"></time></div>
    			<div class="col-1">
    				<a href="#"><img class="w-50 pt-3" src="img/trash.png"></a>
    			</div>
  			</div>
  			<div class="row justify-content-center ml-4">
    			<div class="col-10 text-left mt-n4 ml-n5">Título: <?=$consulta[$i]['TOP_TITLE']?></div>
  			</div>		
  			<div class="row justify-content-center ml-4">
    			<div class="col-10 text-left ml-n5 pb-3"><a class="a-topics" href="discussao.php?id=<?=$consulta[$i]['TOP_ID'] ?>">Ver mais...</a></div>
  			</div>
  	
		</div>
		
		<?php endfor ?>

	</main>

	<?php include 'templates/footer.php'; ?>

</body>

</html>