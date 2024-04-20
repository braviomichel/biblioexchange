<?php
include_once "../Back-end/check_connection.php";
include_once "../Back-end/check_role.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - BiblioExchange</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles pour le tableau de bord administratif */
        .a {
            color: #ffffff;
            text-decoration: none;
            background-color: transparent;
        }

        .admin-dashboard {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .admin-dashboard h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .admin-dashboard h2 {
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 10px;
            color: #444;
        }

        .admin-dashboard button {
            margin-bottom: 10px;
            padding: 8px 16px;
            font-size: 16px;
            background-color: #56d364;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .admin-dashboard button:hover {
            background-color: #0056b3;
        }

        #userList,
        #bookList,
        #messageList,
        #reportList,
        #statistics,
        #settings,
        #logOut {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            overflow-y: auto;
            max-height: 300px;
        }

        .user-item,
        .book-item,
        .message-item,
        .report-item,
        .statistic-item,
        .setting-item,
        .logout-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .user-item h3,
        .book-item h3,
        .message-item h3,
        .report-item h3,
        .statistic-item h3,
        .setting-item h3,
        .logout-item h3 {
            margin-top: 0;
        }

        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    
<?php include_once "header.php"; ?>

    <div class="admin-dashboard">
        <h1>Tableau de bord administratif</h1>

        <div id="userManagement">
            <h2>Gestion des utilisateurs</h2>
            <button><a href="userManagement.html">Charger les utilisateurs</a></button>
        </div>


        <div id="bookManagement">
            <h2>Gestion des livres</h2>
            <button><a href="bookManagement.html">Charger les livres</a></button>
        </div>


        <div id="messageManagement">
            <h2>Gestion des messages</h2>
            <button><a href="messageManagement.html" color="green">Charger les messages</a></button>
        </div>

        <div id="reportManagement">
            <h2>Gestion des signalement</h2>
            <button><a href="reportManagement.html">Charger les signalements</a></button>
        </div>
        <div id="statistics">
            <h2>Statistiques</h2>
            <button id="loadStatisticsBtn">Charger les statistiques</button>
            <div id="statisticsList"></div>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            // Fonction pour charger les utilisateurs depuis le serveur
            function loadUsers() {
                // Requête AJAX pour récupérer les utilisateurs
                // Exemple de données JSON simulées
                const users = [
                    { id: 1, name: "John Doe", email: "john@example.com" },
                    { id: 2, name: "Jane Smith", email: "jane@example.com" },
                    { id: 3, name: "Alice Johnson", email: "alice@example.com" }
                ];

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

            // Fonction pour charger les livres depuis le serveur
            function loadBooks() {
                // Requête AJAX pour récupérer les livres
                // Exemple de données JSON simulées
                const books = [
                    { id: 1, title: "Book 1", author: "Author 1" },
                    { id: 2, title: "Book 2", author: "Author 2" },
                    { id: 3, title: "Book 3", author: "Author 3" }
                ];

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

            // Chargement des utilisateurs au clic sur le bouton
            document.getElementById('loadUsersBtn').addEventListener('click', loadUsers);

            // Chargement des livres au clic sur le bouton
            document.getElementById('loadBooksBtn').addEventListener('click', loadBooks);

            // Vous pouvez ajouter les autres fonctions de chargement pour les autres fonctionnalités ici
        </script>
</body>
<footer class="bg-dark text-white py-4">
    <style>
        /* Styles supplémentaires */
        .useful-links a {
            color: #fff;
            /* Couleur des liens utiles en blanc */
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Liens utiles</h5>
                <ul class="list-unstyled useful-links">
                    <li><a href="userManagement.html"><i class="fas fa-users"></i> Gestion des Utilisateurs</a></li>
                    <li><a href="bookManagement.html"><i class="fas fa-book"></i> Gestion des Livres</a></li>
                    <li><a href="messageManagement.html"><i class="fas fa-envelope"></i> Gestion des Messages</a></li>
                    <li><a href="reportManagement.html"><i class="fas fa-exclamation-triangle"></i> Gestion des
                            Signalements</a></li>
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