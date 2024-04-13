<?php include_once "Back-end/connexion.php"; ?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Votre CSS personnalisé ici */
        .squircle {
            border-radius: 25px;
            overflow: hidden;
            background-color: #f8f9fa;
            padding: 20px;
            margin: auto;
            margin-top: 50px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
        }

        .container {
            margin-top: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
            border-radius: 15px;
            /* Bords arrondis du logo */
        }

        .logo img {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            /* Bords arrondis du logo */
        }
    </style>
</head>

<body>
    <div class="squircle">
        <div class="logo" onclick="window.location.href='index.php';">
            <img src="Assets/livre1.png" alt="logo Livre">
            <p>BiblioExchange</p>
        </div>

        <div class="container">
            <h1 class="text-center">Connexion</h1>

            <?php include_once "Back-end/display.php"; ?>

            <form id="connexionForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="motDePasse">Mot de passe :</label>
                    <div class="input-group"> <!-- Ajout d'un groupe d'entrée pour le mot de passe -->
                        <input type="password" id="motDePasse" name="motDePasse" class="form-control" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye" id="eye-icon"></i> <!-- Icône de l'œil -->
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="souvenirMoi">
                        <label class="form-check-label" for="souvenirMoi">
                            Souvenez-vous de moi
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </form>
            <div class="text-center mt-3">
                <p>Connectez-vous à l'aide de votre compte avec:</p>
                <i class="fab fa-facebook-square fa-2x mx-2"></i>
                <i class="fab fa-twitter-square fa-2x mx-2"></i>
                <i class="fab fa-google fa-2x mx-2"></i>
            </div>
            <p class="mt-3 text-center">Vous n'avez pas de compte ? <a href="Inscription_profil.php">Inscrivez-vous
                    ici</a>.</p>
            <p class="mt-3 text-center"><a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a></p>
        </div>
    </div>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("motDePasse");
            var eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>