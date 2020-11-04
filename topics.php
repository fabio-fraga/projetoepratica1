<?php
session_start();
include 'bd.php';

// $_SESSION['id'] = $linhas[0]['US_ID'];

$subject = nl2br(htmlentities( $_POST['subject']));
$title = htmlentities($_POST['title']);
$date = date("Y-m-d H:i:s");
$user = $_SESSION['login'];


 $stmt = $pdo->prepare("
    INSERT INTO TOPICS( TOP_SUBJECT, TOP_TITLE, TOP_DATE, TOP_US_ID)
VALUES (?,?,?,?)
    ");

$stmt->execute([$subject, $title, $date, $user]);


header('location: home.php');


 ?>
