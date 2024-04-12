<?php
include_once "../Database/connect.php";
include_once "../Back-end/check_connection.php";
include_once "../Back-end/check_role.php";

// Requête SQL préparée pour récupérer les informations de l'utilisateur à partir de la table utilisateurs
$sql_user = "SELECT * FROM signalement";
$stmt_user = $mysqli->prepare($sql_user);
$stmt_user->execute();
$result_user = $stmt_user->get_result();


// Vérifier si un bouton a été cliqué
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $signalement_id = $_POST['signalement_id'];

    // Mettre à jour la base de données en fonction de l'action choisie
    if ($action == 'marquer_traite') {
        // Code pour marquer le signalement comme traité dans la base de données
        $sql = "UPDATE signalement SET statut = 'Traité' WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $signalement_id);
        $stmt->execute();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;

    } elseif ($action == 'supprimer_contenu') {
        // Code pour supprimer le contenu signalé dans la base de données
        $sql = "DELETE FROM signalement WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $signalement_id);
        $stmt->execute();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Signalements - BiblioExchange Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles pour la page de gestion des signalements */
        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .admin-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .report-list {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            overflow-y: auto;
            max-height: 500px;
        }

        .report-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .report-item h3 {
            margin-top: 0;
        }

        .report-item p {
            margin-bottom: 5px;
        }

        .action-buttons {
            margin-top: 10px;
        }

        /* Style pour aligner les formulaires côte à côte */
        .action-buttons form {
            display: inline-block;
            margin-right: 10px;
            /* Ajustez la marge entre les formulaires selon vos besoins */
        }
    </style>
</head>

<body>
    <?php include_once "header.php"; ?>
    <div class="admin-container">
        <h1>Gestion des Signalements</h1>

        <div class="report-list">
            <?php
            // Vérifier s'il y a des signalements
            if ($result_user->num_rows > 0) {
                while ($ligne = $result_user->fetch_assoc()) {
                    // Récuperer le nom et le prenom : 
            
                    $sql = "SELECT nom_utilisateur, prenom_utilisateur FROM utilisateurs where id_utilisateur = ?";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param("i", $ligne["id_utilisateur"]);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_assoc();
                    $nom = $data["nom_utilisateur"];
                    $prenoms = $data["prenom_utilisateur"];


                    echo '<div class="report-item">';
                    echo '<h3>Signalement #' . $ligne["id"] . '</h3>'; // Assurez-vous que "id" est le nom de la colonne contenant l'identifiant unique du signalement
                    echo '<p>Utilisateur: ' . $nom . " " . $prenoms . '</p>'; // Assurez-vous que "utilisateur" est le nom de la colonne contenant le nom de l'utilisateur qui a signalé
                    echo '<p>Date et heure: ' . $ligne["date_time"] . '</p>'; // Assurez-vous que "date_heure" est le nom de la colonne contenant la date et l'heure du signalement
                    echo '<p>Raison: ' . $ligne["raison"] . '</p>'; // Assurez-vous que "raison" est le nom de la colonne contenant la raison du signalement
                    echo '<p>Status: ' . $ligne["statut"] . '</p>'; // Assurez-vous que "raison" est le nom de la colonne contenant la raison du signalement
                    echo '<div class="action-buttons">';
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="signalement_id" value="' . $ligne["id"] . '">';
                    echo '<input type="hidden" name="action" value="marquer_traite">';
                    echo '<button type="submit" class="btn btn-primary">Marquer comme traité</button>';
                    echo '</form>';
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="signalement_id" value="' . $ligne["id"] . '">';
                    echo '<input type="hidden" name="action" value="supprimer_contenu">';
                    echo '<button type="submit" class="btn btn-danger">Supprimer le contenu</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Aucun signalement trouvé.";
            }
            ?>
            <!-- Ajoutez d'autres éléments de signalement ici -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<footer class="bg-dark text-white py-4">
    <style>
        /* Styles supplémentaires */
        .useful-links a {
            color: #fff;
            /* Couleur des liens utiles en blanc */
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Liens utiles</h5>
                <ul class="list-unstyled useful-links">
                    <li><a href="userManagement.html"><i class="fas fa-users"></i> Gestion des Utilisateurs</a></li>
                    <li><a href="bookManagement.html"><i class="fas fa-book"></i> Gestion des Livres</a></li>
                    <li><a href="messageManagement.html"><i class="fas fa-envelope"></i> Gestion des Messages</a></li>
                    <li><a href="reportManagement.html"><i class="fas fa-exclamation-triangle"></i> Gestion des
                            Signalements</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i>Parametres</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>Contactez-nous</h5>
                <ul class="list-unstyled">
                    <li>Adresse: 123 Rue de la Bibliothèque, Kénitra</li>
                    <li>Téléphone: +123 456 789</li>
                    <li>Email: contact@biblioexchange.com</li>
                </ul>
            </div>
        </div>

        <p class="text-center">&copy; 2024 BiblioExchange. Tous droits réservés.</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</footer>

</html>