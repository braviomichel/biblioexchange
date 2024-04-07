<?php
//session_start();

include_once  $_SERVER['DOCUMENT_ROOT']."/biblioexchange/Database/connect.php";

// Vérifie si le cookie de session est présent
if (isset($_COOKIE['PHPSESSID'])) {
    // Récupère le cookie de session
    $session_id = $_COOKIE['PHPSESSID'];

    $root = $_SERVER['DOCUMENT_ROOT'];


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

    if ($stmt->num_rows < 0) {
        $url = "Location: ".$root.'/biblioexchange/Connexion_biblioEx.php';
        header($url);
        exit;
    } 

} else {
    // Si le cookie de session n'est pas présent
    $url = "Location: ".$root.'/biblioexchange/Connexion_biblioEx.php';
    header($url);
    exit;
}

