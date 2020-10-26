<?php
session_start();
include 'bd.php';

// $_SESSION['id'] = $linhas[0]['US_ID'];

$subject = $_POST['subject'];
$title = $_POST['title'];
$date = date("Y-m-d H:i:s");
$user = $_SESSION['login'];


 $stmt = $pdo->prepare("
    INSERT INTO TOPICS( TOP_SUBJECT, TOP_TITLE, TOP_DATE, TOP_US_ID)
VALUES (?,?,?,?)
    ");

$stmt->execute([$subject, $title, $date, $user]);




// var_dump($title,
// $subject,
// $date,
// $user);

header('location: pub.php');


 ?>
