<?php
include_once "Database/connect.php";

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $email = $_POST["email"];
    $motDePasse = $_POST["motDePasse"];


    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
    } else {

        // Requête préparée pour insérer des données dans la table "utilisateurs"
        $sql = "SELECT * FROM utilisateurs WHERE email = ?";
        // Préparation de la requête
        $stmt = $mysqli->prepare($sql);

        // Liaison des paramètres
        $stmt->bind_param("s", $email);

        // Exécuter la requête préparée
        if ($stmt->execute()) {

            // Récupération du résultat
            $result = $stmt->get_result();

            // Vérification si l'utilisateur existe
            if ($result->num_rows == 1) {
                // Récupération des données de l'utilisateur
                $row = $result->fetch_assoc();
                $hashedPassword = $row["mot_de_passe"];
                $user_id = $row["id_utilisateur"];
                $role = $row["role_utilisateur"];

                // Vérification du mot de passe hashé
                if (password_verify($motDePasse, $hashedPassword)) {

                    // Après une connexion réussie
                    // Creation d'une session 
                    session_start();

                    // Générer un identifiant de session aléatoire
                    $sessionId = bin2hex(random_bytes(32)); // Utilisez une longueur appropriée pour vos besoins

                    // Définir le cookie de session avec l'identifiant généré
                    setcookie('PHPSESSID', $sessionId, 0, '/');

                    // Stockage de la session au niveau de la base de données : 

                    $sql = "INSERT INTO user_sessions (session_id, user_id) VALUES (?, ?)";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param("ss", $sessionId, $user_id);


                    // Exécuter la requête préparée
                    if ($stmt->execute()) {

                        if ($role == "admin") {
                            header("Location: Administrateur/acceuil.php");
                            exit;
                        } else {

                            header("Location: acceuil.php");
                            exit; // Assurez-vous de terminer le script après la redirection
                        }

                    } else {

                    }

                } else {
                    // Mot de passe incorrect
                    $message = "Utilisateur ou Mot de passe incorrect !";
                    $errortype = "danger";
                }
            } else {
                // Utilisateur non trouvé
                $message = "Utilisateur ou Mot de passe incorrect !";
                $errortype = "danger";
            }

        } else {
            $message = "Erreur lors de la récupération de l'utilisateur : " . $stmt->error;
            $errortype = "danger";
        }

        // Fermer la requête et la connexion à la base de données
        $stmt->close();
        $mysqli->close();
    }

}


?>