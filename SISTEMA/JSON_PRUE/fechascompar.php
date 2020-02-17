<?php 

$fecha_actual = date("d-m-Y");
//sumo 1 día
echo "+ 1  meses <br>";
echo date("d-m-Y",strtotime($fecha_actual."+ 1 month")); 
echo "<br>-1 dia <br>";
//resto 1 día
echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 
?>

<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" charset="utf-8"></script>

<div>
	<br>
		<label>Fecha 1</label>
		<input type="date" name="fech" id="fech" value="<?php 
      date_default_timezone_set("America/Mexico_City");
      echo date('Y-m-d'); ?>" onchange="getfech(event)">
<br>
<br>
      <label>Fecha 2</label>
		<input type="date" name="fech2" id="fech2" value="<?php 
      date_default_timezone_set("America/Mexico_City");
      echo date('Y-m-d'); ?>" onchange="getfech(event)">

</div>

<button onclick="getfech()">Envia</button>

<script>
	function getfech(e){
		var temp = $("#fech").val();
		//var fech1 = document.getElementById('fech');
	//	console.log(temp);//e.target.value
//		var parametro = temp;
		$.get('funciones.php',{funcion:"anualidad",mensual:temp}, function(data) {
			var datos = JSON.parse(data);
			console.log(datos.proxFech);
			
			$('#fech2').val(datos.proxFech);
        }); // close getJSON()
	}
</script>

</html>