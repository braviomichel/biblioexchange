<?php
//session_start();

include_once "Database/connect.php";

// Vérifie si le cookie de session est présent
if (isset($_COOKIE['PHPSESSID'])) {
    // Récupère le cookie de session
    $session_id = $_COOKIE['PHPSESSID'];


    // Vérifie la connexion
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Requête SQL pour vérifier si le cookie de session est présent dans la base de données
    $sql = "SELECT user_id FROM user_sessions WHERE session_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $sessionId);
    $stmt->execute();    
    $stmt->store_result();

    // Si c'est un admin, on le redirige dans la bonne zone : 
    include_once "Back-end/get_user_data.php";
    if($role == "admin")
    {
        header('Location: Administrateur/acceuil.html');
        exit;
    }

    if ($stmt->num_rows < 0) {
        header('Location: Connexion_biblioEx.php');
        exit;
    } 

} else {
    // Si le cookie de session n'est pas présent
    header('Location: Connexion_biblioEx.php');
    exit;
}

