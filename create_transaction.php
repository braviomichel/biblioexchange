<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable

// Récupération des données du livre à modifier
if(isset($_GET['book_id']) && isset($_GET['action'])) {
    $id = $_GET['book_id'];
    $action = $_GET['action'];

    if($action == 'exchange') {
        // creation d'une notification pour le proprio du livre

        //recuperer le nom du livre : 
        $sql2 = "SELECT * FROM livres where id_livre = ?";
        $stmt2 = $mysqli->prepare($sql2);
        $stmt2->bind_param('i', $id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $livre = $row['titre_livre'];
            $owner = $row['owner_id'];
        }
        $stmt2->close();

        $Title = "Nouvelle Demande d'Echange";
        $message = "Vous venez de recevoir une demande d'échange concernant votre livre ".$livre;
        $mydate = date('Y-m-d H:i:s');

        $sql = "INSERT INTO notifications (id_emetteur, id_recepteur, date_time, Title, messages) VALUES (?, ?, ?, ?, ?)";
    
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iisss",$user_id,$owner, $mydate, $Title, $message);
        //$stmt->execute();
            
        if ($stmt->execute()) {
            $message = "Notification crée avec succès.";
            $errortype = "success";

            // On va maintenant creer une nouvelle transaction : 
            $sql = "INSERT INTO transactions (id_emetteur, id_recepteur,id_livre_echange,id_livre_contrepartie, date_transaction, etape) VALUES (?, ?, ?, ?, ?, ?)";
            $id_contrepartie = 0;
            $etape = 1;
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("iiiisi",$user_id,$owner,$id,$id_contrepartie,$mydate,$etape);
    
            if ($stmt->execute()) {
                $message = "Transaction crée avec succès.";
                $errortype = "success";
                $stmt->close();
                $mysqli->close();
                header("Location: book_list.php");
                exit;
            }
            
        } else {
            $message = "Erreur lors de l'envoi du message : " . $stmt->error;
            $errortype = "danger";
            $stmt->close();
            $mysqli->close();
            header("Location: book_list.php");
            exit;
        }

    }
    elseif($action == "contrepartie")
    {
        // creation d'une notification pour le proprio du livre

        //recuperer le nom du livre : 
        $sql2 = "SELECT * FROM livres where id_livre = ?";
        $stmt2 = $mysqli->prepare($sql2);
        $stmt2->bind_param('i', $id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $livre = $row['titre_livre'];
            $owner = $row['owner_id'];
        }
        $stmt2->close();

        $Title = "Nouvelle Demande d'Echange";
        $message = "Vous venez de recevoir une demande d'échange concernant votre livre ".$livre;
        $mydate = date('Y-m-d H:i:s');

        $sql = "INSERT INTO notifications (id_emetteur, id_recepteur, date_time, Title, messages) VALUES (?, ?, ?, ?, ?)";
    
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iisss",$user_id,$owner, $mydate, $Title, $message);
        //$stmt->execute();
            
        if ($stmt->execute()) {
            $message = "Notification crée avec succès.";
            $errortype = "success";

            // On va maintenant creer une nouvelle transaction : 
            $sql = "INSERT INTO transactions (id_emetteur, id_recepteur,id_livre_echange,id_livre_contrepartie, date_transaction, etape) VALUES (?, ?, ?, ?, ?, ?)";
            $id_contrepartie = 0;
            $etape = 1;
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("iiiisi",$user_id,$owner,$id,$id_contrepartie,$mydate,$etape);
    
            if ($stmt->execute()) {
                $message = "Transaction crée avec succès.";
                $errortype = "success";
                $stmt->close();
                $mysqli->close();
                header("Location: book_list.php");
                exit;
            }
            
        } else {
            $message = "Erreur lors de l'envoi du message : " . $stmt->error;
            $errortype = "danger";
            $stmt->close();
            $mysqli->close();
            header("Location: book_list.php");
            exit;
        }

    }
 

}

?>