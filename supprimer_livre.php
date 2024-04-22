<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable

// Récupération des données du livre à modifier
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM livres WHERE id_livre = ?";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    //$stmt->execute();
        
    if ($stmt->execute()) {
        $message = "Livre modifié avec succès.";
        $errortype = "success";
        $stmt->close();
        $mysqli->close();
        header("Location: mes_livres2.php");
        exit;
    } else {
        $message = "Erreur lors de la modification du livre : " . $stmt->error;
        $errortype = "danger";
        $stmt->close();
        $mysqli->close();
        header("Location: mes_livres2.php");
        exit;
    }
    

}

?>