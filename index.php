<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur BiblioExchange</title>
    <style>
        /* CSS personnalisé */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #e9e9e9; /* Nouvelle couleur de fond */
            color: #444; /* Nouvelle couleur du texte */
        }
        .container {
            text-align: center;
            margin-top: 50px;
            border-radius: 25px; /* Carré arrondi */
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Ombre */
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            transition: background-color 0.3s; /* Transition de couleur de fond */
        }
        .container:hover {
            background-color: #f1f1f1; /* Nouvelle couleur de fond au survol */
        }
        h1 {
            font-size: 48px;
            margin-bottom: 10px;
            color: #2c3e50; /* Nouvelle couleur du titre */
        }
        .subtitle {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50; /* Nouvelle couleur du sous-titre */
        }
        img {
            width: 150px;
            margin: 20px 0;
            cursor: pointer; /* Curseur pointeur */
            border-radius: 15px; /* Bords arrondis du logo */
        }
        .brief {
            margin-bottom: 20px;
            text-align: justify;
            font-weight: bold; /* Texte en gras */
            font-size: 18px; /* Taille de police augmentée */
            overflow: hidden; /* Masquage du débordement */
            max-height: 0; /* Initialisation de la hauteur à 0 */
            transition: max-height 0.5s ease-out; /* Transition de hauteur */
        }
        .terms-box {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 500px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3498db; /* Nouvelle couleur du bouton */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9; /* Nouvelle couleur du bouton au survol */
        }
        .app-name {
            display: none; /* Masquer le nom de l'application */
        }
        .container:hover .brief {
            max-height: 200px; /* Nouvelle hauteur maximale au survol */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue</h1>
        <p class="subtitle">sur</p>
        <img src="Assets/livre1.png" alt="Logo BiblioExchange">
        <div class="brief">
            <p id="description"></p>
        </div>
        <div class="terms-box">
            <p>En continuant, vous acceptez les conditions générales d'utilisation de BiblioExchange. <a href="confidentialite.php">Lire notre politique de confidentialité</a>.</p>
        </div>
        <button id="continueButton">Cliquez ici pour Continuer</button>
    </div>

    <script>
        // JavaScript personnalisé
        const descriptionText = "BiblioExchange est une application qui vous permet de partager et d'échanger des livres avec d'autres passionnés de lecture. Que vous soyez un lecteur avide ou que vous souhaitiez simplement découvrir de nouveaux livres, BiblioExchange est l'endroit idéal pour vous.";

        const descriptionElement = document.getElementById('description');
        let i = 0;
        const speed = 50; // Vitesse de frappe

        function typeWriter() {
            if (i < descriptionText.length) {
                descriptionElement.innerHTML += descriptionText.charAt(i);
                i++;
                setTimeout(typeWriter, speed);
            }
        }

        typeWriter(); // Appel initial de la fonction

        document.getElementById('continueButton').addEventListener('click', function() {
            window.location.href = 'Connexion_biblioEx.php'; // Rediriger vers la page d'accueil
        });
    </script>
</body>
</html>
