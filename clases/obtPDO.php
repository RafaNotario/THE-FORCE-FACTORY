<?php 

require_once 'Conexion.php';


	try{
		$dbh = new Conexion();

		$stm = $dbh->prepare("select id_cli,nombre from cliente order by id_cli desc");
		$stm->execute();

		$datos = $stm->fetch();

			echo $datos[0].'<br/>';

	}catch(PDOException $e){
		echo $e->getMessage();
	}
		$dbh = null;
 ?>