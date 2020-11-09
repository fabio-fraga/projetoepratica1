<?php
 	include 'bd.php';

	session_start();

	$id_com = $_GET['id'];
	$top_id = $_GET['top-id'];

    $stmt = $pdo->prepare("DELETE FROM COMMENTS WHERE COM_ID = ?");

    $stmt->execute([$id_com]);

    var_dump($id_com,
$top_id);
    header('location:discussao.php?id='.$top_id);
?>