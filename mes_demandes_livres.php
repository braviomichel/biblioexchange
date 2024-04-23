<?php
// Inclure les fichiers nécessaires
include_once 'Database/connect.php'; // Connexion à la base de données
include_once "Back-end/check_connection.php"; // Vérifier si l'utilisateur est connecté
include_once "Back-end/check_role.php"; // Vérifier le rôle de l'utilisateur
include_once 'Back-end/get_id.php'; // Obtenir l'ID de l'utilisateur actuellement connecté

// Fonction pour récupérer le nom et le prénom d'un utilisateur à partir de son ID
function getUserData($id_utilisateur, $conn)
{
    $sql = "SELECT nom_utilisateur, prenom_utilisateur FROM utilisateurs WHERE id_utilisateur = $id_utilisateur";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return "Utilisateur non trouvé";
    }
}

// Fonction pour récupérer le titre et l'auteur d'un livre à partir de son ID
function getLivreData($id_livre, $conn)
{
    $sql = "SELECT titre_livre, auteur FROM livres WHERE id_livre = $id_livre";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return "Livre non trouvé";
    }
}


// Récupérer les demandes de livres effectuées par l'utilisateur
$sql = "SELECT * FROM transactions WHERE id_emetteur = ? OR id_recepteur = ?"; // Requête SQL pour récupérer les demandes
$stmt = $mysqli->prepare($sql); // Préparer la requête
$stmt->bind_param("ii", $user_id, $user_id); // Lier le paramètre (ID utilisateur)
$stmt->execute(); // Exécuter la requête
$result_demandes = $stmt->get_result(); // Obtenir le résultat de la requête

$demandes = []; // Tableau pour stocker les demandes
if ($result_demandes->num_rows > 0) {
    while ($ligne = $result_demandes->fetch_assoc()) {
        $demandes[] = $ligne; // Ajouter chaque demande au tableau
    }
} else {
    $message = "Aucune demande trouvée."; // Message si aucune demande
}

$stmt->close(); // Fermer le statement
//$mysqli->close(); // Fermer la connexion à la base de données
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mes Demandes de Livres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Importer Bootstrap -->
</head>

<body>
    <?php include_once "header.php"; ?> <!-- Inclure l'en-tête -->

    <div class="container mt-5">
        <h2 class="mb-4">Mes Demandes de Livres</h2> <!-- Titre de la page -->
        <div class="row">
            <div class="col-md-12">
                <table class="table"> <!-- Table pour afficher les demandes -->
                    <thead>
                        <tr>
                            <th scope="col">Nature</th>
                            <th scope="col">Titre du Livre</th>
                            <!-- <th scope="col">Auteur</th> -->
                            <th scope="col">Date de Demande</th>
                            <th scope="col">Autre utilisateur impliqué</th>
                            <th scope="col">Livre proposé en contrepartie</th>
                            <th scope="col">État</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($demandes)): ?>
                            <?php foreach ($demandes as $demande): ?>
                                <?php
                                // Recupération des informations du ou des livres impliqués. 
                                $livreData = getLivreData($demande["id_livre_echange"], $mysqli);
                                $livre_echange_name = $livreData["titre_livre"];
                                $livre_echange_auteur = $livreData["auteur"];

                                if ($demande["id_livre_contrepartie"] == 0) {
                                    $livre_contrepartie = "En attente";
                                } else {
                                    // Recupération des informations du ou des livres impliqués. 
                                    $livreData = getLivreData($demande["id_livre_echange"], $mysqli);
                                    $livre_contrepartie = $livreData["titre_livre"];

                                }

                                // Autre utilisateur impliqué : 
                                if ($demande["id_emetteur"] == $user_id) {
                                    $nature = "Emis";
                                    $url = "book_detail.php?book_id=".$demande["id_livre_echange"]."&transaction"; //rediriger les détails du livre qu'il veut échanger
                                    $user_implied = getUserData($demande["id_recepteur"], $mysqli);
                                    $user_name = $user_implied["nom_utilisateur"] . " " . $user_implied["prenom_utilisateur"];
                                } else {
                                    $nature = "Recue";
                                    $url = "livres_utilisateur.php?user_id=".$demande["id_emetteur"]; //rediriger vers la section des livres de l'autre utilisateur pour choisir 
                                    $user_implied = getUserData($demande["id_emetteur"], $mysqli);
                                    $user_name = $user_implied["nom_utilisateur"] . " " . $user_implied["prenom_utilisateur"];
                                }

                                if ($demande["etape"] == 1) {
                                    $etape = "En attente de proposition de contrepartie";
                                } elseif ($demande["etape"] == 2) {
                                    $etape = "Contrepartie proposée. En attente de finalisation";
                                    
                                }
                                ?>
                                <tr>
                                    <td><?= $nature; ?></td> <!-- Afficher le titre du livre -->
                                    <td><?= $livre_echange_name; ?></td> <!-- Afficher le titre du livre -->
                                    <td><?= date("d/m/Y", strtotime($demande['date_transaction'])); ?></td>
                                    <!-- Afficher la date de demande -->
                                    <td><?= $user_name; ?></td>
                                    <!-- Afficher le nom et le prenom de l'autre utilisateur impliqué -->
                                    <td><?= $livre_contrepartie; ?></td>
                                    <!-- Afficher le nom du livre proposé en contrepartie et En attente dans le cas où on trouve 0 comme id -->
                                    <td><?= $etape; ?></td> <!-- Afficher l'état -->


                                    <td>
                                        <a href="<?= $url; ?>" class="btn btn-primary"><i
                                                class="fas fa-eye"></i><span class="sr-only"></span></a>
                                        <a href="#" class="btn btn-danger"><i
                                                class="fas fa-times"></i><span class="sr-only"></span></a>
                                        <!-- Pour la suppression, il faudra supprimer la transactions mais aussi les notifications y afférentes. -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6"> <!-- Message si aucune demande -->
                                    <div class="alert alert-info" role="alert">
                                        <?= $message; ?> <!-- Afficher le message -->
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table> <!-- Fin de la table -->
            </div>
        </div>
    </div>

    <?php include_once 'footer.php'; ?> <!-- Inclure le pied de page -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- Importer jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <!-- Importer Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Importer Bootstrap JS -->
</body>

</html>