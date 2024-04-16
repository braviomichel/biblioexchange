<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable


if (isset($_POST[contenu])){
	$contenu = htmlentities($_POST[contenu]),
	$expediteur ='1',
	destiantaire : '2',
    $req = $mysqli-> prepare("INSERT INTO message (id_emmeteur,id_recepteur, mess, dateMess) VALUES ( :expediteur, :destinataire, :contenu, :dateMess)");
	$req.->execute(array('expediteur'=> $expediteur, 'destinataire'=>$destinataire,'contenu' => $contenu,'dateMess'=> new Date()));
	echo 'donnes envoiyees'
}



?>

