<?php
// Vérifier si l'identifiant du livre est défini dans l'URL et n'est pas vide
if (isset($_GET['book_id']) && !empty($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    
    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "", "biblioexchange");

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données: " . $conn->connect_error);
    }

    // Préparer une requête pour récupérer les personnes intéressées par le livre donné
    $sql = "SELECT utilisateurs.nom_utilisateur, utilisateurs.prenom_utilisateur, utilisateurs.id_utilisateur
            FROM utilisateurs
            INNER JOIN transactions ON utilisateurs.id_utilisateur = transactions.id_emetteur
            WHERE transactions.id_livre = $book_id";

    // Exécuter la requête
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Personnes Intéressées</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Liste des Personnes Intéressées</h1>
        <ul class="list-group">
            <?php
            // Afficher la liste des personnes intéressées
            while ($row = $result->fetch_assoc()) {
                echo '<li class="list-group-item">';
                echo '<a href="proposed_books.php?user_id=' . $row['id_utilisateur'] . '">';
                echo $row['prenom_utilisateur'] . ' ' . $row['nom_utilisateur'];
                echo '</a>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>
</body>
</html>
<?php
    } else {
        echo "Aucune personne n'est intéressée par ce livre pour le moment.";
    }
    // Fermer la connexion à la base de données
    $conn->close();
} else {
    echo "Identifiant de livre non valide";
}
?>
