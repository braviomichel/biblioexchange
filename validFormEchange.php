<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $time_echange = $_POST["time_echange"];
        $location_echange = $_POST["location_echange"];
        $date_echange= $_POST["date_echange"];
        $id_transaction = $_POST['tr'];
        $book_id = $_POST['book_id'];
        //echo $time_echange;
        // die();


    
    
        // Vérifier la connexion
        if ($mysqli->connect_error) {
            die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
        } else {
     //recuperer le nom du livre : 
     $sql2 = "SELECT * FROM livres where id_livre = ?";
     $stmt2 = $mysqli->prepare($sql2);
     $stmt2->bind_param('i', $book_id);
     $stmt2->execute();
     $result = $stmt2->get_result();
     if($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         //$livre = $row['titre_livre'];
         $owner = $row['owner_id'];
     }
     $stmt2->close();

     $Title = "Contrepartie Défini";
     $message = "Vous venez de recevoir la contrepartie pour votre demande d'échange";
     $mydate = date('Y-m-d H:i:s');

     $sql = "INSERT INTO notifications (id_emetteur, id_recepteur, date_time, Title, messages) VALUES (?, ?, ?, ?, ?)";
 
     $stmt = $mysqli->prepare($sql);
     $stmt->bind_param("iisss",$user_id,$owner, $mydate, $Title, $message);
     //$stmt->execute();
         
     if ($stmt->execute()) {
         $message = "Notification crée avec succès.";
         $errortype = "success";

         // On va maintenant creer une mettre à jour la transaction : 
         $etape = 2;
         $sql = "UPDATE transactions SET id_livre_contrepartie = ?,etape=?, lieu_echange = ?, date_echange=? , heure_echange = ? WHERE id_transaction = ?";
         $stmt = $mysqli->prepare($sql);
         $stmt->bind_param("iisssi",$book_id,$etape, $location_echange, $date_echange, $time_echange, $id_transaction);
 
         if ($stmt->execute()) {
             $message = "Transaction modifiée avec succès.";
             $errortype = "success";
             $stmt->close();
             $mysqli->close();
             header("Location: mes_demandes_livres.php");
             exit;
         }
         
     } else {
         $message = "Erreur lors de l'envoi du message : " . $stmt->error;
         $errortype = "danger";
         $stmt->close();
         $mysqli->close();
         header("Location: mes_demandes_livres.php");
         exit;
     }
        }
    
    }
    
   
   
 


?>