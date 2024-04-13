<?php
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Échange de Livres</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            <!-- Notification 1 -->
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Nouvelle réponse à votre sujet</h5>
                    <small>Il y a 1 heure</small>
                </div>
                <p class="mb-1">Votre sujet "Titre du sujet" a reçu une nouvelle réponse de l'utilisateur1.</p>
                <small>Par: Utilisateur1</small>
            </a>
            <!-- Notification 2 -->
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Nouvel événement à venir</h5>
                    <small>Il y a 3 jours</small>
                </div>
                <p class="mb-1">Un nouvel événement intitulé "Nom de l'événement" est prévu pour la semaine prochaine.</p>
                <small>Par: Admin</small>
            </a>
            <!-- Ajouter d'autres notifications ici -->
        </div>
    </main>
    <?php include_once 'footer.php'; ?>
    <!-- Bootstrap JS et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
