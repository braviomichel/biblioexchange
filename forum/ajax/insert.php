<?php 

include_once '../..Database/connect.php';
include_once "../..Back-end/check_connection.php";
include_once "../..Back-end/check_role.php";
include_once '../..Back-end/get_id.php'; 

# check if the user is logged in


	if (isset($_POST['message']) &&
        isset($_POST['id_sujet'])) {
	


	# get data from XHR request and store them in var
	$message = $_POST['message'];
	$id_sujet = $_POST['id_sujet'];

	# get the logged in user's username from the SESSION
	$from_id = $user_id;

	$sql = "INSERT INTO 
	       forum_message (id_emmetteur, id_sujet, message) 
	       VALUES (?, ?, ?)";
	$stmt = $mysqli->prepare($sql);
	$res  = $stmt->execute([$from_id, $id_sujet, $message]);
    
    # if the message inserted
    if ($res) {
    	

		<p class="rtext align-self-end
		          border rounded p-2 mb-1">
		    <?=$message?>  
		    <small class="d-block"><?=$time?></small>      	
		</p>

    <?php 
     }
  }else {
	//header("Location: ../../index.php");
	exit;
}