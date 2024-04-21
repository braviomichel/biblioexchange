<?php
// Vérifier si l'identifiant du livre est défini dans l'URL et n'est pas vide
if (isset($_GET['book_id']) && !empty($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    include_once "Back-end/get_id.php";
    
    // Récupérer les détails du livre depuis la base de données
    $host = 'localhost'; 
    $user = 'root'; 
    $password = ''; 
    $database = 'biblioexchange'; 

    // Connexion à la base de données
    $conn = new mysqli($host, $user, $password, $database);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }

    // Préparer une requête sécurisée pour éviter les injections SQL
    $stmt = $conn->prepare("SELECT * FROM livres WHERE id_livre = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Détails du Livre</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Votre CSS personnalisé ici */
        .book-cover {
            max-width: 300px; /* Taille maximale de l'image */
            height: auto;
            transition: transform 0.3s ease-in-out; /* Transition sur l'effet hover */
        }

        .book-cover:hover {
            transform: scale(1.1); /* Zoom de 10% sur l'effet hover */
        }

        .book-cover-container {
            width:auto; /* Taille du conteneur carré */
            height: auto;
            overflow: hidden; /* Masquer les parties de l'image qui dépassent */
            margin-bottom: autopx; /* Espacement sous l'image */
        }

        .book-cover-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ajuster l'image pour remplir le conteneur carré */
        }
    </style>
</head>
<body>
    <?php include_once "header.php"; ?>
    <div class="container mb-2">
        <h1>Détails du Livre</h1>
        <?php
            // Afficher l'image du livre
            if (!empty($row['couverture'])) {
                echo "<div class='book-cover-container'>";
                echo "<img class='book-cover' src='uploads/".htmlspecialchars($row['couverture'], ENT_QUOTES, 'UTF-8')."' alt='Couverture du livre'>";
                echo "</div>";
            } else {
                echo "<p>Image non disponible</p>";
            }
        ?>
        <h2><?php echo htmlspecialchars($row['titre_livre'], ENT_QUOTES, 'UTF-8'); ?></h2>
        <p><strong>Auteur:</strong> <?php echo htmlspecialchars($row['auteur'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Résumé:</strong> <?php echo htmlspecialchars($row['resume'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Année de Publication:</strong> <?php echo htmlspecialchars($row['année_de_publication'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Catégorie:</strong> <?php echo htmlspecialchars($row['categorie'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>État:</strong> <?php echo (!empty($row['disponible']) && $row['disponible'] == 1) ? 'Disponible' : 'Échanger'; ?></p>
        <!-- Bouton pour proposer un échange avec redirection vers la page echange.php -->
        <a href="create_notification.php?book_id=<?php echo $book_id; ?>&action=exchange" class="btn btn-success">Manifester son intérêt</a>
        <a href="book_list.php" class="btn btn-primary">Retour à la Liste des Livres</a>
    </div>
    <?php include_once 'footer.php'; ?>
</body>
</html>
<?php
    } else {
        echo "Livre non trouvé";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Identifiant de livre non valide";
}
?>
