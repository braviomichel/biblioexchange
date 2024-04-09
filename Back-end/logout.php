<?php

include_once "../Database/connect.php";

// Vérifier si le cookie de session est présent
if (isset($_COOKIE['PHPSESSID'])) {
    $sessionId = $_COOKIE['PHPSESSID'];

    $root = $_SERVER['DOCUMENT_ROOT'];

    // Suppression du cookie  
    $expiration_time = time() - 3600;
    setcookie("PHPSESSID", '', $expiration_time, '/');
    unset($_COOKIE["PHPSESSID"]);

    // Ici, vous devrez faire une requête à votre base de données pour vérifier si l'identifiant de session est présent et valide
    $sql = "SELECT user_id FROM user_sessions WHERE session_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $sessionId);
    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Il y a une session valide dans la base de donnée, on va la supprimer. 

        $sql = "DELETE FROM user_sessions WHERE session_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $sessionId);
        $stmt->execute();

        $url = "Location: ".$root."/biblioexchange/Connexion_biblioEx.php";
        header($url);
        exit;

    } else {
        // Aucune session valide n'est trouvée

        $url = "Location: ".$root."/biblioexchange/Connexion_biblioEx.php";
        header($url);       
        exit;
    }


} else {
    echo('5');
    // Le cookie de session n'est pas présent, rediriger vers la page de connexion
    $url = "Location: ".$root."/biblioexchange/Connexion_biblioEx.php";
    header($url);
    exit;
}
