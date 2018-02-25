<!DOCTYPE html>
<html>
<head>
	<title>Conversation dialogo</title>
	<style type="text/css">
		.texto {
			width: 100%;
			height: 300px;
			background-color: #757575;
			color: #fff;
			overflow-y: auto;
			padding: 20px;
		}
		.respuesta {
			width: 100%;
			height: 300px;
			background-color: #546E7A;
			color: #fff;
			overflow-y: auto;
			padding: 20px;
		}
	</style>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	</head>
<body>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Banco Patito</a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Page 1</a></li>
			<li><a href="#">Page 2</a></li>
			<li><a href="#">Page 3</a></li>
		</ul>
	</div>
</nav>

<div class="container">
	<h3>Virtual Agent - Banco Patito</h3>
	<p>Preguntame lo que quieras</p>
	<div class="row">
		<div class="col-md-7">
			<div class="texto"></div>
			<br>
			<input id="query"></input>
			<button id="envio">Enviar</button>
		</div>
		<div class="col-md-5 respuesta"></div>
	</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		$(document.body).on('click','.boton-respuesta', function(){
			var input_text = $(this).attr('id').replace(/_/g, ' ');
			envio(input_text);
		})

		$("#query").focus();
		envio('Hola');
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
				url: 'conversationRico',
				type: 'POST',
				data: {query:input}
			})
			.done(function(response) {
				data = JSON.parse(response);

				var watsonAnswer = '<b>Watson</b>: ';
				watsonAnswer += data.conversation.output.text;
				watsonAnswer += '<br><hr>';
				$(".texto").append(watsonAnswer);
				emotion = data.toneanalyzer.document_tone.tones;

				var emotionText = '';

				$.each(emotion, function(key, val) {
					emotionText += val.tone_name + '<hr>';
				});
				$(".respuesta").append(emotionText);
			});
		}
	});
</script>


</html>