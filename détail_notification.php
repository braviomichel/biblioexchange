<?php
// Inclure les fichiers nécessaires
include_once 'Database/connect.php';
include_once 'Back-end/check_connection.php';

// Obtenir l'ID de la notification depuis les paramètres GET
$notification_id = $_GET['notification_id'] ?? 0;

if ($notification_id == 0) {
    die("Notification ID invalide");
}

// Préparer la requête SQL pour récupérer les détails de la notification
$sql = "SELECT n.id, n.Title, n.messages, u.nom_utilisateur, u.prenom_utilisateur, n.id_emetteur
        FROM notifications n
        JOIN utilisateurs u ON n.id_emetteur = u.id_utilisateur
        WHERE n.id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $notification_id);
$stmt->execute();
$result = $stmt->get_result();

$notification = $result->fetch_assoc();

if (!$notification) {
    die("Notification non trouvée");
}

$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Notification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include_once "header.php"; ?> <!-- Inclure l'en-tête -->
    <div class="container">
        <h2>Détails de la Notification</h2>
        <p><strong>Titre:</strong> <?= $notification['Title']; ?></p>
        <p><strong>Message:</strong> <?= $notification['messages']; ?></p>
        <p><strong>De:</strong> <?= $notification['nom_utilisateur'] . " " . $notification['prenom_utilisateur']; ?></p>

        <?php if (isset($notification['id_emetteur'])): ?>
            <a href="livres_utilisateur.php?user_id=<?= $notification['id_emetteur']; ?>" class="btn btn-primary">Voir les livres de <?= $notification['nom_utilisateur']; ?></a>
        <?php else: ?>
            <p>Impossible de trouver l'ID de l'émetteur.</p>
        <?php endif; ?>
    </div>
    <?php include_once 'footer.php'; ?> <!-- Inclure le pied de page -->
</body>
</html>
