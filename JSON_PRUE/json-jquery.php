<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="utf-8">

	<title>Json & Jquery</title>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

</head>

<body>
	<h1>Json & Jquery</h1>

	<select id="usuarios"></select> 


	<script type="text/javascript">
	$(document).on('ready',function (){
 		
		$.get('carga-select.php', function(data) {

			var obt = JSON.parse(data);

			console.log(data);

//			$.each(obt, function(key,value){
//				$("#usuarios").append('<option name="' + obt[0]['id_cli'] + '">' + obt[1]['nombre'] + '</option>');
//			}); // close each()

            for (var i = obt.length - 1; i >= 0; i--) {
            	$("#usuarios").append('<option name="' + obt[i]['id_cli'] + '">' + obt[i]['nombre'] + '</option>');   
            }


		}); // close getJSON()
	});
	</script>

</body>
</html>