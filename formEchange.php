<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable

$tr = isset($_GET['tr']) ? (int) $_GET['tr'] : 0;
$book_id = isset($_GET['book_id']) ? (int) $_GET['book_id'] : 0;

if ($tr === 0 || $book_id===0) {
    die("ID transaction ou livre invalide");
   
}

?>
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
       

        <div class="container">
            <h3 class="text-center">Entrez votre proposition pour l'échange</h3>

            <div class="form-container">
						<form id="formEchange"  method="post"  action="validFormEchange.php">
						<div class="form-group">
						<label for="date_echange" >Date:</label>
						<input type="date" class="form-control"   name="date_echange" id="date_echange" required />
						</div>
						<div class="form-group">
						<label for="location_echange">Lieu:</label>
						<input type="text" class="form-control" name="location_echange" id="location_echange" required />
						</div>
						<div class="form-group">
						<label for="time_echange">Heure:</label>
						<input type="time" class="form-control" name="time_echange" id="time_echange" required />
						</div>
                        <input type="text" name="tr" id="tr" value="<?= $tr; ?>" hidden/>
                        <input type="text" name="book_id" id="book_id" value="<?= $book_id; ?>" hidden/>
						<button type="submit" class="btn btn-primary info-gen">Valider</button>
						</form>
						</div>
						</div>

            
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

