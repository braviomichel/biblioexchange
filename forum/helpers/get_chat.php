<?php 
 

function getChats($id,  $conn){
   
   $sql = "SELECT * FROM forum_message
            WHERE  id_sujet= ? 
	        ORDER BY id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([ $id]);

    if ($stmt->rowCount() > 0) {
    	$chats = $stmt->fetchAll();
    	return $chats;
    }else {
    	$chats = [];
    	return $chats;
    }

}