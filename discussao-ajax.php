<?php

include'bd.php';



        $stmt = $pdo->prepare("
            SELECT * FROM USERS INNER JOIN COMMENTS ON COM_US_ID = US_ID AND COM_TOP_ID = ? ORDER BY COM_DATE
         
    ");

    $stmt->execute([$_GET['id']]);

    $consulta = $stmt->fetchAll();

    ?>

    <?php for($i= 0; $i < sizeof($consulta); $i++): ?>
            <?php if ($consulta[$i]['US_IMAGE'] == null): ?>
                    <svg width="3em" height="3em" viewBox="0 0 20 20" class="bi bi-person-circle d-block m-auto" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                        <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                    </svg>
                <?php else: ?>
                        <img class="img-topics rounded-circle m-auto" src="<?= $consulta[$i]['US_IMAGE'] ?>">
                <?php endif ?>

            <div class="container mt-5 ">
                <p><?= $consulta[$i]['US_NAME'] . ':'; ?></p>
                <div class="col-3 text-right pt-3">Criado
                    <time class="timeago" datetime="<?= date('Y-m-d H:i:s', strtotime($consulta[$i]['COM_DATE'])) ?>"></time>
                </div>
                <p><?= $consulta[$i]["COM_CONTENT"]; ?></p>
            </div>
            

    <?php endfor ?>
