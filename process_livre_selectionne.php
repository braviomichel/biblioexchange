<?php
// Inclure les fichiers nécessaires
include_once 'Database/connect.php';
include_once 'Back-end/check_connection.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si un livre a été sélectionné
    if (isset($_POST['selected_book'])) {
        // Récupérer l'ID du livre sélectionné
        $selected_book_id = (int)$_POST['selected_book'];

        // Requête SQL pour récupérer les détails du livre sélectionné
        $sql = "SELECT l.titre_livre, l.auteur, l.année_de_publication, l.couverture
                FROM livres l
                WHERE l.id_livre = ?";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $selected_book_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Vérifier si le livre existe
        if ($result->num_rows > 0) {
            $livre = $result->fetch_assoc(); // Récupérer les détails du livre

            // Afficher les détails du livre
            echo '<div class="container mt-5">';
            echo '<h2>Livre sélectionné</h2>';
            echo '<div class="card">';
            echo '<img src="uploads/' . $livre['couverture'] . '" class="card-img-top" alt="Couverture">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $livre['titre_livre'] . '</h5>';
            echo '<p class="card-text">Auteur: ' . $livre['auteur'] . '</p>';
            echo '<p class="card-text">Année de publication: ' . $livre['année_de_publication'] . '</p>';
            echo '</div></div></div>';
        } else {
            echo '<div class="container mt-5">';
            echo '<div class="alert alert-danger">Le livre sélectionné n\'existe pas.</div>';
            echo '</div>';
        }

        $stmt->close();
    } else {
        echo '<div class="container mt-5">';
        echo '<div class="alert alert-danger">Aucun livre sélectionné.</div>';
        echo '</div>';
    }
}
?>

