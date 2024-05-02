<?php
include_once '../../Database/connect.php';
include_once "../../Back-end/check_connection.php";
include_once "../../Back-end/check_role.php";
include_once '../../Back-end/get_id.php';

# Vérifie si l'utilisateur est connecté
if (isset($_GET['id_sujet'])) {
    $id_1 = $user_id;
    $id_sujet = $_GET['id_sujet'];

    // Prépare la requête SQL
    $sql = "SELECT * FROM forum_message
            WHERE id_emmetteur = ? AND id_sujet = ?
            ORDER BY id ASC";
    $stmt = $mysqli->prepare($sql);
    // Lie les paramètres et exécute la requête
    $stmt->bind_param("ii", $id_1, $id_sujet);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifie s'il y a des résultats
    if ($result->num_rows > 0) {
        // Boucle à travers les messages
        while ($chat = $result->fetch_assoc()) {
            ?>
            <p class="ltext border rounded p-2 mb-1">
                <?= $chat['message'] ?>
                <small class="d-block">
                    <?= $chat['created_at'] ?>
                </small>
            </p>
            <?php
        }
    } else {
        echo "Aucun message trouvé";
    }
} 
?>
