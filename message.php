<?php
include_once 'Database/connect.php';
include_once "Back-end/check_connection.php";
include_once "Back-end/check_role.php";
include_once 'Back-end/get_id.php'; // get id and stores it in $user_id variable
$sql = " SELECT * FROM messages where id_emetteur =  ?";
// Préparation de la requête
$stmt = $mysqli->prepare($sql);

// Liaison des paramètres
$user=1;
$stmt->bind_param("i", $user);
$stmt->execute();
$result_user = $stmt->get_result();

if ($result_user->num_rows > 0) {
    // Initialiser un tableau pour stocker les livres
    $messageList = array();
    
    // Parcourir les résultats et ajouter chaque livre au tableau
    while ($ligne = $result_user->fetch_assoc()) {
        $message = array(
            'message' => $ligne['mess'],
              );
        // Ajouter le livre au tableau des livres
        $messageList[] = $message;
    }

  
} else {
    echo "Aucun livre trouvé.";
}

// Ferme la connexion à la base de données
$stmt->close();
$stmt_user->close();
$mysqli->close();

$step = 1;

?>




<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Conversation</title>
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		/>
		<style>
			.message-container {
				max-width: 600px;
				margin: 50px auto;
			}
			.message-btn {
				margin-bottom: 10px;
			}
			.sent-message {
				background-color: #007bff;
				color: white;
				border-radius: 10px;
				padding: 10px 20px;
				margin-bottom: 10px;
				text-align: right;
			}
			.received-message {
				background-color: #f0f0f0;
				border-radius: 10px;
				padding: 10px 20px;
				margin-bottom: 10px;
				text-align: left;
			}
			.centered-form {
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
			}
			.form-container {
				max-width: 400px;
				padding: 20px;
				border: 1px solid #ccc;
				border-radius: 10px;
				background-color: #f9f9f9;
			}
		</style>
	</head>
	<body>
	<?php include_once "header.php"; ?>
		<div class="container">
		<div class="message-container" id="message-container">
    <?php foreach ($messageList as $message) : ?>
        <div class="sent-message"><?php echo $message['message']; ?></div>
        <br>
    <?php endforeach; ?>
</div>
			<?php if ($step == 0): ?>  
			<div class="text-center" id="button-container">
			
			<form id="message-form" action="sendMessage.php" method="post">
    <input type="hidden" name="message" id="message-input" value="kj" />
    <button type="submit" class="btn btn-primary message-btn">Demander les infos</button>
	
</form>

			
			</div>
			<?php endif; ?>

			<?php if ($step == 2): ?>  
			<div class="text-center" id="button-container">
			
			<form id="oui-form" action="sendMessage.php" method="post">
    <input type="hidden" name="oui" id="oui" value="kj" />
    <button type="submit" class="btn btn-primary oui-btn">Confirmer</button>
</form>

			
			</div>
			<?php endif; ?>

			<?php if ($step == 1): ?>  
				<div class="centered-form" id="centered-form">
				<div class="form-container">
						<form id="info-form">
						<div class="form-group">
						<label for="date">Date:</label>
						<input type="date" class="form-control" id="date" required />
						</div>
						<div class="form-group">
						<label for="location">Lieu:</label>
						<input type="text" class="form-control" id="location" required />
						</div>
						<div class="form-group">
						<label for="time">Heure:</label>
						<input type="time" class="form-control" id="time" required />
						</div>
						<button type="submit" class="btn btn-primary info-gen">Enregistrer</button>
						</form>
						</div>
						</div>
			<?php endif; ?>
		</div>

		<div class="centered-form" id="centered-form"></div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="message.js"></script>

		<?php include_once 'footer.php'; ?>
		
	</body>
</html>
