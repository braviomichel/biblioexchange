alert("ca marcge");
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
