<?php 

include 'bd.php';

session_start();

$ld = substr($_GET['topid'], -1);

$stmt = $pdo->prepare("SELECT * FROM VOTE WHERE VOTE_US_ID = ? AND VOTE_TOP_ID = ?");

$stmt->execute([$_SESSION['login'], $ld]);

$linhas = $stmt->fetchAll();

	if ($linhas[0]['VOTE_VALUE'] == null) {

		if ($_GET['valor'] == 1){
		
			$stmt = $pdo->prepare("INSERT INTO VOTE (VOTE_US_ID, VOTE_TOP_ID, VOTE_VALUE) VALUES (?,?, true)");

			$stmt->execute([$_SESSION['login'], $ld]);	
	}
		if ($_GET['valor'] == 0){
		
			$stmt = $pdo->prepare("INSERT INTO VOTE (VOTE_US_ID, VOTE_TOP_ID, VOTE_VALUE) VALUES (?,?, false)");

			$stmt->execute([$_SESSION['login'], $ld]);	
	}
}
	else{

		$stmt = $pdo->prepare("DELETE FROM VOTE WHERE VOTE_TOP_ID = ?");

		$stmt->execute([$ld]);

}
header('location: discussao.php?id='. $_GET['topid']);
?>
