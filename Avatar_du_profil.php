<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avatar de Profil</title>
    <style>
        /* CSS personnalisé */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
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
            max-width: 400px;
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .button-container button {
            padding: 5px 10px;
            font-size: 14px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 0 5px;
        }
        .button-container button:hover {
            background-color: #0056b3;
        }
        .avatar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            margin-bottom: 20px;
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .continue-button {
            margin-top: 20px;
            padding: 15px 30px;
            font-size: 16px;
            background-color: #00A86B; /* Couleur verte jade */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .continue-button:hover {
            background-color: #007A4D; /* Variation de la couleur verte jade */
        }
        .logo-container {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 50px;
            height: 50px;
            border-radius: 10px;
            overflow: hidden;
        }
        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="squircle">
            <div class="logo-container">
                <img src="Assets/livre1.png" alt="Logo de l'application">
            </div>
            <h1>Avatar de Profil</h1>
            <div class="avatar" id="avatarContainer">
                <img src="Assets/avatar1.png" alt="Avatar par défaut" id="avatarImage">
            </div>
            <div class="button-container">
                <input type="file" id="fileInput" style="display: none;">
                <button onclick="document.getElementById('fileInput').click();">Importer</button>
                <button onclick="useDefaultAvatar();">Défaut</button>
            </div>
            <button class="continue-button" onclick="window.location.href='profile.php';">Continuer</button>
        </div>
    </div>

    <script>
        // JavaScript personnalisé
        function useDefaultAvatar() {
            document.getElementById('avatarImage').src = 'Assets/avatar1.png';
        }

        // Gérer le chargement de l'image sélectionnée
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('avatarImage').src = e.target.result;
            }

            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>
