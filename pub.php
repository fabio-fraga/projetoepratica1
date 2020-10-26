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
		
		<table>
			
		<th>Comentario</th>


		</table>

		<form action="cometario.php" method="POST">

				<input type="text" name="cometario" placeholder="Escreva um comentario...">
				<input type="submit" value="Comentar">	

		</form>


	</div>
		<?php endfor ?>
</body>
</html>