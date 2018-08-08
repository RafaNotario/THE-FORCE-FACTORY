<?php
session_start();

if (!isset($_SESSION["user"])) //{
	header("location:login.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> THE FORCE FACTORY </title>

		<link rel="stylesheet" type="text/css" href="css/normalize.css">
    	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="cssPHP/index.css">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" charset="utf-8"></script>

		<script src="js/bootstrap.min.js" charset="utf-8"></script>  
		
	<script>

		function enviar(){
			$("#objetivo").load("contenido.php");
		}

	</script>
</head>
 
<body>
	
<header>
	<div class="contenedor" id="head">
	  	<span onclick="openNav()">&#9776; MENU </span>
	  	
		<?php 
			echo '<h4> Bienvenido:  ' .$_SESSION["user"].'</h4>';
			echo '<h5> <a href="logout.php"> Salir </a></h5>';
		?>
	</div>
</header>

<main>

<div id="mySidenav" class="sidenav">
	<center>
		<img src="img/2.png" class="img-responsive" alt="T_FF">
	</center>

	<a class="closebtn" href="javascript:void(0)" onclick="closeNav()">&times;</a>
	
	<a id="alta" href="#">ALTAS</a>
	<a id="ver" href="#">VER</a>
	<a id="pagos" href="#">PAGOS</a>
	<a href="#">MAS</a>
</div>


<section class="container col-md-12 prueba">
	
	<div id="main">
	
		<div class="container">
			<div class="logoG">
				<img src="img/2.png" class="img-responsive" width="25%">
	  		<h2>SISTEMA DE ADMINISTRACION</h2>
			</div>
	  		
	  			
  		</div>

	</div>

</section>

</main>

	<footer>
				


	</footer>

<script type="text/javascript">

$(document).ready(function(){
	openNav();
});

$('#alta').click(function(){
	$("#main").load("contenido.php");
	closeNav();
});

$('#ver').click(function(){
	$("#main").load("JSON_PRUE/cargaDatosContrato.php");
	closeNav();
});

$('#pagos').click(function(){
	$("#main").load("datosAlquiler.php");
	closeNav();
});

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
//    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
//    document.body.style.backgroundColor = "white";
}
</script>




</body>

</html>