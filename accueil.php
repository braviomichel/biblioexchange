<?php
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once "Back-end/get_id.php";


?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - BiblioExchange</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
    <style>
    .card {
      width: 200px;
      margin-bottom: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.5s, box-shadow 0.5s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }

    .card-img-top {
      height: 150px; /* Ajustez la hauteur des images selon vos besoins */
      object-fit: cover; /* Pour conserver le ratio de l'image et remplir la div */
    }
  </style>
</head>
<body>
   <div class="header">
        <?php include_once "header.php"; ?>
    </div>
  <section class="banner bg-success text-white py-5">
            <div class="container">
                <h2 class="mb-4">Échangez vos livres facilement</h2>
                <p class="lead mb-4">Découvrez une nouvelle façon de partager vos livres préférés avec d'autres lecteurs
                    passionnés.</p>
                <a href="book_list.php" class="btn btn-outline-light btn-lg">Commencer</a>
            </div>
  </section>
<section class="banner  text-dark py-5">
  <div class="container mt-5">
    <h1 class="text-center">Livres disponibles</h1>
     <?php
      // Connexion à la base de données
      $mysqli = new mysqli("localhost", "root", "", "biblioexchange");

      // Vérification de la connexion
      if ($mysqli->connect_error) {
          die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
      }

      // Requête pour récupérer les catégories de livres
      $categories_query = "SELECT DISTINCT categorie FROM livres";
      $categories_result = $mysqli->query($categories_query);

      // Affichage des livres par catégories
      while ($category_row = $categories_result->fetch_assoc()) {
        echo '<h2>' . $category_row['categorie'] . '</h2>';
        echo '<div class="row">';
        
        // Requête pour récupérer les livres de la catégorie actuelle
        $livres_query = "SELECT * FROM livres WHERE owner_id != $user_id AND categorie = '" . $category_row['categorie'] . "' AND disponible = 1";
        $livres_result = $mysqli->query($livres_query);

        // Affichage des livres sous forme de cards
        while ($row = $livres_result->fetch_assoc()) {
          echo '<div class="col-md-4 mb-4">';
          echo '<div class="card">';
          echo '<img src="uploads/' . $row['couverture'] . '" class="card-img-top" alt="' . $row['titre_livre'] . '">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $row['titre_livre'] . '</h5>';
          echo '<p class="card-text">' . $row['auteur'] . '</p>';
          echo '<a href="book_detail.php?book_id=' . $row['id_livre'] . '" class="btn btn-primary">Voir détails</a>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }

        echo '</div>'; // Fin de la row
      }

      // Fermeture de la connexion à la base de données
      $mysqli->close();
    ?>
  </div>
</section>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<div class="footer">
    <?php include_once 'footer.php'; ?>
</div>
</html>
