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
<?php

include 'templates/header.php';

?>
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


<div class="container mb-3 shadow border border-light rounded" style="margin-top: 8%;" >
  					<div class="row justify-content-center">
  						<div class="col-2 pt-3">
  							<?php if ($topico['US_IMAGE'] == null || $topico['US_IMAGE'] == 'upload/' . $_SESSION['login']): ?>
                    			<svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-person-circle d-block m-auto" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  									<path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
  									<path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  									<path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
								</svg>
                    		<?php else: ?>
                    			<img class="img-topics rounded-circle d-block m-auto" src="<?= $topico['US_IMAGE'] ?>">
             				<?php endif ?>
  						</div>
    					<div class="col-5 text-left pt-3">
    						<strong><?= $topico['TOP_TITLE'] ?></strong>
    					</div>

    					<div class="col-3 text-right pt-3">Criado <time class="timeago" datetime="<?= date('Y-m-d H:i:s', strtotime($topico['TOP_DATE'])) ?>"></time>
    					</div>

    						<?php if (isset($_SESSION['login']) && $topico['TOP_US_ID'] == $_SESSION['login']): ?>
    							<div class="col-2">
    								<a class="delete" href="delete.php?id=<?= $topico['TOP_ID'] ?>">
    									<svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-trash-fill d-block m-auto pt-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
 											<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
										</svg>
									</a>
									<a href="edittop.php?id=<?= $topico['TOP_ID'] ?>">
										<svg id="Layer_1" width="3em" height="3em" style="enable-background:new 0 0 64 64;" version="1.1" viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
										.st0{fill:#007bff;}
									</style><g><g id="Icon-Pencil" transform="translate(179.000000, 382.000000)"><path class="st0" d="M-168.2-328l3.7-14.9l22.7-22.7l11.2,11.2l-22.7,22.7L-168.2-328L-168.2-328z M-161.9-341.5     l-2.4,9.6l9.6-2.4l20.2-20.2l-7.2-7.2L-161.9-341.5L-161.9-341.5z" id="Fill-168"/><path class="st0" d="M-155.7-332.6c-1-3.9-4-6.9-7.9-7.9l0.7-2.8c4.9,1.2,8.7,5,9.9,9.9L-155.7-332.6" id="Fill-169"/><polyline class="st0" id="Fill-170" points="-156,-338.1 -158,-340.2 -138.1,-360.1 -136.1,-358.1 -156,-338.1    "/><path class="st0" d="M-166.2-330l4.4-1.1c-0.4-1.6-1.7-2.9-3.3-3.3L-166.2-330" id="Fill-171"/><path class="st0" d="M-129.5-355.5l-11.2-11.2l4.5-4.5l0.7,0.1c5.4,0.7,9.7,5,10.4,10.4l0.1,0.7L-129.5-355.5     L-129.5-355.5z M-136.6-366.7l7.2,7.2l1.4-1.4c-0.8-3.6-3.6-6.4-7.2-7.2L-136.6-366.7L-136.6-366.7z" id="Fill-172"/></g></g></svg>

									</a>
    							</div>
    						<?php else: ?>
    							<div class="col-2"></div>
    						<?php endif ?>
  					</div>
  					<div class="row justify-content-center">
    					<div class="col-2 text-center ml-n2"><a href="my_profile.php?id=<?=$topico['US_ID'] ?>"><?= $topico['US_NAME'] ?></a></div>
    					<div class="col-10">
    						<?=$topico['TOP_SUBJECT']?>
    					</div>
  						<div class="row">
  							<?php if ($topico['US_IMAGE'] == null || $topico['US_IMAGE'] == 'upload/' . $_SESSION['login']): ?>
  								
  								<?php else: ?>
  							<img src="<?= $topico['TOP_IMAGE'] ?>" class="m-auto"  height="400"width="400">
  							<?php endif ?>
  						</div>
  					</div>
							<div class="row">
								<?php
									$lk = getlike($topico['TOP_ID']);
									$dlk = getdislike($topico['TOP_ID']);
								
								?>
		  						<a href="<?="rating.php?topid=$id&valor=1"?>"><i class="fa<?= $topico['VOTE_VALUE'] != null && $topico['VOTE_VALUE'] == '1' ? '' : 'r' ?> fa-thumbs-up"></i></a>
								<!-- &nbsp;&nbsp;&nbsp;&nbsp; -->
								<p><?=$lk?></p>
								<a href="<?="rating.php?topid=$id&valor=0"?>"><i class="fa<?= $topico['VOTE_VALUE'] != null && $topico['VOTE_VALUE'] == '0' ? '' : 'r' ?> fa-thumbs-down"></i></a>
								<p><?= $dlk ?></p>
							</div>
  					<div class="row justify-content-center pb-3"  style="width:; height:  ">
	  					<div class="col-2">
	  						

	  					</div>

    						<form id="form-comment" action="comentario.php" method="POST">
								<?php if(isset($_SESSION['login'])):?>

									<input type="text" id="comentario" name="comentario" placeholder="Escreva um comentario...">
									<input type="hidden" id="id_post" name="id_post" value="<?=$topico['TOP_ID']?>">
									<input type="hidden" id="id_us" name="id_us" value="<?=$topico['TOP_US_ID']?>" >
									<input type="submit" value="Comentar">

								<?php  else:?>
											
										<a href="cadastro.php">Faça login para comentar...</a>

								<?php endif ?>
							</form>
							<div class="con">
							</div>
    					
  					</div>
				</div>
	<div>
			
		
		<script>

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
		}, 1 * 1000);


</script>

	</div>
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
					if (!confirm("Quer realmente apagar o seu Tópico?")) evt.preventDefault()
				})
			</script>		
<?php

include 'templates/footer.php';

?>