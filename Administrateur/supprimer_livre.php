<?php
include_once '../Database/connect.php';
include_once "../Back-end/check_connection.php";
include_once "../Back-end/check_role.php";
include_once '../Back-end/get_id.php'; // get id and stores it in $user_id variable

// Vérifier si l'ID de l'utilisateur est défini
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer la requête SQL pour supprimer l'utilisateur
    $sql = "DELETE FROM livres WHERE id_livre = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);

        // Exécuter la requête
        if ($stmt->execute()) {
            $message = "Livre supprimé avec succès.";
            $errortype = "success";
        } else {
            $message = "Erreur lors de la suppression du Livre : " . $stmt->error;
            $errortype = "danger";
        }

        // Fermer la requête
        $stmt->close();
    } else {
        // Afficher une erreur si la préparation de la requête échoue
        $message = "Erreur lors de la préparation de la requête : " . $mysqli->error;
        $errortype = "danger";
    }

    // Fermer la connexion à la base de données
    $mysqli->close();

    // Rediriger vers la page de gestion des utilisateurs avec un message
    header("Location: bookManagement.php?message=" . urlencode($message) . "&errortype=" . $errortype);
    exit;
}
?>
