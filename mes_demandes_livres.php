<?php
// Inclure les fichiers nécessaires
include_once 'Database/connect.php'; // Connexion à la base de données
include_once "Back-end/check_connection.php"; // Vérifier si l'utilisateur est connecté
include_once "Back-end/check_role.php"; // Vérifier le rôle de l'utilisateur
include_once 'Back-end/get_id.php'; // Obtenir l'ID de l'utilisateur actuellement connecté

// Récupérer les demandes de livres effectuées par l'utilisateur
$sql = "SELECT d.id, l.titre_livre, l.auteur, d.date_demande, d.etat 
        FROM demandes d
        JOIN livres l ON d.id_livre = l.id_livre
        WHERE d.id_utilisateur = ?"; // Requête SQL pour récupérer les demandes
$stmt = $mysqli->prepare($sql); // Préparer la requête
$stmt->bind_param("i", $user_id); // Lier le paramètre (ID utilisateur)
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
$mysqli->close(); // Fermer la connexion à la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Demandes de Livres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Importer Bootstrap -->
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
                            <th scope="col">ID</th>
                            <th scope="col">Titre du Livre</th>
                            <th scope="col">Auteur</th>
                            <th scope="col">Date de Demande</th>
                            <th scope="col">État</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($demandes)): ?>
                            <?php foreach ($demandes as $demande): ?>
                                <tr>
                                    <td><?= $demande['id']; ?></td> <!-- Afficher l'ID de la demande -->
                                    <td><?= $demande['titre_livre']; ?></td> <!-- Afficher le titre du livre -->
                                    <td><?= $demande['auteur']; ?></td> <!-- Afficher l'auteur -->
                                    <td><?= date("d/m/Y", strtotime($demande['date_demande'])); ?></td> <!-- Afficher la date de demande -->
                                    <td><?= $demande['etat']; ?></td> <!-- Afficher l'état -->
                                    <td>
                                        <!-- Actions pour annuler ou voir les détails -->
                                        <a href="annuler_demande.php?id=<?= $demande['id']; ?>" class="btn btn-danger"><i class="fas fa-times"></i> Annuler</a>
                                        <a href="voir_demande.php?id=<?= $demande['id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i> Voir</a>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> <!-- Importer Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Importer Bootstrap JS -->
</body>
</html>
