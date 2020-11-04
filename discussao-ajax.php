<?php

include'bd.php';



        $stmt = $pdo->prepare("
            SELECT * FROM USERS INNER JOIN COMMENTS ON COM_US_ID = US_ID AND COM_TOP_ID = ?
         
    ");

    $stmt->execute([$_GET['id']]);

    $consulta = $stmt->fetchAll();

    ?>

    <?php for($i= 0; $i < sizeof($consulta); $i++): ?>

            <table style="text-align: center">
                <th><?= $consulta[$i]['US_NAME'] . ':'; ?></th>
                <td><?= $consulta[$i]["COM_CONTENT"]; ?></td>
            </table>

    <?php endfor ?>
