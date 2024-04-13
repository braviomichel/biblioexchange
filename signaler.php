<?php
include_once "Database/connect.php";
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once "Back-end/get_id.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $problem = $_POST["problem"];
    $date_time = date('Y-m-d H:i:s');
    $statut = "Non Résolu";
    
    // insérer le signalement dans la base de données 

    // Requête préparée pour insérer des données dans la table "utilisateurs"
    $sql = "INSERT INTO signalement (id_utilisateur, date_time, raison, statut) VALUES (?, ?, ?, ?)";

    // Préparation de la requête
    $stmt = $mysqli->prepare($sql);

    // Liaison des paramètres
    $stmt->bind_param("ssss", $user_id,$date_time, $problem, $statut);
     // Exécuter la requête préparée
     if ($stmt->execute()) {
        $message = "Signalement retenu !";
        $errortype = "success";

    } else {
        $message = "Erreur lors de la création du signalement : " . $stmt->error;
        $errortype = "danger";
    }

    // Fermer la requête et la connexion à la base de données
    $stmt->close();
    $mysqli->close();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signaler un Problème - Échange de Livres</title>
    <style>
          .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }
        .squircle {
            border-radius: 25px;
            overflow: hidden;
            background-color: #f8f9fa;
            padding: 20px;
            margin: auto;
            position: relative;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
            <div class="header">
                <?php include_once "header.php"; ?>
            </div>
    <header class="bg-dark text-white py-4">

    </header>
    <div class="squircle">
    <div class="container">
            <h2 class="mb-0">Signaler un Problème</h2>
        </div>
        <main class="container py-4">
            <?php include_once "Back-end/display.php" ?>
         <form id="inscriptionForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="problem">Description du Problème</label>
                <textarea class="form-control" name="problem" id="problem" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        </main>   
    </div>
    <?php include_once 'footer.php'; ?>
    <!-- Bootstrap JS et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
