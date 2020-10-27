<?php 
 
 	include 'bd.php';

	session_start();
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bem-vindo ao F4ALL!</title>
<?php 

include 'templates/header.php';


$stmt = $pdo->prepare("
	SELECT * FROM USERS
	WHERE US_ID = ?
");

$stmt->execute([$_SESSION['login'],]);

$linhas = $stmt->fetchAll();

$_SESSION['name'] = $linhas[0]['US_NAME'];

$user = 'Olá, ' . $_SESSION['name'] . '!';


?>

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

	<div style="border: 1px solid black; margin-bottom: 2%; ">


	<table style="width: 100vw;
         height: 10vh;
         display: flex;
         flex-direction: row;
         justify-content: center;
         align-items: center">

        

         	<th><?=$con_pub[0]['US_NAME'] . ':'?></th> 

			<th style="border: 1px solid black"><?=$consulta[$i]['TOP_TITLE']?></th> 

			<td style="border: 1px solid black"> <?=$consulta[$i]['TOP_SUBJECT']?></td>

			<td style="border: 1px solid black"><?=$consulta[$i]['TOP_DATE']?></td>

		</table>
<?php 

	$stmt = $pdo->prepare("
	SELECT * FROM COMMENTS WHERE COM_TOP_ID = ?
");

$stmt->execute([$consulta[$i]['TOP_ID']]);

$consulta_com = $stmt->fetchAll();



?>
	<?php for($j= 0; $j < sizeof($consulta_com); $j++): ?>
		<?php 

			$stmt = $pdo->prepare("

				SELECT * FROM USERS WHERE US_ID = ?
			");

			$stmt->execute([$consulta_com[$j]['COM_US_ID']]);

			$con_don = $stmt->fetchAll();
 ?> 

		<table style="text-align: center">
			<th><?= $con_don[0]['US_NAME'] . ':'; ?></th> 
			<td> <?= $consulta_com[$j]["COM_CONTENT"]; ?></td>
		</table>

		<?php endfor ?>


		<form action="comentario.php" method="POST" style="width: 100vw;
         height: 10vh;
         display: flex;
         flex-direction: row;
         justify-content: center;
         align-items: center; margin-bottom: 5%;">

				<input type="text" name="comentario" 

				<?php if(isset($_SESSION['login'])):?>

				placeholder="Escreva um comentario..." 	


				<?php  else:?>

						placeholder="Faça login para comentar"


					<?php endif ?>
					

					>

				<input type="hidden" name="id_post" value="<?=$consulta[$i]['TOP_ID']?>" >
				<input type="submit" value="Comentar">	

		</form>

	</div>	
		
		<?php endfor ?>

<?php

include 'templates/footer.php';

?>