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
