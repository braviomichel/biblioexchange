<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres - Échange de Livres</title>
    <style>
        /* Styles pour les éléments de formulaire */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block; /* Pour aligner les labels correctement */
        }

        .form-control {
            width: 30%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
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
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
            <div class="header">
                <?php include_once "header.php"; ?>
            </div>
    <div class="squircle">
        <main class="container py-4">
            <h2>Modifier vos paramètres</h2>
            <form>
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" required>
            </div>
            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
                <div class="form-group">
                    <label for="oldPassword">Ancien mot de passe :</label>
                    <input type="password" id="oldPassword" class="form-control" name="oldPassword">
                </div>
                <div class="form-group">
                    <label for="newPassword">Nouveau mot de passe :</label>
                    <input type="password" id="newPassword" class="form-control" name="newPassword">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirmer nouveau mot de passe :</label>
                    <input type="password" id="confirmPassword" class="form-control" name="confirmPassword">
                </div>

              
        <script>
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

                </script>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div> 
    </main>
    <?php include_once 'footer.php'; ?>
    <!-- Bootstrap JS et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
