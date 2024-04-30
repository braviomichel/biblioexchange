<?php 

function lastChat($id, $conn){
   
   $sql = "SELECT * FROM forum_message
   WHERE  id_sujet= ?
           ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
    	$chat = $stmt->fetch();
    	return $chat['message'];
    }else {
    	$chat = '';
    	return $chat;
    }

}