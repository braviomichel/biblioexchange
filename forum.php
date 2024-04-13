<?php
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Échange de Livres</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="header">
                <?php include_once "header.php"; ?>
            </div>
    <header class="bg-white text-dark py-4">
        <div class="container">
            <h1 class="mb-0">Forum</h1>
        </div>
    </header>
    <main class="container py-4">
        <div class="row">
            <div class="col-md-8">
                <!--- Liste des sujets de discussion --->
                <h2>Liste des Sujets</h2>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">Titre du Sujet 1</h5>
                        <small class="text-muted">Auteur: Utilisateur1 | Réponses: 5 | Dernière réponse: 2024-03-30</small>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">Titre du Sujet 2</h5>
                        <small class="text-muted">Auteur: Utilisateur2 | Réponses: 5 | Dernière réponse: 2024-03-30</small>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">Titre du Sujet 2</h5>
                        <small class="text-muted">Auteur: Utilisateur3 | Réponses: 5 | Dernière réponse: 2024-03-30</small>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">Titre du Sujet 3</h5>
                        <small class="text-muted">Auteur: Utilisateur4 | Réponses: 5 | Dernière réponse: 2024-03-30</small>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">Titre du Sujet 4</h5>
                        <small class="text-muted">Auteur: Utilisateur5 | Réponses: 5 | Dernière réponse: 2024-03-30</small>
                    </a>
                    <!-- Ajouter d'autres sujets de discussion ici -->
                </div>
            </div>
            <div class="col-md-4">
                <!-- Widgets supplémentaires -->
                <h2>Widgets Supplémentaires</h2>
                <!-- Widget 1 : Sondages -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Sondages</h5>
                        <p class="card-text">Participez à nos sondages et partagez votre opinion sur divers sujets.</p>
                        <a href="#" class="btn btn-primary">Voir les sondages</a>
                    </div>
                </div>
                <!-- Widget 2 : Événements à venir -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Événements à venir</h5>
                        <p class="card-text">Découvrez les événements à venir et ne manquez pas nos activités communautaires.</p>
                        <a href="#" class="btn btn-primary">Voir les événements</a>
                    </div>
                </div>
                <!-- Widget 3 : Messages épinglés -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Messages épinglés</h5>
                        <p class="card-text">Consultez nos messages épinglés pour obtenir des informations importantes et des annonces.</p>
                        <a href="#" class="btn btn-primary">Voir les messages</a>
                    </div>
                </div>
                <!-- Widget 4 : Dernières activités -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Dernières Activités</h5>
                        <p class="card-text">Restez informé des dernières activités sur le forum.</p>
                        <a href="#" class="btn btn-primary">Voir les activités</a>
                    </div>
                </div>
                <!-- Widget 7 : Membres en ligne -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Membres en ligne</h5>
                        <p class="card-text">Consultez la liste des membres actuellement en ligne.</p>
                        <a href="#" class="btn btn-primary">Voir les membres</a>
                    </div>
                </div>
                <!-- Widget 10 : Suggestions de sujets -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Suggestions de Sujets</h5>
                        <p class="card-text">Découvrez des sujets de discussion populaires ou pertinents.</p>
                        <a href="#" class="btn btn-primary">Voir les suggestions</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once 'footer.php'; ?>
    <!-- Bootstrap JS et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
