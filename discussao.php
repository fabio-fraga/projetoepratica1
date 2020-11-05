<?php

 	include 'bd.php';

	session_start();

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
	<div style="border: 1px solid black; margin-bottom: 2%; ">


	<table style="width: 100vw;
		margin-top: 10%;
        height: 10vh;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center">



         	<th><?=$consulta[0]['US_NAME'] . ':'?></th>

			<th style="border: 1px solid black"><?=$topico['TOP_TITLE']?></th>

			<td style="border: 1px solid black"> <?=$topico['TOP_SUBJECT']?></td>

			<td style="border: 1px solid black"><?=$topico['TOP_DATE']?></td>

		<?php
			$lk = getlike($topico['TOP_ID']);
			$dlk = getdislike($topico['TOP_ID']);
		
		?>
		</table>
			<a href="<?="rating.php?topid=$id&valor=1"?>"><i class="fa<?= $topico['VOTE_VALUE'] != null && $topico['VOTE_VALUE'] == '1' ? '' : 'r' ?> fa-thumbs-up"></i></a>
							&nbsp;&nbsp;&nbsp;&nbsp;
			<p><?= $lk?></p>
			<a href="<?="rating.php?topid=$id&valor=0"?>"><i class="fa<?= $topico['VOTE_VALUE'] != null && $topico['VOTE_VALUE'] == '0' ? '' : 'r' ?> fa-thumbs-down"></i></a>
			<p><?= $dlk ?></p>
		<div class="con">


		</div>
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
		}, 5 * 1000);


</script>


	<form id="form-comment" action="comentario.php" method="POST" style="width: 100vw;
     height: 10vh;
     display: flex;
     flex-direction: row;
     justify-content: center;
     align-items: center; margin-bottom: 5%;">


			

			<?php if(isset($_SESSION['login'])):?>

			<input type="text" id="comentario" name="comentario" placeholder="Escreva um comentario...">
			<input type="hidden" id="id_post" name="id_post" value="<?=$topico['TOP_ID']?>">
			<input type="hidden" id="id_us" name="id_us" value="<?=$topico['TOP_US_ID']?>" >
			<input type="submit" value="Comentar">



			<?php  else:?>
					
				<a href="cadastro.php">Faça login para comentar...</a>

				<?php endif ?>

	</form>

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
			var_dump($dislikes);
			return $dislikes[0][0];

		}
	?>
	<script src="./js/jquery-compressed.js"></script>	
	<script src="./js/salvar-comentario.js"></script>			
<?php

include 'templates/footer.php';

?>