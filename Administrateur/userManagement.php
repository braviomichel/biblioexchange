<?php
include_once '../Database/connect.php';
include_once "../Back-end/check_connection.php";
include_once "../Back-end/check_role.php";
include_once '../Back-end/get_id.php'; // get id and stores it in $user_id variable

// Requête SQL pour récupérer les utilisateurs
$sql = "SELECT * FROM utilisateurs";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result_user = $stmt->get_result();

// Initialiser un tableau pour stocker les utilisateurs
$users = array();

// Parcourir les résultats et ajouter chaque utilisateur au tableau
if ($result_user->num_rows > 0) {
    while ($ligne = $result_user->fetch_assoc()) {
        $user = array(
            'id' => $ligne['id_utilisateur'],
            'name' => $ligne['nom_utilisateur']." ".$ligne['prenom_utilisateur'],
            'email' => $ligne['email'],
        );
        $users[] = $user;
    }
    $users_json = json_encode($users);
} else {
    $users_json = json_encode([]);
}

// Fermer la connexion à la base de données
$stmt->close();
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
            display: flex;
            justify-content: space-between;
            align-items: center;
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
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-<?php echo htmlspecialchars($_GET['errortype']); ?>">
            <?php echo htmlspecialchars($_GET['message']); ?>
        </div>
    <?php endif; ?>
    <button id="loadUsersBtn">Charger les utilisateurs</button>
    <div id="userList"></div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function loadUsers() {
        var users = <?php echo $users_json; ?>;
        const userList = document.getElementById('userList');
        userList.innerHTML = ''; // Effacer la liste précédente
        users.forEach(user => {
            const userItem = document.createElement('div');
            userItem.classList.add('user-item');
            userItem.innerHTML = `<div>
                <h3>${user.name}</h3>
                <p>Email: ${user.email}</p>
            </div>
            <button class="btn btn-danger" onclick="deleteUser(${user.id})">Supprimer</button>`;
            userList.appendChild(userItem);
        });
    }

    function deleteUser(userId) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur?")) {
            window.location.href = 'supprimer_utilisateur.php?id=' + userId;
        }
    }

    document.getElementById('loadUsersBtn').addEventListener('click', loadUsers);
</script>

<?php include_once "footer.php"; ?>
</body>
</html>
