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


<?php if (isset($_SESSION['login'])): ?>
	<h1 style="text-align: center; margin: auto; padding-top: 10%; padding-bottom: 32.9%"><?= $user ?></h1>

<?php else: ?>
	<h1 style="text-align: center; margin: auto; padding-top: 10%; padding-bottom: 5%">Olá!</h1>

<?php endif ?>


<?php if (isset($_SESSION['login'])): ?>

			<h1 style="margin-top: -27%; text-align: center;"><a href="pub.php">Criar Tópico</a></h1>

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

		<form action="cometario.php" method="POST" style="width: 100vw;
         height: 10vh;
         display: flex;
         flex-direction: row;
         justify-content: center;
         align-items: center; margin-bottom: 5%;">

				<input type="text" name="cometario" placeholder="Escreva um comentario...">
				<input type="submit" value="Comentar">	

		</form>
		

	</div>
		
		<?php endfor ?>


<?php

include 'templates/footer.php';

?>