<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>GENERAR PDF CON PHP</title>

	<style type="text/css">
		#cabecera h1{
			display: block;
			float: left;
		}
		#cabecera img{
			float: right;
		}
		h2{
			color: blue;
		}
		#cajas{
			width: 100%;
		}	
		.caja{
			width: 100%;
			height: 150px;
			border: 1px solid black;
			background: #cccccc;
			margin-bottom: 5px;
		}
		.rojo{
			background-color: red;
		}
		.azul{
			background-color: blue;
		}
		.verde{
			background-color: green;
		}
		.amarillo{
			background-color: yellow;
		}


	</style>
</head>

<body>

	
	<!--
		devuelve la informacion estructurada sobre una variable 
		<?php var_dump($_POST) ?>
	-->
		<?php if (isset($_POST['titulo'])): ?>
			<div id="cabecera">
				<img src="https://html2pdf.fr/img/_langue/es/logo.gif">
				<h1><?=$_POST['titulo']?></h1> 
			</div>
	   	<?php endif; ?>

	
	<h2> MAS INFORMACION </h2>

	<div id="cajas">
		<div class="caja rojo"></div>
		<div class="caja azul"></div>
		<div class="caja verde"></div>
		<div class="caja amarillo"></div>
	</div>

	<table border="1">
		<tr>
			<td>Redes inalamabricas</td>
			<td>Desarrollo</td>
		</tr>
		<tr>
			<td>Camaras de Seguridad</td>
			<td>Paginas Web</td>
		</tr>
	</table>
</body>
</html>