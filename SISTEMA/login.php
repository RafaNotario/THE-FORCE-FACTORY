<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title> Login </title>

	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	
<!--	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css ">
-->

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">

	<script src="js/jquery-1-12-3.min.js" charset="utf-8"></script>

	<script src="js/bootstrap.min.js" charset="utf-8"></script>

	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		

<!--	<script src="js/jquery-ui.min.js" charset="utf-8"></script>
-->
<script>

	$(document).ready(function()
	{

 		$('#login').click(function()
		{
			var user = $('#user').val();
			var pass = $('#pass').val();

			if($.trim(user).length > 0 && $.trim(pass).length > 0) 
			{
				$.ajax({
					url:"logueame.php",
					method:"POST",
					data:{user:user, pass:pass},
					cache:"false",
					beforeSend:function(){

						$('#login').val("Conectando...").delay(3000);
					},//beforeSend
					success:function(data){
						$('#login').val("Login");
						console.log("ata"+data);
						if (data=="1") {
						console.log("ata"+data);
							$(location).attr('href','index.php');
						}else{//$times
							$('#result').html("<div class='alert alert-dismissible alert-danger'> <button type='button' class='close' data-dismiss='alert'> x; </button> <strong> ¡Error! </strong> Las credenciales son incorrectas.</div>");
						}
					}//function data
				});//ajax
			}else{
				alert("Campo vacio");
			};//if
		});//funcion al click boton
	});//documento listo
</script>


</head>
<body>
	
	<header>
		<div class="contenedor" id="head">
			<h1> The Force Factory  </h1> <br>
		</div>

	</header>


			

	<div class="container-fluid">

		<div class="container" id="bienv">
			<h2> Binvenido </h2>
		</div>


			<div id="conten1" class="row">
				<center>

				<div class="col-md-5">
					<img src="img/2.png" class="img-responsive" alt="Imagen responsive">
				</div>
				
				<div id="formular" class=" col-md-6">
					<p> Introduzca sus credenciales </p>
				<form method="post">
					
						<div class="form-group">
							<label for="user"> Usuario o Email </label>
							<input type="text" name="user" id="user" class="form-control">		
						</div>
						
						<div class="form-group">
							<label for="pass"> Contraseña </label>
							<input type="password" name="pass" id="pass" class="form-control">								
						</div>
						<br>
						<div class="form-group">
							<input type="button" name="login" id="login" value="Loggin" class="btn btn-success">
						</div>
						
						<span id="result"></span>
				</form>
				</div>
				</center>
			</div>
		</div>

</body>
</html>