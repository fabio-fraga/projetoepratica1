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

include 'templates/footer.html';

?>