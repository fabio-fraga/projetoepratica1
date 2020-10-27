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

		<a href="/">Home</a>
</body>
</html>