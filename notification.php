<?php
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once "Back-end/get_id.php";

// Get all notifications from the db : 
$sql = "SELECT * FROM notifications WHERE id_recepteur = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_user = $stmt->get_result();

if ($result_user->num_rows > 0) {
    $notifications = array();
    while ($notification = $result_user->fetch_assoc()) {
        $notifications[] = $notification;
    }
} else {
    //echo "Aucune notification trouvée.";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Échange de Livres</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- CSS personnalisé -->
    <style>
        .notification-item {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php include_once "header.php"; ?>
    </div>
    <header class="bg-white text-dark py-4">
        <div class="container">
            <h1 class="mb-0">Notifications</h1>
        </div>
    </header>
    <main class="container py-4">
        <div class="list-group">
        <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                    <a href="mes_demandes_livres.php" class="list-group-item list-group-item-action notification-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= $notification['Title'] ?></h5>
                            <small><?= $notification['date_time'] ?></small>
                        </div>
                        <p class="mb-1"><?= $notification['messages'] ?></p>
                        <?php
                        // Récupérer le nom de l'utilisateur qui a envoyé la demande.
                        $sql = "SELECT * FROM utilisateurs WHERE id_utilisateur = ?";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->bind_param("i", $notification['id_emetteur']);
                        $stmt->execute();
                        $result_user = $stmt->get_result();

                        if ($result_user->num_rows > 0) {
                            $user = $result_user->fetch_assoc();
                        } else {
                            echo "Aucun user trouvé.";
                        }
                        ?>
                        <small>Par: <?php echo $user['nom_utilisateur'] . " " . $user['prenom_utilisateur']; ?></small>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info" role="alert">
                    Aucune notification trouvée.
                </div>
            <?php endif; ?>
        </div>
    </main>
    <?php include_once 'footer.php'; ?>
    <!-- Bootstrap JS et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php

$stmt->close();
$mysqli->close();

?>

</html>