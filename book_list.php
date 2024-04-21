<?php
    include_once "Back-end/get_id.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Livres</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Votre CSS personnalisé ici */
        .book-cover {
            max-width: 100px; /* Largeur maximale de la miniature */
            height: auto; /* Hauteur automatique pour conserver les proportions */
            display: block; /* Pour centrer l'image horizontalement */
            margin: 0 auto; /* Pour centrer l'image horizontalement */
            margin-bottom: 10px; /* Espacement sous l'image */
        }
    </style>
</head>
<body>
    <?php include_once "header.php"; ?>
    <div class="container">
        <h1>Liste des Livres</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Couverture</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Année de Publication</th>
                    <th>État</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Informations de connexion à la base de données
                $host = 'localhost'; 
                $user = 'root'; 
                $password = ''; 
                $database = 'biblioexchange'; 

                // Connexion à la base de données
                $mysqli = new mysqli($host, $user, $password, $database);

                // Vérifier la connexion
                if ($mysqli->connect_error) {
                    die("La connexion a échoué: " . $mysqli->connect_error);
                }

                // Récupérer l'ID de l'utilisateur actuellement connecté (à remplacer par votre propre méthode)
                $currentUserId = $user_id; // Exemple d'ID d'utilisateur actuellement connecté
                
                // Récupérer les livres depuis la base de données en excluant ceux de l'utilisateur actuellement connecté
                $sql = "SELECT * FROM livres WHERE owner_id != $currentUserId and disponible = 1 ORDER BY année_de_publication ASC";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        // Afficher l'image miniaturisée devant chaque livre
                        echo "<td><img class='book-cover' src='uploads/".$row['couverture']."' alt='Couverture du livre'></td>";
                        echo "<td>".$row['titre_livre']."</td>";
                        echo "<td>".$row['auteur']."</td>";
                        echo "<td>".$row['année_de_publication']."</td>";
                        // Vérifier si le livre est disponible et afficher l'état en conséquence
                        echo "<td>".(!empty($row['disponible']) && $row['disponible'] == 1 ? 'Disponible' : 'Échanger')."</td>";
                        echo "<td><a href='book_detail.php?book_id=".$row['id_livre']."' class='btn btn-primary'>Détails</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>0 résultats</td></tr>";
                }
                $mysqli->close();
                ?>
            </tbody>
        </table>
        
    </div>
    <?php include_once 'footer.php'; ?>
</body>
</html>
