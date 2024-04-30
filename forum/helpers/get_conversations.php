<?php 

function getConversation($conn){
    
    $sql = "SELECT * FROM forum_sujet
            ORDER BY id DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

   
        $conversations = $stmt->fetchAll();

      	return $conversations;
    }  

