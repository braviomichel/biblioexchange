<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sélectionner des livres à échanger - BiblioExchange</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1 class="text-center">Sélectionner des livres à échanger</h1>
    <form action="process_exchange.php" method="post">
      <?php
        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "biblioexchange");

        // Vérification de la connexion
        if ($mysqli->connect_error) {
            die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
        }

        // Requête pour récupérer les livres disponibles pour l'échange
        $query = "SELECT * FROM livres WHERE disponible = 1";
        $result = $mysqli->query($query);

        // Affichage des livres sous forme de cases à cocher
        while ($row = $result->fetch_assoc()) {
          echo '<div class="form-check">';
          echo '<input class="form-check-input" type="checkbox" name="livres[]" value="' . $row['id_livre'] . '" id="livre_' . $row['id_livre'] . '">';
          echo '<label class="form-check-label" for="livre_' . $row['id_livre'] . '">' . $row['titre_livre'] . '</label>';
          echo '</div>';
        }

        // Fermeture de la connexion à la base de données
        $mysqli->close();
      ?>
      <button type="submit" class="btn btn-primary mt-3">Valider la proposition d'échange</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
