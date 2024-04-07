<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include_once $_SERVER['DOCUMENT_ROOT'].'/biblioexchange/Database/connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/biblioexchange/Back-end/check_connection.php';


// Vérifie si le cookie de session est présent
if (isset($_COOKIE['PHPSESSID'])) {

    // Récupère le cookie de session
    $session_id = $_COOKIE['PHPSESSID'];

    // Vérifie la connexion
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Requête SQL préparée pour récupérer l'ID de l'utilisateur à partir de la table user_sessions
    $sql = "SELECT user_id FROM user_sessions WHERE session_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Récupère l'ID de l'utilisateur
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
    }else {
        // Aucune correspondance pour le cookie de session dans la table user_sessions
        $message = "Aucune correspondance pour le cookie de session.";
        $errortype = "danger";
    }
}else {
    // Si le cookie de session n'est pas présent
    //echo "Aucun cookie de session trouvé.";
}