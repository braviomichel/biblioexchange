<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Management - BiblioExchange</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles pour la gestion des messages */
        .message-management {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message-management h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .message-management button {
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

        .message-management button:hover {
            background-color: #0056b3;
        }

        #messageList {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            overflow-y: auto;
            max-height: 300px;
        }

        .message-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .message-item h3 {
            margin-top: 0;
        }

        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include_once "header.php";  ?>
    <div class="message-management">
        <h1>Gestion des Messages</h1>

        <button id="loadMessagesBtn">Charger les messages</button>
        <div id="messageList"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Fonction pour charger les messages depuis le serveur
        function loadMessages() {
            // Requête AJAX pour récupérer les messages
            // Exemple de données JSON simulées
            const messages = [
                { id: 1, sender: "User 1", subject: "Message 1" },
                { id: 2, sender: "User 2", subject: "Message 2" },
                { id: 3, sender: "User 3", subject: "Message 3" }
            ];

            // Afficher les messages dans la liste
            const messageList = document.getElementById('messageList');
            messageList.innerHTML = ''; // Effacer la liste précédente
            messages.forEach(message => {
                const messageItem = document.createElement('div');
                messageItem.classList.add('message-item');
                messageItem.innerHTML = `<h3>De: ${message.sender}</h3><p>Sujet: ${message.subject}</p>`;
                messageList.appendChild(messageItem);
            });
        }

        // Chargement des messages au clic sur le bouton
        document.getElementById('loadMessagesBtn').addEventListener('click', loadMessages);
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