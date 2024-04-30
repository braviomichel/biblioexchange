<?php 
include_once '../../Database/connect.php';
include_once "../../Back-end/check_connection.php";
include_once "../../Back-end/check_role.php";
include_once '../../Back-end/get_id.php'; 


# check if the user is logged in

    if (isset($_GET['id_sujet']) ) {
	
	
	$id_1  = $user_id;
    $id_sujet = $_GET['id_sujet'];
	//$id_2  = $_POST['id_2'];
	//$opend = 0;

	$sql = "SELECT * FROM forum_message
	        WHERE id_emmetteur= ? AND id_sujet= ? 
	        ORDER BY id ASC";
	$stmt = $mysqli->prepare($sql);
	$stmt->execute([$id_1,  $id_sujet]);

	if ($stmt->rowCount() > 0) {
	    $chats = $stmt->fetchAll();

	    # looping through the chats
	    foreach ($chats as $chat) {
	    	
                  <p class="ltext border 
					        rounded p-2 mb-1">
					    <?=$chat['message']?> 
					    <small class="d-block">
					    	<?=$chat['created_at']?>
					    </small>      	
				  </p>        
	            <?php
	    	
	    }
	}

 }

else {
	//header("Location: ../../index.php");
	exit;
}