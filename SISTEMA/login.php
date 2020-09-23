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

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<link rel="stylesheet" type="text/css" href="css/all.min.css">

<!--	<script src="js/jquery-ui.min.js" charset="utf-8"></script>
-->
</head>
<body>
<div class="contenedor">

	<header class="header-sitio">
			<h1> The Force Factory  </h1> <br>
	</header>
			<h2> Binvenido </h2>
		<main class="contenedor-flex">
			<div class="imagen">
				<img src="img/sinslog.png" class="img-responsive" alt="Imagen responsive">
			</div>
			<div class="formul">
				<form method="post">
					<p>Introduzca sus credenciales </p>
					<div class="form-group">
						<label for="user"> Usuario o Email </label>
						<input type="text" name="user" id="user" class="form-control">
					</div>

					<div class="form-group">
						<label for="pass"> Contraseña </label>
						<input type="password" name="pass" id="pass" class="form-control">
					</div>
				<br>
				<center>
					<div class="g-recaptcha" data-sitekey="
						6Ld6bp0UAAAAAIWHLRFaHjsE9pcKUnFGg2CdBxSz">
					</div>
				</center>
						<br>
						<div class="form-group">
							<input type="button" name="login" id="login" value="Loggin" class="btn btn-success">
						</div>

						<span id="result"></span>
				</form>
			</div><!-- .formul -->
		</main>

        <footer>
            <p><i class="far fa-copyright"></i>Todos los derechos reservados</p>
        </footer>
</div><!-- contenedor -->

<script>
	$(document).ready(function()
	{
 		$('#login').click(function()
		{
			var user = $('#user').val();
			var pass = $('#pass').val();
			var captch = grecaptcha.getResponse();
			if($.trim(user).length > 0 && $.trim(pass).length > 0)
			{
				$.ajax({
					url:"logueame.php",
					method:"POST",
					data:{user:user,pass:pass,response:captch},//,response:captch
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
							$('#result').html("<div class='alert alert-dismissible alert-danger'> <button type='button' class='close' data-dismiss='alert'> x; </button> <strong> ¡Error! </strong> Las credenciales son incorrectas o no verifico captcha.</div>");
						}
					}//function data
				});//ajax
			}else{
				alert("Campo vacio");
			};//if
		});//funcion al click boton
	});//documento listo
</script>

</body>
</html>