<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable

// Modification du mot de passe : 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération de l'image 
    include_once $_SERVER['DOCUMENT_ROOT'] . "/biblioexchange/Back-end/upload_picture.php";

    $image_url = $basename;

    // Récupérer les données du formulaire
    $bookName = $_POST["bookName"];
    $author = $_POST["author"];
    $publicationYear = $_POST["publicationYear"];
    $categorie = $_POST["categorie"];
    $resume = $_POST["resume"]; // Nouveau champ ajouté
    $owner = $user_id;

    // Requête préparée pour insérer des données dans la table "livres"
    $sql = "INSERT INTO livres (titre_livre, auteur, année_de_publication, couverture, owner_id, categorie, resume, disponible) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Préparation de la requête
    $stmt = $mysqli->prepare($sql);

    $disponible = 0;

    // Liaison des paramètres
    $stmt->bind_param("sssssssi", $bookName, $author, $publicationYear, $image_url, $owner, $categorie, $resume, $disponible);

    // Exécuter la requête préparée
    if ($stmt->execute()) {
        $message = "Livre ajouté avec succès.";
        $errortype = "success";
    } else {
        $message = "Erreur lors de l'ajout du livre : " . $stmt->error;
        $errortype = "danger";
    }

    // Ferme la connexion à la base de données
    $stmt->close();
    $stmt_user->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .squircle {
            border-radius: 20px;
            overflow: hidden;
        }

        .squircle form {
            padding: 20px;
            background-color: #ffffff;
        }

        .squircle form label {
            font-weight: bold;
        }

        .btn-publish {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <?php include_once "header.php"; ?>

    <div class="container mt-5">
        <div class="squircle">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

                <h2 class="text-center">Publier un livre</h2>

                <?php include_once "Back-end/display.php" ?>
                <div class="form-group">
                    <label for="bookName">Nom du livre:</label>
                    <input type="text" class="form-control" id="bookName" name="bookName" required>
                </div>

                <div class="form-group">
                    <label for="author">Auteur:</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>

                <div class="form-group">
                    <label for="publicationYear">Année de Publication:</label>
                    <select class="form-control" id="publicationYear" name="publicationYear" required>
                        <option value="">Select Year</option>
                        <?php
                        $currentYear = date("Y");
                        for ($i = $currentYear; $i >= $currentYear - 100; $i--) {
                            echo "<option value='$i'>$i</option>";
                            if ($i == 1900) {
                                break; // Arrêter la boucle lorsque l'année atteint 2024
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie du livre:</label>
                    <select class="form-control" id="categorie" name="categorie" required>
                        <option value="">Choisir la categorie du livre</option>
                        <option value="Mangas">Mangas</option>
                        <option value="Biographie">Biographie</option>
                        <option value="Géopolitique">Géopolitique</option>
                        <option value="Magazine">Magazine</option>
                        <option value="Théâtre">Théâtre</option>
                        <option value="Thriller">Thriller</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="resume">Résumé:</label>
                    <textarea class="form-control" id="resume" name="resume" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="bookImage">Image du Livre:</label>
                    <input type="file" class="form-control-file" id="bookImage" name="photo" accept="image/*"
                        required>
                </div>

                <button type="submit" class="btn btn-primary btn-publish">Publier le Livre</button>
            </form>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById("uploadForm").addEventListener("submit", function (event) {
            event.preventDefault();
            var bookName = document.getElementById("bookName").value;
            var author = document.getElementById("author").value;
            var publicationYear = document.getElementById("publicationYear").value;
            var bookImage = document.getElementById("bookImage").files[0];

            // Ici, vous pouvez ajouter le code pour soumettre les données à votre backend pour traitement, par exemple, via une requête AJAX.
            // Après le succès de la soumission, vous pouvez afficher un message de confirmation à l'utilisateur.
            // Pour cet exemple, nous allons simplement afficher les données saisies dans la console.
            console.log("Book Name: " + bookName);
            console.log("Author: " + author);
            console.log("Publication Year: " + publicationYear);
            console.log("Book Image: " + bookImage.name);
        });
    </script>
</body>

</html>
