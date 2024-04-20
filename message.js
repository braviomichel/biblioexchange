
$(document).ready(function () {
	$(".sendMessage").click(function () {
		$.ajax({
			type: "post",
			url: "sendMesssage.php",
			data: $(".message").serialize(),
			success: function (retour) {
				alert(retour);
			},
		});
	});
	setInterval(maFonction, 1000);
	function maFonction() {
		$(".affiche_msg").load("getMessages.php");
	}


	
	$(".message-btn").click(function (event) {
		event.preventDefault(); // Empêche le comportement de soumission par défaut du formulaire
		$("#message-input").val("Bonjour. Je suis interessé par ce livre."); // Modifie la valeur du champ de message si nécessaire
		
		$("#message-form").submit(); // Soumet le formulaire
	});
	$(".oui-btn").click(function (event) {
		event.preventDefault(); // Empêche le comportement de soumission par défaut du formulaire
		$("#oui").val("Bonjour. Je suis interessé par ce livre."); // Modifie la valeur du champ de message si nécessaire
		
		$("#oui-form").submit(); // Soumet le formulaire
	});
	

	
	$("#info-form").submit(function (event) {
		event.preventDefault();
		var date = $("#date").val();
		var location = $("#location").val();
		var time = $("#time").val();

		addSentMessage(
			"Ci joint les informations de l'échange : " +
				"Date: " +
				date +
				", Lieu: " +
				location +
				", Heure: " +
				time +
				"Celà vous convient -il?"
		);

		// Optionally, clear the form fields after submission
		$("#date").val("");
		$("#location").val("");
		$("#time").val("");
	});

	function addSentMessage(message) {
		var messageContainer = $("#message-container");
		var sentMessage = $("<div>").addClass("sent-message").text(message);
		messageContainer.append(sentMessage);
		// Scroll to the bottom to show the latest message
		messageContainer.scrollTop(messageContainer[0].scrollHeight);
	}
});
