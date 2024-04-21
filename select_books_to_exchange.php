<?php
// Vérifier si l'identifiant de l'utilisateur est défini dans l'URL et n'est pas vide
if (!isset($_GET['user_id']) && empty($_GET['user_id'])) {
    include_once "Back-end/get_id.php";
    
    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "", "biblioexchange");

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données: " . $conn->connect_error);
    }

    // Préparer une requête pour récupérer les livres proposés par l'utilisateur
    $sql = "SELECT * FROM livres WHERE owner_id = $user_id";

    // Exécuter la requête
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sélection des Livres à Échanger</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ajoutez vos styles CSS personnalisés ici */
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Sélection des Livres à Échanger</h1>
        <form action="process_exchange.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="form-group">
                <label for="books">Sélectionnez les livres à échanger:</label>
                <select multiple class="form-control" id="books" name="books[]">
                    <?php
                    // Afficher la liste des livres proposés par l'utilisateur
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_livre'] . '">' . $row['titre_livre'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Valider la Proposition d'Échange</button>
        </form>
    </div>
</body>
</html>
<?php
        } else {
            echo "Aucun livre proposé par cet utilisateur pour le moment.";
        }
    } else {
        echo "Erreur lors de la récupération des données des livres proposés.";
    }
    // Fermer la connexion à la base de données
    $conn->close();
} else {
    echo "Identifiant d'utilisateur non valide";
}
?>
