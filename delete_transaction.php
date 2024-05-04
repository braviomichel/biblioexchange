<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable

// Récupération des données du livre à modifier
if (isset($_GET['tr'])) {
    $id = $_GET['tr'];

    //supprimer la ligne de la transaction depuis la table transactions. 
    $sql = "DELETE FROM transactions WHERE id_transaction = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);

    //$stmt->execute();

    if ($stmt->execute()) {

        $message = "Transaction supprimée avec succès.";
        $errortype = "success";


        // on va maintenant supprimer les notifications qui y sont associés
        $sql2 = "DELETE FROM notifications WHERE id_transaction = ?";
        $stmt2 = $mysqli->prepare($sql2);
        $stmt2->bind_param('i', $id);
        $stmt2->execute();
        
        if ($stmt2->execute()) {
            $message = "Notification supprimée avec succès.";
            $errortype = "success";

            $stmt->close();
            $mysqli->close();
            header("Location: mes_demandes_livres.php");
            exit;
        }
    }


}
else
{
    die("Aucune transaction sélectionnée !");
}

?>