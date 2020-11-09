<?php

include 'bd.php';

$pesquisa = $_GET['pesquisa'];

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

		<?php if (!isset($_SESSION['login'])): ?>
			<h1 class="text-center mb-4">
				<strong>Olá! Confira os últimos tópicos! :)</strong>
			</h1>
		<?php endif ?>

		<?php if (isset($_SESSION['login'])): ?>
			<div class="container mt-n3 mb-3 shadow border border-light rounded">
				<form enctype="multipart/form-data" method="POST" action="topics.php" class="text-center mt-n3 mb-3">
					<div class="row justify-content-center mt-5">
						<div class="col-12 pb-3">
							<h2 class=" text-center">
								<strong>O que deseja saber?</strong>
							</h2>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-11 text-left pb-3">
							<input type="text" class="form-control" name="title" placeholder="Dê um título a tópico:" style="resize: none" value="<?= $_POST['title'] ?? '' ?>">
							<p class="text-danger text-left">(Campo obrigatório)</p>
						</div>
					</div>
					<div class="row justify-content-center mt-n3">
						<div class="col-11 text-left pb-3">
							<textarea type="text" class="form-control" name="subject" placeholder="Descreva seu problema ou dúvida:" style="resize: none"><?= $_POST['subject'] ?? '' ?></textarea>
							<p class="text-danger text-left">(Campo obrigatório)</p>
                            <a href="https://guides.github.com/features/mastering-markdown/" target="_blank" class="text-right" data-toggle="tooltip" data-placement="left" title="Este formulário é formatado com markdown. Clique para saber mais">Ajuda?</a>
						</div>
					</div>
					<div class="row justify-content-center mt-n3">
						<div class="col-11 text-center pb-3">
							<input class="form-control-file" type="file" name="img" accept="image/jpeg, image/png">
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-11 text-center mt-n2 pb-3">
							<p class="text-danger">
								<strong><?= $report_erro ?>
							</strong></p>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-11 text-center mt-n4 pb-3">
							<input type="submit" value="Publicar" class="btn btn-primary">
						</div>
					</div>
				</form>
			</div>
		<?php endif ?>

		<?php
		$stmt = $pdo->prepare("
			SELECT *
          	FROM TOPICS
          	JOIN USERS ON TOP_US_ID = US_ID
          	WHERE TOP_TITLE LIKE '%$pesquisa%'
          	ORDER BY TOP_DATE DESC
		");

		$stmt->execute();
		$dados = $stmt->fetchAll();

		?>

		<?php for ($i = 0; $i < sizeof($dados); $i++): ?>
 			<div class="container mb-3 shadow border border-light rounded">
 				<div class="row justify-content-center">
  					<div class="col-2 pt-3 text-center">
  						<?php if ($dados[$i]['US_IMAGE'] == null || $dados[$i]['US_IMAGE'] == 'upload/' . $_SESSION['login']): ?>
                    		<a href="my_profile.php?id=<?= $dados[$i]['TOP_US_ID'] ?>">
                    			<figure class="figure text-center">
                    				<svg width="4.5em" height="4.5em" viewBox="0 0 16 16" class="bi bi-person-circle d-block m-auto" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  										<path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
  										<path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  										<path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
									</svg>
								<strong><figcaption class="figure-caption">Criado por <?= $dados[$i]['US_NAME'] ?></figcaption></strong>
                        		</figure>
  							</a>
                    	<?php else: ?>
                    		<a href="my_profile.php?id=<?= $dados[$i]['TOP_US_ID'] ?>">
                    			<figure class="figure text-center">
                    				<img class="figure-img img-fluid rounded-circle" style=" height: 75px; width: 75px;" src="<?= $dados[$i]['US_IMAGE'] ?>">
                    			<strong><figcaption class="figure-caption">Criado por <?= $dados[$i]['US_NAME'] ?></figcaption></strong>
                        		</figure>
                    		</a>
             			<?php endif ?>
  					</div>
    				<div class="col-6 text-left pt-3">
    					<strong><?= $dados[$i]['TOP_TITLE'] ?></strong>
    				</div>
    				<div class="col-2 text-right pt-3">Criado <time class="timeago" datetime="<?= date('Y-m-d H:i:s', strtotime($dados[$i]['TOP_DATE'])) ?>"></time>
    				</div>
    					<?php if (isset($_SESSION['login']) && $dados[$i]['TOP_US_ID'] == $_SESSION['login']): ?>
    						<div class="col-1">
    							<a href="edittop.php?id=<?= $dados[$i]['TOP_ID'] ?>" class="edit">
									<svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-pencil-square d-block m-auto pt-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
									</svg>
								</a>
							</div>

							<div class="col-1">
    							<a class="delete" href="delete.php?id=<?= $dados[$i]['TOP_ID'] ?>">
    								<svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-trash-fill d-block m-auto pt-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
 										<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
									</svg>
								</a>
    						</div>
    					<?php else: ?>
    						<div class="col-2"></div>
    					<?php endif ?>
  				</div>
  	
  				<div class="row justify-content-center pb-3">
	  				<div class="col-2"></div>
    				<div class="col-8 text-center">
    					<a class="a-topics" href="discussao.php?id=<?=$dados[$i]['TOP_ID'] ?>">
    						<strong>Clique aqui para visualizar toda a discussão!</strong>
    					</a>
    				</div>
    				<div class="col-2"></div>
  				</div>
			</div>
		<?php endfor ?>

	</main>

	<?php include 'templates/footer.php'; ?>

	<script>
		$('.delete').on('click', evt => {
			if (!confirm("Clique em 'OK' para confirmar a exclusão deste tópico:")) evt.preventDefault()
		})
		$('.edit').on('click', evt => {
			if (!confirm("Clique em 'OK' para editar este tópico:")) evt.preventDefault()
		})
	</script>

</body>
</html>
