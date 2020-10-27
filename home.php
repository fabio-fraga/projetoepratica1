<?php 

session_start();

include 'bd.php';

$stmt = $pdo->prepare("
	SELECT * FROM USERS
	WHERE US_ID = ?
");

$stmt->execute([$_SESSION['login'],]);

$linhas = $stmt->fetchAll();

$_SESSION['name'] = $linhas[0]['US_NAME'];

$user = $_SESSION['name'];

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

		<?php if (isset($_SESSION['login'])): ?>
			<h1><?= 'Olá, ' . $user  . '!' ?></h1>

		<?php else: ?>
			<h1>Olá!</h1>

		<?php endif ?>


		<?php if (isset($_SESSION['login'])): ?>
			<h1>Criar Tópico</a></h1>

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

		<div>

			<table>

         		<th><?=$con_pub[0]['US_NAME'] . ':'?></th> 

				<th><a href="discussao.php"><?=$consulta[$i]['TOP_TITLE']?></a></th> 

				<td > <?=$consulta[$i]['TOP_SUBJECT']?></td>

				<td><?=$consulta[$i]['TOP_DATE']?></td>

			</table>

		</div>
		
		<?php endfor ?>

	</main>

	<?php include 'templates/footer.php'; ?>

</body>

</html>