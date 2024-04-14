<?php
// Connexion à la base de données
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération du terme de recherche depuis l'URL
$searchTerm = $_GET['search'];

// Requête SQL pour rechercher les livres correspondant au terme de recherche
$sql = "SELECT * FROM livres WHERE titre_livre LIKE '%$searchTerm%' OR auteur LIKE '%$searchTerm%'";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
</head>
<body>
    <h1>Résultats de la recherche pour "<?php echo $searchTerm; ?>"</h1>

    <?php
    if ($result->num_rows > 0) {
        // Afficher les résultats s'il y en a
        while ($row = $result->fetch_assoc()) {
            echo "<p>Titre: " . $row["titre_livre"] . " | Auteur: " . $row["auteur"] . "</p>";
        }
    } else {
        // Aucun résultat trouvé
        echo "<p>Aucun résultat trouvé pour \"" . $searchTerm . "\"</p>";
    }
    ?>

    <?php
    // Fermeture de la connexion
    $conn->close();
    ?>
</body>
</html>
