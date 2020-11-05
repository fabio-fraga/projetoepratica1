<?php 

	include 'bd.php';

	session_start();

	$tp = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM TOPICS WHERE TOP_ID = ?");

    $stmt->execute([$tp]);

    header('location:home.php');

 ?>