<?php
// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si un fichier a été sélectionné
    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        // Vérification si le fichier est une image réelle ou une fausse image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                echo "Le fichier est une image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Le fichier n'est pas une image.";
                $uploadOk = 0;
            }
        }

        // Vérification si le fichier existe déjà
        if (file_exists($targetFile)) {
            echo "Désolé, le fichier existe déjà.";
            $uploadOk = 0;
        }

        // Vérification de la taille du fichier
        if ($_FILES["image"]["size"] > 500000) {
            echo "Désolé, le fichier est trop volumineux.";
            $uploadOk = 0;
        }

        // Autoriser certains formats de fichiers
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
            $uploadOk = 0;
        }

        // Vérifier si $uploadOk est défini à 0 par une erreur
        if ($uploadOk == 0) {
            echo "Désolé, votre fichier n'a pas été téléchargé.";
        // Si tout est ok, essayer de télécharger le fichier
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "Le fichier ". htmlspecialchars( basename( $_FILES["image"]["name"])). " a été téléchargé.";
            } else {
                echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            }
        }
    } else {
        echo "Aucun fichier sélectionné.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    Sélectionnez une image à télécharger:
    <input type="file" name="image" id="image">
    <input type="submit" value="Télécharger l'image" name="submit">
</form>

</body>
</html>
