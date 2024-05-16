<?php
include_once '../Database/connect.php';
include_once "../Back-end/check_connection.php";
include_once "../Back-end/check_role.php";
include_once '../Back-end/get_id.php'; // get id and stores it in $user_id variable


// Requête SQL pour récupérer les livres
$sql = "SELECT * FROM livres";
// Préparation de la requête
$stmt = $mysqli->prepare($sql);

// Liaison des paramètres
$stmt->execute();
$result_user = $stmt->get_result();
// Vérifier s'il y a des livres
if ($result_user->num_rows > 0) {
    // Initialiser un tableau pour stocker les livres
    $livres = array();
    
    // Parcourir les résultats et ajouter chaque livre au tableau
    $i = 1;
    while ($ligne = $result_user->fetch_assoc()) {
        $livre = array(
            'id' => $ligne['id_livre'],
            'title' => $ligne['titre_livre'],
            'author' => $ligne['auteur']
        );
        // Ajouter le livre au tableau des livres
        $livres[] = $livre;
    }

    // Convertir le tableau des livres en format JSON
    $livres_json = json_encode($livres);

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
    <title>Gestion des Livres - BiblioExchange</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles pour la gestion des livres */
        .book-management {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .book-management h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .book-management button {
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

        .book-management button:hover {
            background-color: #0056b3;
        }

        #bookList {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            overflow-y: auto;
            max-height: 300px;
        }

        .book-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .book-item h3 {
            margin-top: 0;
        }

        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include_once "header.php"; ?>

    <div class="book-management">
        <h1>Gestion des Livres</h1>

        <button id="loadBooksBtn">Charger les livres</button>
        <div id="bookList"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Fonction pour charger les livres depuis le serveur
        function loadBooks() {
            // Requête AJAX pour récupérer les livres
            // Exemple de données JSON simulées
            // const books = [
            //     { id: 1, title: "Book 1", author: "Author 1" },
            //     { id: 2, title: "Book 2", author: "Author 2" },
            //     { id: 3, title: "Book 3", author: "Author 3" }
            // ];

            var books = <?php echo $livres_json; ?>

            // Afficher les livres dans la liste
            const bookList = document.getElementById('bookList');
            bookList.innerHTML = ''; // Effacer la liste précédente
            books.forEach(book => {
                const bookItem = document.createElement('div');
                bookItem.classList.add('book-item');
                bookItem.innerHTML = `<h3>${book.title}</h3><p>Auteur: ${book.author}</p>`;
                bookList.appendChild(bookItem);
            });
        }

        // Chargement des livres au clic sur le bouton
        document.getElementById('loadBooksBtn').addEventListener('click', loadBooks);
    </script>
    <?php include_once "footer.php"; ?>
</body>
</html>
