<?php include'bd.php';
session_start();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

	<form method="POST" action="topics.php">

		<input type="text" name="title" placeholder="Titulo do Topico."><br>
		<input type="text" name="subject" placeholder="Qual sua dulvida?"><br>
		<input type="submit">

	</form><br><br><br>
	<?php 
$stmt = $pdo->prepare("
  SELECT * FROM TOPICS 
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



	<div>
		<table>	
			<th><?= $con_pub[0]['US_NAME'] . ':' ?></th>

			<th><?=$consulta[$i]['TOP_TITLE']?></th> 

			<td> <?=$consulta[$i]['TOP_SUBJECT']?></td>

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
			
			<th> <?= $consulta_com[$j]["COM_CONTENT"]?></th>
		

		<?php endfor ?>

	</table>

		<form action="comentario.php" method="POST">

				<input type="text" name="comentario" placeholder="Escreva um comentario...">
				<input type="hidden" name="id_post" value="<?=$consulta[$i]['TOP_ID']?>" >
				<input type="submit" value="Comentar">	

		</form>


	</div>
		<?php endfor ?>

		<a href="/">Home</a>
</body>
</html>