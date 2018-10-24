
	<style type="text/css">

		*{
			margin: 0;
			padding: 0;
		}
		html{
		    /*modelo de caja para que al agregar un padding no nos afecte en el tamaño del elemento*/
		    box-sizing: border-box;
		}

		*,*:before,*:after{
		    box-sizing: inherit;
		}

		body{
		    background-color: #f2f2f2;
		    font-family: 'Open Sans', sans-serif;
		}
		.contenedor{
		    width: 95%;
		    margin: 0 auto;
		}

		table {
		    width: 100%;
		    border-collapse: collapse;
		    position: absolute;
		}

		table, td, th {
		    border: 1px solid black;
		    padding: 5px;
		}

		#cabecera h1{
			display: block;
			float: left;
			margin: 5px;
		}
		#cabecera img{
			margin: 0;
			padding: 0;
			float: right;
			width: 300px;
			height: 150px;
		}
		#cabecera span{
			float: right;
			display: block;
		}
		h2{
			color: blue;
		}
		#cajas{
			width: 100%;
		}	
		.caja{
			width: 100%;
			height: 40%;
			border: 1px solid black;
			background: #E7E7E7;
			margin-bottom: 5px;
			position: relative;
		}
	</style>


	
	<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">  
	<!--
		devuelve la informacion estructurada sobre una variable 
		<?php var_dump($_POST) ?>
	-->
	<page_header> 
	   	<span> Fecha de emision: 
			<?php 
				//$semanaSiguiente = time() + (7*24*60*60);
				echo date('Y-m-d');
				//echo "Semana Siguiente: ".date('Y-m-d',$semanaSiguiente)."\n";
			?>							
		</span>
	</page_header> 

	<page_footer style="margin-left: 150px;"> 
        &copy; theforcefactory.net <br>
        Avenida 11 sur 1456 Cuautlancingo Puebla C.P. 08978 <br>
        Tel: 2225984218.
    </page_footer> 


 		<?php if (isset($_POST['titulo'])): ?>
			<div id="cabecera">
				<!--<img src="https://html2pdf.fr/img/_langue/es/logo.gif"> -->
				<img src="../img/2.png" alt="LOGO T-F-F">

				<h1>RECIBO DE INSCRIPCION</h1> 
				<h2><?=$_POST['titulo']?></h2>
				<h4>Direccion: <?php echo $_POST['direcc']; ?></h4>
				<h5>No. de Cliente: <?php echo $_POST['idOcul']; ?></h5>
			</div>

	   	<?php endif; ?>	
    	<h3> MAS INFORMACION </h3>

<div class="contenedor caja">


</div>

<br>
<qrcode value="Value to Coder" ec="H" 
		style="width: 30mm;
			background-color: white;
			color: black;
			margin-top: 200px;
			margin-left: 280px;
"></qrcode>
</page>