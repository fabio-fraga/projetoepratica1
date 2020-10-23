<?php 

include 'templates/header.php';

include 'bd.php';

$stmt = $pdo->prepare("
	SELECT * FROM USERS
	WHERE US_ID = ?
");

$stmt->execute([$_SESSION['login']]);

$linhas = $stmt->fetchAll();

$_SESSION['name'] = $linhas[0]['US_NAME'];

$user = 'Olá, ' . $_SESSION['name'] . '!';

?>

<?php if (isset($_SESSION['login'])): ?>
	<h1 style="text-align: center; margin: auto; padding-top: 10%; padding-bottom: 32.9%"><?= $user ?></h1>
<?php else: ?>
	<h1 style="text-align: center; margin: auto; padding-top: 10%; padding-bottom: 32.9%">Olá!</h1>
<?php endif ?>

<?php 

$stmt = $pdo->prepare("
	SELECT * FROM TOPICS
");

$stmt->execute();

$linhas = $stmt->fetchAll();

$subject = $linhas[0]['TOP_SUBJECT'];
$title = $linhas[0]['TOP_TITLE'];
$date = $linhas[0]['TOP_DATE'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bem-vindo ao F4ALL!</title>
			
		<?php if (isset($_SESSION['login'])): ?>
			<h1 style="margin-top: -27%; text-align: center;"><a href="create_topic.php">Criar Tópico</a></h1>
		<?php endif ?>
			<h1 style="text-align: center;">Tópicos</h1>
			<table style="padding-left: 37.3%; padding-bottom: 15%">
				<tr>
					<th style="border: 1px solid black"><?= $subject ?></th>					
					<td style="border: 1px solid black"><?= $title ?></td>
					<td style="border: 1px solid black"><?= $date ?></td>

				</tr>
			</table>

<?php

include 'templates/footer.php';

?>