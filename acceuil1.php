<?php
include_once "Back-end/connexion.php";

// Votre code ici

// Exemple de requête pour récupérer des livres depuis la base de données
$query = "SELECT * FROM livres";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Afficher les données sous forme de cartes de livres
    while ($row = $result->fetch_assoc()) {
        echo '<div class="book-card">';
        echo '<img src="' . $row["image_url"] . '" alt="' . $row["titre"] . '">';
        echo '<div class="book-info">';
        echo '<h5>' . $row["titre"] . '</h5>';
        echo '<p>Auteur: ' . $row["auteur"] . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "Aucun livre trouvé dans la base de données.";
}

// Fermer la connexion à la base de données
$conn->close();
?>
<?php
include_once "Database/connect.php";

// Connexion à la base de données
$conn = new mysqli($host, $user, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>
