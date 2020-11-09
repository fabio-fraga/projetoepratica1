<?php

include 'bd.php';

$id = $_GET['id'] ?? false;

if ($id === false) {
    header('location: home.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bem-vindo ao F4ALL!</title>

	<?php include 'templates/header.php'; ?>

</head>

<?php
$stmt = $pdo->prepare("
  SELECT *
  FROM TOPICS
  LEFT JOIN VOTE ON VOTE_TOP_ID = TOP_ID AND VOTE_US_ID = :user_id
  LEFT JOIN USERS ON US_ID = TOP_US_ID
  WHERE TOP_ID = :top_id
");

$stmt->execute([
    'top_id' => $id,
    'user_id' => $_SESSION['login'],
]);

$consulta = $stmt->fetchAll();

if (sizeof($consulta) == 0) {
    header('location: home.php');
    exit();
}

$topico = $consulta[0];

?>

<body>

<main>

	<div class="container mt-n3 mb-3 shadow border border-light rounded">

  		<div class="row justify-content-center">
  			<div class="col-2 pt-3">
  				<?php if ($topico['US_IMAGE'] == null || $topico['US_IMAGE'] == 'upload/' . $_SESSION['login']): ?>
               		<a href="my_profile.php?id=<?=$topico['US_ID']?>">
                        <figure class="figure text-center">
                            <svg width="4.5em" height="4.5em" viewBox="0 0 16 16" class="bi bi-person-circle d-block m-auto" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                                <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                            </svg>
                        <strong><figcaption class="figure-caption">Criado por <?= $topico['US_NAME'] ?></figcaption></strong>
                        </figure>
                    </a>
                <?php else: ?>
                    <a href="my_profile.php?id=<?=$topico['US_ID'] ?>">
                        <figure class="figure text-center">
                            <img class="figure-img img-fluid rounded-circle" src="<?= $topico['US_IMAGE'] ?>" style="height: 75px; width: 75px;"></a>
                         <strong><figcaption class="figure-caption">Criado por <?= $topico['US_NAME'] ?></figcaption></strong>
                        </figure>
                    </a>
             	<?php endif ?>
  			</div>

    		<div class="col-6 text-left pt-3">
    			<strong><?= $topico['TOP_TITLE'] ?></strong>
    		</div>

    		<?php 

    		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
			date_default_timezone_set('America/Recife');

    		?>
    		<div class="col-2 text-right pt-3">Criado em: <?= strftime('%A, %e de %B de %Y', strtotime($topico['TOP_DATE'])) ?>
    		</div>

    		<?php if (isset($_SESSION['login']) && $topico['TOP_US_ID'] == $_SESSION['login']): ?>
				<div class="col-1">
					<a href="edittop.php?id=<?= $topico['TOP_ID'] ?>" class="edit">
						<svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-pencil-square d-block m-auto pt-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  							<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  							<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						</svg>
					</a>
				</div>

    			<div class="col-1">
    				<a class="delete" href="delete.php?id=<?= $topico['TOP_ID'] ?>">
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
  			<div class="col-1"></div>
    		<div class="col-10"><?=$topico['TOP_SUBJECT']?></div>
    		<div class="col-1"></div>
    	</div>

  		<?php if (!$topico['US_IMAGE'] == null && file_exists($consulta[$i]['COM_IMAGE'])): ?>
  			<div class="row justify-content-center">  								
  				<div class="col-12 text-center mt-3">
  					<img src="<?= $topico['TOP_IMAGE'] ?>" class="m-auto" style="width: 80%; height: auto;">
  				</div>
  			</div>
  		<?php endif ?>
		
		<div class="row justify-content-center mt-3">
  			<?php
  				$lk = getlike($topico['TOP_ID']);
				$dlk = getdislike($topico['TOP_ID']);					
			?>

			<div class="col-1 ml-n5">
		  		<a href="<?="rating.php?topid=$id&valor=1"?>"><i class="fa<?= $topico['VOTE_VALUE'] != null && $topico['VOTE_VALUE'] == '1' ? '' : 'r' ?> fa-thumbs-up"></i></a>
					<p><?=$lk?></p>
			</div>

			<div class="col-1">
				<a href="<?="rating.php?topid=$id&valor=0"?>"><i class="fa<?= $topico['VOTE_VALUE'] != null && $topico['VOTE_VALUE'] == '0' ? '' : 'r' ?> fa-thumbs-down"></i></a>
					<p><?= $dlk ?></p>
  			</div>

  			<div class="col-9"></div>
  		</div>
  	</div>

	<?php if(isset($_SESSION['login'])): ?>
  		

		<div class="container shadow border border-light rounded">
			<form enctype="multipart/form-data" method="POST" action="comentario.php" class="text-center mt-n3 mb-3">
				<input type="hidden" id="id_post" name="id_post" value="<?=$topico['TOP_ID']?>">
				<input type="hidden" id="id_us" name="id_us" value="<?=$topico['TOP_US_ID']?>" >
						
				<div class="row justify-content-center mt-5">
					<div class="col-11 text-left pb-3">
						<textarea type="text" class="form-control" name="comentario" placeholder="Faça um comentário:" style="resize: none"><?= $_POST['subject'] ?? '' ?></textarea>
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
							<strong><?= $report_erro ?></strong>
						</p>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-11 text-center mt-n4 pb-3">
						<input type="submit" value="Comentar" class="btn btn-primary" class="teste">
					</div>
				</div>
			</form>
		</div>

	<?php  else: ?>
		<div class="container mb-3 shadow border border-light rounded">
			<div class="row justify-content-center pb-3">
				<div class="col-12">
					<a href="cadastro.php">Faça login para comentar...</a>
				</div>
			</div>
		</div>

	<?php endif ?>

	<div class="con"></div>	

</main>

<?php include 'templates/footer.php'; ?>

	<?php 

		function getlike($id_topico){
			include 'bd.php';
			$stmt = $pdo->prepare(" SELECT COUNT(VOTE_ID) FROM VOTE WHERE VOTE_VALUE=1 AND VOTE_TOP_ID = ?");

			$stmt->execute([$id_topico]);

			$likes = $stmt->fetchAll();
			
			return $likes[0][0];

		}

		function getdislike($id_topico){
			include 'bd.php';
			$stmt = $pdo->prepare(" SELECT COUNT(VOTE_ID) FROM VOTE WHERE VOTE_VALUE=0 AND VOTE_TOP_ID = ?");

			$stmt->execute([$id_topico]);

			$dislikes = $stmt->fetchAll();
			// var_dump($dislikes);
			return $dislikes[0][0];

		}
	?>

	<script src="./js/jquery-compressed.js"></script>	
	<script src="./js/salvar-comentario.js"></script>	

	<script>

		$('.delete').on('click', evt => {
			if (!confirm("Clique em 'OK' para confirmar a exclusão deste tópico:")) evt.preventDefault()
		})
		$('.edit').on('click', evt => {
			if (!confirm("Clique em 'OK' para editar este tópico:")) evt.preventDefault()
		})
		
		function loadData() {
			console.log('fazendo requisição...');
			$.ajax('discussao-ajax.php?id=<?=$id?>', {
				success: function(data) {
					console.log('atualizando...');
					$('.con').html(data);
				}
			})
		}

		$(document).ready(function() {
			loadData();
		});

		setInterval(function() {
			loadData();
		}, 2 * 5000);

	</script>		
	
</body>

</html>