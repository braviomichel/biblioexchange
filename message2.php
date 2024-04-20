<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Votre CSS personnalisé ici */
        .chat-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message-container {
            margin-bottom: 20px;
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            background-color: #f2f2f2;
            margin-bottom: 10px;
        }

        .message.sent {
            background-color: #4CAF50;
            color: white;
            margin-left: auto;
        }

        .message.received {
            background-color: #ddd;
            color: black;
            margin-right: auto;
        }

        .message-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include_once "header.php"; ?>
    <div class="container">
        <h1>Messagerie</h1>
        <div class="chat-container">
            <div class="message-container">
                <!-- Messages récupérés depuis la base de données -->
                <?php
                // Connexion à la base de données
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $database = 'biblioexchange';
                $conn = new mysqli($host, $user, $password, $database);
                if ($conn->connect_error) {
                    die("La connexion a échoué: " . $conn->connect_error);
                }
                // Récupérer les messages depuis la base de données
                $sql = "SELECT * FROM messages ORDER BY dateMess DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='message " . ($row['id_emetteur'] == 1 ? 'sent' : 'received') . "'>" . $row['mess'] . "</div>";
                    }
                }
                $conn->close();
                ?>
            </div>
            <textarea class="message-input" placeholder="Tapez votre message ici..."></textarea>
            <button class="btn btn-primary mt-2" id="sendMessageBtn">Envoyer</button>
        </div>
    </div>
    <?php include_once 'footer.php'; ?>
    <script>
        // Logique JavaScript pour envoyer un message
        document.getElementById("sendMessageBtn").addEventListener("click", function() {
            var message = document.querySelector(".message-input").value;
            if (message.trim() !== "") {
                // Envoi du message à la base de données via AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "send_message.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        // Vérifier si la requête a réussi
                        if (xhr.status === 200) {
                            // Convertir la réponse JSON en objet JavaScript
                            var response = JSON.parse(xhr.responseText);
                            // Vérifier si l'opération a réussi
                            if (response.success) {
                                // Si la requête a réussi, mettez à jour l'interface utilisateur pour afficher le nouveau message
                                var newMessage = "<div class='message sent'>" + message + "</div>";
                                document.querySelector(".message-container").innerHTML += newMessage;
                                document.querySelector(".message-input").value = "";
                            } else {
                                // En cas d'échec de l'opération, afficher un message d'erreur
                                console.error(response.error);
                            }
                        } else {
                            // En cas d'échec de la requête, afficher un message d'erreur
                            console.error("Erreur lors de l'envoi de la requête.");
                        }
                    }
                };
                // Envoyer les données du message au script PHP
                xhr.send("message=" + encodeURIComponent(message));
            }
        });
    </script>
</body>
</html>
<?php
// Vérifier si le message est défini et non vide
if (isset($_POST['message']) && !empty($_POST['message'])) {
    // Récupérer le message depuis la requête POST
    $message = $_POST['message'];
    // Connexion à la base de données
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'biblioexchange';
    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) {
        // En cas d'erreur de connexion, renvoyer une réponse JSON avec le statut d'erreur
        echo json_encode(['success' => false, 'error' => 'Erreur de connexion à la base de données']);
        exit();
    }
    // Préparer la requête SQL pour insérer le message dans la base de données
    $sql = "INSERT INTO messages (message, id_emetteur, date_envoi) VALUES (?, 1, NOW())";
    $stmt = $conn->prepare($sql);
    // Vérifier si la préparation de la requête a réussi
    if ($stmt === false) {
        // En cas d'échec de la préparation de la requête, renvoyer une réponse JSON avec le statut d'erreur
        echo json_encode(['success' => false, 'error' => 'Erreur de préparation de la requête']);
        exit();
    }
    // Lier les paramètres et exécuter la requête
    $stmt->bind_param('s', $message);
    $result = $stmt->execute();
    // Vérifier si l'exécution de la requête a réussi
    if ($result === false) {
        // En cas d'échec de l'exécution de la requête, renvoyer une réponse JSON avec le statut d'erreur
        echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'exécution de la requête']);
        exit();
    }
    // Si tout s'est bien passé, renvoyer une réponse JSON avec le statut de réussite
    echo json_encode(['success' => true]);
    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();
} else {
    // Si le message n'est pas défini ou est vide, renvoyer une réponse JSON avec le statut d'erreur
    echo json_encode(['success' => false, 'error' => 'Le message est vide']);
}
?>
