<?php

include_once '../../Database/connect.php';
include_once "../../Back-end/check_connection.php";
include_once "../../Back-end/check_role.php";
include_once '../../Back-end/get_id.php';

if ($user_id && isset($_POST['message']) && isset($_POST['id_sujet'])) {

    // Récupère les données de la requête XHR et les stocke dans des variables
    $message = $_POST['message'];
    $id_sujet = $_POST['id_sujet'];
    
    // Récupère l'identifiant de l'utilisateur connecté
    $from_id = $user_id;

    // Prépare la requête SQL
    $sql = "INSERT INTO forum_message (id_emmetteur, id_sujet, message) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    // Lie les paramètres et exécute la requête
    $stmt->bind_param("iis", $from_id, $id_sujet, $message);
    $res = $stmt->execute();

    // Vérifie si le message a été inséré avec succès
    if ($res) {
        // Affiche le message inséré
        ?>
        <p class="rtext align-self-end border rounded p-2 mb-1">
            <?= $message ?>  
            <small class="d-block"><?= date('Y-m-d H:i:s') ?></small>
        </p>
        <?php
    }
}
?>
