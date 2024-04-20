<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable




if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST["message"])) {
    $message = $_POST["message"];
	
		//$contenu = htmlentities($_POST[contenu])
	
	$expediteur ='1';
	$destinataire = '2';
	$sql = "INSERT INTO messages (id_emetteur,id_recepteur, mess) VALUES (?,?,? )";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("sss", $expediteur,  $destinataire, $message);

// Exécuter la requête préparée
if ($stmt->execute()) {
	$message = "Message ajouté avec succès.";
	$errortype = "success";
	header("Location: message.php");

} else {
	$message = "Erreur lors de l'ajout du livre : " . $stmt->error;
	$errortype = "danger";
}

// Ferme la connexion à la base de données
$stmt->close();
$stmt_user->close();
$mysqli->close();

    echo "Message envoyé avec succès !";
	
} else {
    echo "Erreur : Cette page ne peut être accédée directement.";
}

}
else if (isset($_POST["oui"])) {
    $message = $_POST["oui"];
	
		//$contenu = htmlentities($_POST[contenu])
	
	$expediteur ='1';
	$destinataire = '2';
	$sql = "INSERT INTO messages (id_emetteur,id_recepteur, mess) VALUES (?,?,? )";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("sss", $expediteur,  $destinataire, $message);

// Exécuter la requête préparée
if ($stmt->execute()) {
	$message = "Message ajouté avec succès.";
	$errortype = "success";
	header("Location: message.php");

} else {
	$message = "Erreur lors de l'ajout du livre : " . $stmt->error;
	$errortype = "danger";
}

// Ferme la connexion à la base de données
$stmt->close();
$stmt_user->close();
$mysqli->close();

    echo "Message envoyé avec succès !";
	
} else {
    echo "Erreur : Cette page ne peut être accédée directement.";
}








?>

