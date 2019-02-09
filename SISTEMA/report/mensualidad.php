
	<style type="text/css">

		*{
			margin: 0;
			padding: 0;
		}
		html{
		    /*
			prueba@nobosys.tk
			hA7QwdpGKO

			vesta 
			admin
			VudhQwZaf3

			ftp the force f
			user: admin_tff
			pass: x9SfFI3NHL

			user: kebo@theforcefactorymx.com
			pass: av8Ni4JBz6
			
			rafa_notario@nobosys.tk
			pass: HG8bBvUZmq

			bd :  admin_tff;
			user: admin_tff1
			pass: 6dFyyeVKTT

		    modelo de caja para que al agregar un padding no nos afecte en el tamaño del elemento
		    */
		    box-sizing: border-box;
		}
		*,*:before,*:after{
		    box-sizing: inherit;
		}

		body{
		    background-color: #f2f2f2;
		    font-family: 'Open Sans', sans-serif;
		}

		p{
			font-size: 17px;
			margin-top: 10px;
		}

		table {
		    font-family: arial, sans-serif;
		    border-collapse: collapse;
		    width: 90%;
		    margin-left: 50px;
		}

		td, th {
		    text-align: left;
		    padding: 20px;
		}
		tr:nth-child(even) {
		    background-color: rgba(242,190,84,.6)!important;
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
		.caja{
			width: 100%;
			height: 40%;
			border: 1px solid black;
			background: #E7E7E7;
			margin-bottom: 5px;
			position: relative;
			margin: 0 auto;
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
				date_default_timezone_set("America/Mexico_City");
				echo date('Y-m-d')." ".date("h:i:s");
				//echo "Semana Siguiente: ".date('Y-m-d',$semanaSiguiente)."\n";
			?>							
		</span>
	</page_header> 

	<page_footer style="margin-left: 150px;"> 
       <span>theforcefactorymx.com </span> <br>
        Direccion: Solares #33 San Juan Cuautlancingo. <br>
        Tel: 2228205120. <br>
        Mail: admin@theforcefactorymx.com
    </page_footer> 


 		<?php if (isset($_POST['titulo'])): ?>
			<div id="cabecera">
				<!--<img src="https://html2pdf.fr/img/_langue/es/logo.gif"> -->
				<img src="../img/report.jpg" alt="LOGO T-F-F">

				<h4>RECIBO MENSUALIDAD</h4>
				<h4>Estimado (a):</h4>
				<h2><?=$_POST['titulo']?></h2>
				<h4>Direccion: <?php echo $_POST['direcc']; ?></h4>
				<h5>No. de Cliente: <?php echo $_POST['idOcul']; ?></h5>
			</div>

	   	<?php endif; ?>	
    	<h3> MAS INFORMACION </h3>

<div class="caja">

<table id="customers">
  <tr>
    <td><b>Nombre de paquete: </b></td>
    <td> <?=$_POST['paqC']; ?></td>
  </tr>
  <tr>
    <td><b>Descripcion:</b> </td>
    <td> <?=$_POST['descriM']; ?></td>
  </tr>
  <tr>
    <td><b>Costo:</b> </td>		
    <td> <?=$_POST['costM']; ?></td>
  </tr>

  <tr>
  	<td> <b>FECHA DE PAGO:</b> <br>
  		<?=$_POST['fechM']; ?>
  	</td>
	
	<td> <b>FECHA DE PROXIMO PAGO: </b> <br>
			<?=$_POST['fechProxM']; ?>
	</td>
  </tr>

</table>



	
</div>

<br>

<qrcode value="theforcefactorymx.com" ec="H" 
		style="width: 30mm;
			background-color: white;
			color: black;
			margin-top: 200px;
			margin-left: 280px;
"></qrcode>

</page>