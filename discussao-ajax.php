<?php

session_start();

include 'bd.php';

$stmt = $pdo->prepare("
    SELECT * FROM USERS INNER JOIN COMMENTS ON COM_US_ID = US_ID AND COM_TOP_ID = ? ORDER BY COM_DATE DESC
         
");

$stmt->execute([$_GET['id']]);

$consulta = $stmt->fetchAll();

?>

<?php for($i= 0; $i < sizeof($consulta); $i++): ?>

   <div class="container mt-3 mb-3 shadow border border-light rounded">

        <div class="row justify-content-center">
            <div class="col-2 pt-3 text-center">
                <?php if ($consulta[$i]['US_IMAGE'] == null || $consulta[$i]['US_IMAGE'] == 'upload/' . $_SESSION['login']): ?>
                    <a href="my_profile.php?id=<?=$consulta[$i]['COM_US_ID'] ?>">
                        <figure class="figure text-center">
                            <svg width="4.5em" height="4.5em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                                <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                            </svg>
                        <strong><figcaption class="figure-caption">Criado por <?= $consulta[$i]['US_NAME'] ?></figcaption></strong>
                        </figure>
                    </a>

                <?php else: ?>
                    <a href="my_profile.php?id=<?=$consulta[$i]['COM_US_ID'] ?>">
                        <figure class="figure text-center">
                            <img class="figure-img img-fluid rounded-circle w-50 h-50" src="<?= $consulta[$i]['US_IMAGE'] ?>"></a>
                         <strong><figcaption class="figure-caption">Criado por <?= $consulta[$i]['US_NAME'] ?></figcaption></strong>
                        </figure>
                <?php endif ?>
            </div>

            <div class="col-6 text-left pt-3"><?= $consulta[$i]["COM_CONTENT"] ?></div>

            <?php 

            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Recife');

            ?>
            <div class="col-2 text-right pt-3">Criado em: <?= strftime('%A, %e de %B de %Y', strtotime($consulta[$i]['COM_DATE'])) ?>
            </div>

            <?php if (isset($_SESSION['login']) && $consulta[$i]['COM_US_ID'] == $_SESSION['login']): ?>
                <div class="col-1">
                    <a href="editcom.php?id=<?= $consulta[$i]['COM_ID'] ?>">
                        <svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-pencil-square d-block m-auto pt-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                </div>

                <div class="col-1">
                    <a class="delete-com" href="delete_com.php?id=<?= $consulta[$i]['COM_ID'] ?>">
                        <svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-trash-fill d-block m-auto pt-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                        </svg>
                    </a>

                </div>
                            
                <?php else: ?>
                    <div class="col-2"></div>
                <?php endif ?>              
        </div>

        <?php if (!$consulta[$i]['COM_IMAGE'] == null && file_exists($consulta[$i]['COM_IMAGE'])): ?>
            <div class="row justify-content-center">                                
                <div class="col-12 text-center mt-3 pb-3">
                    <img src="<?= $consulta[$i]['COM_IMAGE'] ?>" class="m-auto" style="width: 80%; height: auto;">
                </div>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">                                
                <div class="col-12 text-center mt-3 pb-3"></div>
            </div>
        <?php endif ?>
         
    </div>

<?php endfor ?>
