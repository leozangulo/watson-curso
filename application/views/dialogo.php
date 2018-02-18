<!DOCTYPE html>
<html>
<head>
	<title>Conversation dialogo</title>
	<style type="text/css">
		.texto {
			width: 100%;
			height: 300px;
			background-color: #000;
			color: #fff;
			overflow-y: auto;
			padding: 20px;
		}
	</style>
</head>
<body>
	<div class="texto">
		
	</div>
	<br>
	<input id="query"></input>
	<button id="envio">Enviar</button>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		$("#envio").click(function() {
			var query = $("#query").val();
			envio(query);
			$("#query").val('');
			$("#query").focus();
			var userQuestion = "<b>Usuario</b>: " + query + '<br>';
			$(".texto").append(userQuestion);
		});

		function envio(input) {
			$.ajax({
				url: 'conversation',
				type: 'POST',
				data: {query:input}
			})
			.done(function(response) {
				data = JSON.parse(response);
				var watsonAnswer = '<b>Watson</b>: ';
				watsonAnswer += data.output.text;
				watsonAnswer += '<br><hr>';

				$(".texto").append(watsonAnswer);
			});
		}
	});
</script>


</html>