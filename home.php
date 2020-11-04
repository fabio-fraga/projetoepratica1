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
				<div class="container mb-3 shadow border border-light rounded">
					<form method="POST" action="topics.php"class="text-center mt-n3 mb-3">
						<div class="row justify-content-center ml-4 mt-5">

							<div class="col-10 text-left ml-n5 pb-3">
								<div class="row justify-content-center ml-4">
									<h2 class=" text-center"><strong>O que deseja saber?</strong></h2>
								</div>
							</div>

							<div class="col-10 text-left ml-n5 pb-3">
								<div class="row justify-content-center ml-4">
									<textarea type="text" class="form-control" name="title" placeholder="Dê um título ao tópico:" style="resize: none"></textarea>
								</div>
							</div>

								<div class="col-10 text-left ml-n5 pb-3">
							<div class="row justify-content-center ml-4">
								<textarea type="text" class="form-control" name="subject" placeholder="Descreva seu problema ou dúvida:" style="resize: none"></textarea>
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

  			<div class="row justify-content-center">
  				<div class="col-2 pt-3">

  					<?php if ($con_pub[0]['US_IMAGE'] == null || $con_pub[0]['US_IMAGE'] == 'upload/'): ?>
                    	<svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-person-circle d-block m-auto" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  							<path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
  							<path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  							<path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
						</svg>
                    <?php else: ?>
                    		<img class="img-topics rounded d-block m-auto" src="<?= $con_pub[0]['US_IMAGE'] ?>">
             <?php endif ?>
  				</div>
    			<div class="col-5 text-left pt-3"><strong><?=$consulta[$i]['TOP_TITLE'] ?></strong>
    			</div>
    			<div class="col-3 text-left pt-3">Criado <time class="timeago" datetime="<?= date('Y-m-d H:m:s', strtotime($consulta[$i]['TOP_DATE'])) ?>"></time></div>
    			<div class="col-2">
    				<a href="#">
    					<svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-trash-fill d-block m-auto pt-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
 							<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
						</svg>
					</a>
    			</div>
  			</div>
  			<div class="row justify-content-center">
    			<div class="col-2 text-center ml-n2">Criado por: <?= $con_pub[0]['US_NAME'] ?></div>
    			<div class="col-10"></div>
  			</div>		
  			<div class="row justify-content-center pb-3">
	  			<div class="col-10"></div>
    			<div class="col-2 text-center"><a class="a-topics" href="discussao.php?id=<?=$consulta[$i]['TOP_ID'] ?>"><strong>Ver mais...</strong></a></div>
  			</div>

		</div>
		
		<?php endfor ?>

	</main>

	<?php include 'templates/footer.php'; ?>

</body>

</html>