
<?php
session_start();
include 'bd.php';

$ld = $_GET['topid'];

$stmt = $pdo->prepare("
SELECT * FROM VOTE WHERE VOTE_TOP_ID = ? AND VOTE_US_ID = ?
         
");

$stmt->execute([$_GET['topid'],$_SESSION['login']]);

    $consulta = $stmt->fetchAll();
   
    if (isset($consulta[0]['VOTE_VALUE'])){
        $valor = $consulta[0]['VOTE_VALUE'];
    }else{
        $valor = null;
    }
    
    function getlike($id_topico){
        include 'bd.php';
        $stmt = $pdo->prepare(" SELECT COUNT(VOTE_ID) FROM VOTE WHERE VOTE_VALUE=1 AND VOTE_TOP_ID = ?");

        $stmt->execute([$id_topico]);

        $likes = $stmt->fetchAll();
        
        return $likes[0][0];

    }
    
    function getdislike($id_topico){
        include 'bd.php';
        $stmt = $pdo->prepare(" SELECT COUNT(VOTE_ID) FROM VOTE WHERE VOTE_VALUE=0 AND VOTE_TOP_ID = ?");
        
        $stmt->execute([$id_topico]);
        
        $dislikes = $stmt->fetchAll();
        // var_dump($dislikes);
        return $dislikes[0][0];
        
    }
    
    $lk = getlike($ld);
	$dlk = getdislike($ld);
  
    ?>
   
<div class="col-1 ml-n5">
<a id="like" href="<?="rating.php?topid=$ld&valor=1"?>" onclick="liker(event)"> <i class=" fa<?= $valor != null && $valor == '1' ? '' : 'r' ?> fa-thumbs-up"></i></a>		<p id="n-like"><?=$lk?></p>			
</div>
<div class="col-1">
<a id="dislike" href="<?="rating.php?topid=$ld&valor=0"?>" onclick="disliker(event)"><i class=" fa<?= $valor != null && $valor == '0' ? '' : 'r' ?> fa-thumbs-down"></i></a>	<p id="n-dislike"><?= $dlk ?></p>
</div>
<div class="col-9"></div>

   