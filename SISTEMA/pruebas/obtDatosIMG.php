
<?php  

/*ARCHIVO QUE LLENA EL MODAL DE CLIENTES*/
include("../Modales/prueba1.php");
$mensaje = "";

$lista = "";

$var1 = "";

$query = "SELECT * FROM cliente";
//SELECT * FROM cliente WHERE id_cli = 1 ,nombre,apellidos,nick,direccion,celular,correo,rfc,

$response = array();
$arreglo = array();

$resultado=$mysqli->query($query);
$i = 0;
while ($rows = $resultado->fetch_assoc()) {

	$rows['foto'] = base64_encode($rows['foto']);

	$arreglo[$i] = $rows;
	$i++;
}

for ($i=0; $i < $arreglo.lenght ; $i++) { 
print($arreglo[i]);
	# code...
}

if($resultado = $mysqli->query($query)) {
//     $formulario = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	$response = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
}




?>

<html>
<head>
	<meta charset="utf-8">
	<title></title>

</head>
<body>

	<br>
	<br>

	<input type="text" id="ajax" list="json-datalist" placeholder="e.j. datalist">

	<datalist id="json-datalist"></datalist>

	<br>
	<br>

	<script type="text/javascript">

		console.log("javascript");
		var dataList = document.getElementById('json-datalist');
		var input = document.getElementById('ajax');

		//nueva peticion HTTPRequest
		var request = new XMLHttpRequest();
//console.log("ln 44");
		//Tratar las posibles respuestas de la peticion
		request.onreadystatechange = function(response){

			console.log("ln 44"+request.readyState);
			if(request.readyState === 4){
				if (request.status === 200){
					//PRSE JASON
					var jsonOptions = JSON.parse(request.responseText);

					//ciclo atraves del arreglo JSON
					jsonOptions.forEach(function(item){
						//crear un nuevo elemento option
						var option = document.createElement('option');
						//agregar el valor usando la opcion en el arreglo JSON
						option.value = item;

						//agregar el <option> elemento a <datalist>
						dataList.appendChild(option);
					});

					input.placeholder = "e.j. datalist";

					//preparar y hacer la peticion
				}else{
					//ha ocurrido un error
					input.placeholder = "No es posible descargar el datalist :("
				}
			}
		};

		//actualizar el texto del placeholder
			input.placeholder = "Buscando opciones...";

		//preparar y hacer la peticion
		request.open('GET','html-elements.json',true);
		request.send(); 

	</script>

</body>
</html>

<?php

$lista .='
		
'; 

$mensaje .='
	<strog> id: </strong> '.$var1.' <br>
	<strog> Nombre: </strong> '.$response['nombre'].' <br>
	<strog> Apellidos: </strong> '.$response['apellidos'].' <br>
	<strog> Nick: </strong> '.$response['nick'].' <br>
	<strog> direccion : </strong> '.$response['direccion'].' <br>
	<strog> cel: </strong> '.$response['celular'].' <br>
	<strog> correo: </strong> '.$response['correo'].' <br>
	<strog> rfc: </strong> '.$response['rfc'].' <br>
	<strog> fechIni: </strong> '.$response['fechaInicio'].' <br>
	<img  src="data:image/png;base64,'.base64_encode($response['foto']).'" width="100" /> 

';

echo $mensaje;

/*
$resultado=$mysqli->query($query);
print("<table>");
while ($rows = $resultado->fetch_assoc()) {
print("<tr>");
print("<td>".$rows["id_cliente"]."</td>");
print("<td>".$rows["nombre"]."</td>");
print("<td>".$rows["apellidos"]."</td>");
print("</tr>");
}
print("</table>");
$resultado->free();
*/
?>