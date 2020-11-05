<?php 

	include 'bd.php';

	session_start();

	$erase = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM COMMENTS WHERE COM_TOP_ID = ?");

    $stmt->execute([$erase]);

 ?>
<?php 

	$stmt = $pdo->prepare("DELETE FROM VOTE WHERE VOTE_TOP_ID = ?");

    $stmt->execute([$erase]);

?>
<?php 


    $stmt = $pdo->prepare("DELETE FROM TOPICS WHERE TOP_ID = ?");

    $stmt->execute([$erase]);

    header('location:home.php');

?>