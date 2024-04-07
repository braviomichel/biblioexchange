<?php
// Vérification si un fichier a été sélectionné
if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
    $targetDir = $_SERVER['DOCUMENT_ROOT']."/biblioexchange/uploads/";
    $basename = basename($_FILES["photo"]["name"]);
    $targetFile = $targetDir . $basename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Vérification si le fichier est une image réelle ou une fausse image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        echo "Le fichier est une image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $message = "Le fichier n'est pas une image.";
        $errortype = "danger";
        $uploadOk = 0;
    }

    // Vérification si le fichier existe déjà
    if (file_exists($targetFile)) {
        $message = "Désolé, le fichier existe déjà.";
        $errortype = "danger";
        $uploadOk = 0;
    }

    // Vérification de la taille du fichier
    if ($_FILES["photo"]["size"] > 500000) {
        $message = "Désolé, le fichier est trop volumineux.";
        $errortype = "danger";
        $uploadOk = 0;
    }

    // Autoriser certains formats de fichiers
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $message = "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        $errortype = "danger";
        $uploadOk = 0;
    }

    // Vérifier si $uploadOk est défini à 0 par une erreur
    if ($uploadOk == 0) {
        $message = "Désolé, votre fichier n'a pas été téléchargé.";
        $errortype = "danger";
    // Si tout est ok, essayer de télécharger le fichier
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            $message = "Le fichier ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " a été téléchargé.";
            $errortype = "success";
            // Mettre à jour la base de données avec le chemin de l'image
            // $targetFile contient le chemin relatif de l'image
            // Vous pouvez l'insérer dans votre requête SQL pour mettre à jour la photo de profil de l'utilisateur
        } else {
            $message = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            $errortype = "danger";
        }
    }
}
?>