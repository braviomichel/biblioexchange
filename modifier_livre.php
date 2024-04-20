<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable

// Récupération des données du livre à modifier
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM livres WHERE id_livre = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result_user = $stmt->get_result();
    
    if ($result_user->num_rows > 0) {
        $livre = $result_user->fetch_assoc();
    } else {
        echo "Aucun livre trouvé.";
    }
    
    $stmt->close();
    $mysqli->close();
}

// Modification des informations du livre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookName = $_POST["bookName"] ?? '';
    $author = $_POST["author"] ?? '';
    $publicationYear = $_POST["publicationYear"] ?? '';
    $categorie = $_POST["categorie"] ?? '';
    $summary = $_POST["summary"] ?? '';
    $owner = $user_id;
    $id = $_POST['id'] ?? '';

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/biblioexchange/Back-end/upload_picture.php";
        $image_url = $basename;
    }

    if (!empty($image_url)) {
        $sql = "UPDATE livres SET titre_livre = ?, auteur = ?, année_de_publication = ?, categorie = ?, couverture = ?, resume = ? WHERE id_livre = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssssssi", $bookName, $author, $publicationYear, $categorie, $image_url, $summary, $id);
    } else {
        $sql = "UPDATE livres SET titre_livre = ?, auteur = ?, année_de_publication = ?, categorie = ?, resume = ? WHERE id_livre = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssssi", $bookName, $author, $publicationYear, $categorie, $summary, $id);
    }

    if ($stmt->execute()) {
        $message = "Livre modifié avec succès.";
        $errortype = "success";
        header("Location: modifier_livre.php?id=$id");
        exit;
    } else {
        $message = "Erreur lors de la modification du livre : " . $stmt->error;
        $errortype = "danger";
        header("Location: modifier_livre.php?id=$id");
        exit;
    }

    $stmt->close();
    $mysqli->close();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un livre</title>
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

                <h2 class="text-center">Modifier un livre</h2>

                <?php include_once "Back-end/display.php" ?>
                <div class="form-group">
                    <label for="bookName">Nom du livre:</label>
                    <input type="text" name="id" value="<?php echo $_GET['id'] ?? ''; ?>" hidden> 
                    <input type="text" class="form-control" id="bookName" name="bookName" value="<?php echo $livre['titre_livre'] ?? ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="author">Auteur:</label>
                    <input type="text" class="form-control" id="author" name="author" value="<?php echo $livre['auteur'] ?? ''; ?>"  required>
                </div>

                <div class="form-group">
                    <label for="publicationYear">Année de Publication:</label>
                    <select class="form-control" id="publicationYear" name="publicationYear" required>
                        <option value="">Sélectionner une année</option>
                        <?php
                        $currentYear = date("Y");
                        for ($i = $currentYear; $i >= $currentYear - 100; $i--) {
                            $selected = ($i == ($livre['année_de_publication'] ?? '')) ? 'selected="selected"' : '';
                            echo "<option value='$i' $selected >$i</option>";
                            if ($i == 1900) {
                                break;
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="categorie">Catégorie du livre:</label>
                    <select class="form-control" id="categorie" name="categorie" required>
                        <option value="">Choisir la catégorie du livre</option>
                        <option value="Mangas" <?php if ($livre["categorie"] == "Mangas"): ?> selected="selected" <?php endif; ?>  >Mangas</option>
                        <option value="Biographie" <?php if ($livre["categorie"] == "Biographie"): ?> selected="selected" <?php endif; ?>  >Biographie</option>
                        <option value="Géopolitique"  <?php if ($livre["categorie"] == "Géopolitique"): ?> selected="selected" <?php endif; ?> >Géopolitique</option>
                        <option value="Magazine"  <?php if ($livre["categorie"] == "Magazine"): ?> selected="selected" <?php endif; ?> >Magazine</option>
                        <option value="Théâtre" <?php if ($livre["categorie"] == "Théâtre"): ?> selected="selected" <?php endif; ?> >Théâtre</option>
                        <option value="Thriller"  <?php if ($livre["categorie"] == "Thriller"): ?> selected="selected" <?php endif; ?> >Thriller</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="summary">Résumé du livre:</label>
                    <textarea class="form-control" id="summary" name="summary" rows="5"><?php echo $livre['resume'] ?? ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="bookImage">Image du Livre:</label>
                    <input type="file" class="form-control-file" id="bookImage" name="photo" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary btn-publish">Modifier le Livre</button>
            </form>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
