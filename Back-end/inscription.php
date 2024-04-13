<?php
include_once "Database/connect.php";

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenoms = $_POST["prenoms"];
    $email = $_POST["email"];
    $dateNaissance = $_POST["dateNaissance"];
    $tel = $_POST["tel"] ?? "";
    $niveauEtude = $_POST["niveauEtude"];
    $motDePasse = $_POST["motDePasse"];
    $confirmerMotDePasse = $_POST["confirmerMotDePasse"];
    $bio = $_POST["bio"];
    $sexe = $_POST["sexe"];
    $genresPref = $_POST["genresPref"] ?? [];
    $image_url = "avatar1.png";

    // Valider que les mots de passe correspondent
    if ($motDePasse !== $confirmerMotDePasse) {
        $erreurMotDePasse = "Les mots de passe ne correspondent pas.";

    } else {

        // Hashage du mot de passe : 
        // Utiliser Bcrypt avec un coût personnalisé (par exemple, coût = 12)
        $options = ['cost' => 12];
        $hashedMotDePasse = password_hash($motDePasse, PASSWORD_BCRYPT, $options);


        // Vérifier la connexion
        if ($mysqli->connect_error) {
            die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
        } else {


            // Conversion du tableau en chaine de caractère pour stockage dans la base de donnees.
            $genres = serialize($genresPref);

            // Requête préparée pour insérer des données dans la table "utilisateurs"
            $sql = "INSERT INTO utilisateurs (nom_utilisateur, prenom_utilisateur, email, mot_de_passe, date_naissance, telephone, sexe, niveau_etude, biographie, genre_prefere, role_utilisateur, image_profil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Préparation de la requête
            $stmt = $mysqli->prepare($sql);

            // Liaison des paramètres
            $role = "user";
            $stmt->bind_param("ssssssssssss", $nom, $prenoms, $email, $hashedMotDePasse, $dateNaissance, $tel, $sexe, $niveauEtude, $bio, $genres,$role, $image_url);

            // Exécuter la requête préparée
            if ($stmt->execute()) {
                $message = "Compte créé avec succès.";
                $errortype = "success";

            } else {
                $message = "Erreur lors de la création du compte : " . $stmt->error;
                $errortype = "danger";
            }

            // Fermer la requête et la connexion à la base de données
            $stmt->close();
            $mysqli->close();
        }
    }
}
