<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .squircle {
            border-radius: auto;
            overflow: hidden;
            background-color: #f8f9fa;
            padding: auto;
            margin: auto;
            margin-top: auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: auto;
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
    </style>
</head>

<body>
<div class="squircle">
    <div class="logo" onclick="window.location.href='index.php';">
            <img src="Assets/livre1.png" alt="logo Livre">
            <p>BiblioExchange</p>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                    <b>Mot de passe oublié</b></div>
                    <div class="card-body">
                        <form action="traitement_mot_de_passe_oublie.php" method="POST">
                            <div class="form-group">
                                <label for="email">Adresse e-mail :</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    

    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p>&copy; 2024 Échange de Livres. Tous droits réservés.</p>
        </div>
    </footer>
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
   
</html>
