<?php

// requete vers la bdd pour récupérer les informations de l'utilisateur connecté
session_start();

include_once 'Database/connect.php';
include_once 'check_connection.php';

// Vérifie si le cookie de session est présent
if (isset($_COOKIE['PHPSESSID'])) {
    // Récupère le cookie de session
    $session_id = $_COOKIE['PHPSESSID'];

    // Vérifie la connexion
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Requête SQL préparée pour récupérer l'ID de l'utilisateur à partir de la table user_sessions
    $sql = "SELECT user_id FROM user_sessions WHERE session_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Récupère l'ID de l'utilisateur
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        // Requête SQL préparée pour récupérer les informations de l'utilisateur à partir de la table utilisateurs
        $sql_user = "SELECT * FROM utilisateurs WHERE id_utilisateur = ?";
        $stmt_user = $mysqli->prepare($sql_user);
        $stmt_user->bind_param("i", $user_id);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();

        if ($result_user->num_rows > 0) {
            // L'utilisateur est connecté
            $user_info = $result_user->fetch_assoc();
            $nom = $user_info["nom_utilisateur"];
            $prenoms = $user_info["prenom_utilisateur"];
            $email = $user_info["email"];
            $dateNaissance = $user_info["date_naissance"];
            $tel = $user_info["telephone"];
            $niveauEtude = $user_info["niveau_etude"];
            $bio = $user_info["biographie"];
            $sexe = $user_info["sexe"];
            $password = $user_info["mot_de_passe"];
            //$genresPref = $user_info["genre_prefere"];

        } else {
            $message = "Aucune information utilisateur trouvée.";
            $errortype = "danger";
        }

        // Modification du mot de passe : 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $ancien_mot_de_passe = $_POST["oldPassword"];
            $nouveau_mot_de_passe = $_POST["newPassword"];

            //echo($ancien_mot_de_passe);

            // Utiliser Bcrypt avec un coût personnalisé (par exemple, coût = 12)
            $options = ['cost' => 12];
            $hashedMotDePasse = password_hash($nouveau_mot_de_passe, PASSWORD_BCRYPT, $options);
            //$ancienHashedMotDePasse = password_hash($ancien_mot_de_passe, PASSWORD_BCRYPT, $options);

            if (password_verify($ancien_mot_de_passe,$password)) {
                // Requête SQL préparée pour récupérer l'ID de l'utilisateur à partir de la table user_sessions
                $sql = "UPDATE utilisateurs SET mot_de_passe = ? WHERE id_utilisateur = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("si", $hashedMotDePasse, $user_id);
                if ($stmt->execute()) {
                    $message = "Mot de passe changé avec succès ! ";
                    $errortype = "success";
                } else {
                    $message = "Le mot de passe n'a pas pu être changé ! ";
                    $errortype = "danger";
                }

            } else {
                $message = "Mot de passe incorrect";
                $errortype = "danger";
            }

        }

    } else {
        // Aucune correspondance pour le cookie de session dans la table user_sessions
        $message = "Aucune correspondance pour le cookie de session.";
        $errortype = "danger";
    }

    // Ferme la connexion à la base de données
    $stmt->close();
    $stmt_user->close();
    $mysqli->close();
} else {
    // Si le cookie de session n'est pas présent
    //echo "Aucun cookie de session trouvé.";
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Profil</title>
    <style>
        /* CSS personnalisé */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .logo img {
            width: 50px; /* Modification de la taille du logo */
            height: auto;
            border-radius: 10px; /* Arrondir les bords du logo */
        }
        .app-logo {
            width: 30px; /* Miniaturisation du logo */
            height: auto;
            margin-right: 10px;
        }

        .containerrd {
            text-align: center;
            margin-top: 50px;
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

        .avatar-container {
            position: relative;
            margin-bottom: 20px;
        }

        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .edit-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .edit-buttons button {
            margin: 0 10px;
            padding: 5px 10px;
            font-size: 14px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-buttons button:hover {
            background-color: #0056b3;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: calc(100% - 20px);
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            max-width: 300px;
        }

        input[type="text"]:not(#username),
        input[type="email"],
        textarea {
            max-width: 400px;
        }

        input[type="password"] {
            max-width: 200px;
        }

        input[type="text"]:not(#username):not(#tel):not(#niveauEtude),
        input[type="email"],
        textarea {
            max-length: 20;
        }

        button#saveButton,
        a#editProfileLink {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            /* Vert Jade */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        button#saveButton:hover,
        a#editProfileLink:hover {
            background-color: #45a049;
            /* Vert Jade plus foncé */
        }
    </style>
</head>

<body>

            <div class="header">
                <?php include_once "header.php"; ?>
            </div>
      


    <div class="containerrd">
        <div class="squircle">
            <h1>Profil</h1>
            <div class="avatar-container">
                <div class="avatar" id="avatarContainer">
                    <img src="Assets/avatar1.png" alt="Avatar par défaut" id="avatarImage">
                </div>
                <div class="edit-buttons">
                    <button id="changeAvatarButton">Changer Avatar</button>
                    <button id="useDefaultAvatarButton">Avatar par défaut</button>
                </div>
            </div>
            <?php if (isset($errortype)): ?>
                <div class="alert <?php echo "alert-" . $errortype; ?> alert-dismissible fade show" role="alert">
                    <strong>
                        <?php if ($errortype == "danger"):
                            echo "Erreur ";
                        else:
                            echo "Succes ";
                        endif; ?>!
                    </strong>
                    <?php echo " " . $message; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="prenoms">Prénoms :</label>
                <input type="text" id="prenoms" name="prenoms" value="<?php echo ($prenoms); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" value="<?php echo ($email); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="dateNaissance">Date de naissance :</label>
                <input type="text" id="dateNaissance" name="dateNaissance" value="<?php echo ($dateNaissance); ?>"
                    readonly>
            </div>
            <div class="form-group">
                <label for="tel">Numéro de téléphone :</label>
                <input type="text" id="tel" name="tel" value="<?php echo ($tel); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="sexe">Sexe :</label>
                <input type="text" id="sexe" name="sexe" value="<?php echo ($sexe); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="niveauEtude">Niveau d'étude :</label>
                <input type="text" id="niveauEtude" name="niveauEtude" value="<?php echo ($niveauEtude); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="bio">Biographie :</label>
                <textarea id="bio" name="bio" rows="5" readonly><?php echo ($bio); ?></textarea>
            </div>
            <div class="edit-buttons">
                <button id="editProfileLink">Modifier le profil</button>
            </div>
           
        </div>
    </div>


    <script>

        // Gérer le changement d'avatar
        document.getElementById('changeAvatarButton').addEventListener('click', function () {
            // Ouvrir la fenêtre de sélection de fichier
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function (event) {
                const file = event.target.files[0];
                const reader = new FileReader();
                reader.onload = function (readerEvent) {
                    const imageDataURL = readerEvent.target.result;
                    document.getElementById('avatarImage').src = imageDataURL;
                };
                reader.readAsDataURL(file);
            };
            input.click();
        });

        // Gérer l'utilisation de l'avatar par défaut
        document.getElementById('useDefaultAvatarButton').addEventListener('click', function () {
            document.getElementById('avatarImage').src = 'Assets/avatar1.png';
        });

        // Gérer l'enregistrement du nouveau mot de passe
        document.getElementById('saveButton').addEventListener('click', function () {
            const oldPassword = document.getElementById('oldPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            // Vérifier si le nouveau mot de passe correspond à la confirmation
            if (newPassword !== confirmPassword) {
                alert("Les mots de passe ne correspondent pas !");
                return;
            }
            // Enregistrer le nouveau mot de passe
            console.log("Ancien mot de passe :", oldPassword);
            console.log("Nouveau mot de passe :", newPassword);
            // Réinitialiser les champs de mot de passe après l'enregistrement
            document.getElementById('oldPassword').value = "";
            document.getElementById('newPassword').value = "";
            document.getElementById('confirmPassword').value = "";
        });

        // Gérer la modification du profil
        document.getElementById('editProfileLink').addEventListener('click', function () {
            // Activer la modification des champs de profil
            const inputs = document.querySelectorAll('.form-group input, .form-group textarea');
            inputs.forEach(input => {
                input.removeAttribute('readonly');
            });
        });
    </script>
   
</body>
<div class="footer" >
<?php include_once 'footer.php'; ?>
            </div>
      

</html>