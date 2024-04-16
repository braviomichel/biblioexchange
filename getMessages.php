d<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable



	
    $req = $mysqli-> prepare("SELECT * FROM message where id_emetteur = :emetteur and id_recepteur = :recepteur ");
	$req.->execute(array('expediteur'=> expediteur, 'destinataire'=>destinataire));
	while($resultats = $req->fetch()){
		echo '<div class = msg" >'.$resultats['id_expediteur'].'</div>'
	}
	echo 'donnes envoyees'



?>

