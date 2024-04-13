<?php
include_once '../Database/connect.php';
include_once "../Back-end/check_connection.php";
include_once "../Back-end/check_role.php";
include_once '../Back-end/get_id.php'; // get id and stores it in $user_id variable


// Requête SQL pour récupérer les livres
$sql = "SELECT * FROM utilisateurs";
// Préparation de la requête
$stmt = $mysqli->prepare($sql);

// Liaison des paramètres
$stmt->execute();
$result_user = $stmt->get_result();
// Vérifier s'il y a des livres
if ($result_user->num_rows > 0) {
    // Initialiser un tableau pour stocker les livres
    $users = array();
    
    // Parcourir les résultats et ajouter chaque livre au tableau
    while ($ligne = $result_user->fetch_assoc()) {
        $user = array(
            'id' => $ligne['id_utilisateur'],
            'name' => $ligne['nom_utilisateur']." ".$ligne['prenom_utilisateur'],
            'email' => $ligne['email'],
        );
        // Ajouter le livre au tableau des livres
        $users[] = $user;
    }

    // Convertir le tableau des livres en format JSON
    $users_json = json_encode($users);

    // Afficher le résultat JSON
    //echo $livres_json;
    //print_r($livres);
} else {
    echo "Aucun livre trouvé.";
}

// Ferme la connexion à la base de données
$stmt->close();
$stmt_user->close();
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - BiblioExchange</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles pour la gestion des utilisateurs */
        .user-management {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .user-management h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .user-management button {
            margin-bottom: 10px;
            padding: 8px 16px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .user-management button:hover {
            background-color: #0056b3;
        }

        #userList {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            overflow-y: auto;
            max-height: 300px;
        }

        .user-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .user-item h3 {
            margin-top: 0;
        }

        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

  <?php include_once "header.php"; ?>
    <div class="user-management">
        <h1>Gestion des Utilisateurs</h1>

        <button id="loadUsersBtn">Charger les utilisateurs</button>
        <div id="userList"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Fonction pour charger les utilisateurs depuis le serveur
        function loadUsers() {
            // Requête AJAX pour récupérer les utilisateurs
            // Exemple de données JSON simulées
            // const users = [
            //     { id: 1, name: "User 1", email: "user1@example.com" },
            //     { id: 2, name: "User 2", email: "user2@example.com" },
            //     { id: 3, name: "User 3", email: "user3@example.com" }
            // ];

            var users = <?php echo $users_json; ?>
            
            // Afficher les utilisateurs dans la liste
            const userList = document.getElementById('userList');
            userList.innerHTML = ''; // Effacer la liste précédente
            users.forEach(user => {
                const userItem = document.createElement('div');
                userItem.classList.add('user-item');
                userItem.innerHTML = `<h3>${user.name}</h3><p>Email: ${user.email}</p>`;
                userList.appendChild(userItem);
            });
        }

        // Chargement des utilisateurs au clic sur le bouton
        document.getElementById('loadUsersBtn').addEventListener('click', loadUsers);
    </script>
</body>
<footer class="bg-dark text-white py-4">
    <style>
        /* Styles supplémentaires */
        .useful-links a {
            color: #fff; /* Couleur des liens utiles en blanc */
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Liens utiles</h5>
                <ul class="list-unstyled useful-links">
                    <li><a  href="userManagement.html"><i class="fas fa-users"></i> Gestion des Utilisateurs</a></li>
                    <li><a  href="bookManagement.html"><i class="fas fa-book"></i> Gestion des Livres</a></li>
                    <li><a  href="messageManagement.html"><i class="fas fa-envelope"></i> Gestion des Messages</a></li>
                    <li><a  href="reportManagement.html"><i class="fas fa-exclamation-triangle"></i> Gestion des Signalements</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i>Parametres</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>Contactez-nous</h5>
                <ul class="list-unstyled">
                    <li>Adresse: 123 Rue de la Bibliothèque, Kénitra</li>
                    <li>Téléphone: +123 456 789</li>
                    <li>Email: contact@biblioexchange.com</li>
                </ul>
            </div>
        </div>
    
        <p class="text-center">&copy; 2024 BiblioExchange. Tous droits réservés.</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</footer>
</html>
