<?php 
require_once '../clases/Conexion.php';
//$conexion = new Conexion();
/* PASS phpmyadmin VESTA 0ehn4TNU5I resp_tff
MYSLDUMP ruta resp -> /home/respSQL/respadmin_tff.sql.gz
	mysqldump -u root -p --routines=TRUE db_doctores | gzip > resdoctoresVACIA.sql.gz

	mysqldump -u root -p --routines=TRUE admindcr | gzip> respadmin_DCR.sql.gz


	mysqldump -uusuario -pclaveusuario --routines=TRUE basedatos>archivo.sql
	mysql -u root -p admin_tff < respadmin_tff.sql

realizar respaldo de aws a local
rsync -avz respsql@18.228.68.134:/home/respSQL/respadmin_tff.sql.gz /cygdrive/c
ajustar db
1 Agregar campo status a tabla contrato
2 Agregar relaciones:

alter table contrato add foreign key (id_cli) references cliente (id_cli) on delete cascade on update cascade;
alter table contrato add foreign key (id_concepto) references conceptos (id_concepto) on delete cascade on update cascade;
3 crear tabla pagos
CREATE TABLE IF NOT EXISTS pagos(
	id_pago INT NOT NULL AUTO_INCREMENT,
	id_contrato int not null,
	fecha_pago date,
	fecha_proxPagoM date,
	status varchar(15),
	PRIMARY KEY (id_pago),
	FOREIGN KEY (id_contrato)
	REFERENCES contrato(id_contrato) 
	ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=INNODB;
DISABLE CHECK FOREIGN KEY
--SET FOREIGN_KEY_CHECKS=0;


function conexion(){
//try{
	$conn = new PDO('mysql:host=localhost;dbname=ff','root','');
	$conn -> exec("set names utf8");
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//}catch(PDOException $e){
//	echo "ERROR: ".$e->getMessage();
//}
return $conn;
}
"SELECT a.id_cli,a.nombre,a.apellidos,a.direccion,b.status,b.fecha_contrato
        FROM cliente a
        LEFT JOIN contrato b
        ON a.id_cli = b.id_cli
        ORDER BY a.id_cli
        ";
*/
if (isset($_POST['funcion']) && !empty($_POST["funcion"])) {
	$func=$_POST['funcion'];
}

switch ($func) {
	case 'funcion1':
		if((isset($_POST['descriP']) && !empty($_POST['descriP'])) && (isset($_POST['costoP']) && !empty($_POST['costoP']))  ){	
		$nomC=$_POST['nomConc'];
		$des=$_POST['descriP'];
		$cos=$_POST['costoP'];
		insertaConceptos($nomC,$des,$cos);
		echo "1";
	}else{
		echo "0";
	}
		break;
	
	case 'funcion2':
	if( (isset($_POST['idcli']) && !empty($_POST['idcli'])) &&(isset($_POST['idopt']) && !empty($_POST['idopt']))  ){
		$idc = $_POST['idcli'];
		$ido = $_POST['idopt'];
		$fec = $_POST['fechc'];
		$mes = $_POST['mesin'];
		$pag = $_POST['pag'];
		
		insertaCont($idc,$ido,$fec,$mes,$pag);
		
		echo getContrato();
	}else{
		echo "0";
	}		
		break;

	case 'funcionMens':
		if( (isset($_POST['idcontr']) && !empty($_POST['idcontr'])) &&(isset($_POST['fpm']) && !empty($_POST['fpm']))  ){
			$idc = $_POST['idcontr'];
			$fpm = $_POST['fpm'];
			$fppm = $_POST['fppm'];
			$pag = $_POST['pag'];
			
			insertaMens($idc,$fpm,$fppm,$pag);		
		echo "1";
	}else{
		echo "0";
	}
		break;

	case 'getfech':
		if( isset($_POST['param2']) && !empty($_POST['param2']) ){
		$llego = $_POST['param2'];
		$retor = get_proximP($llego);
					
		echo $retor;

	}else{
		echo "0";
	}
		break;

	case 'funcionAsist':
		if( (isset($_POST['idcontr']) && !empty($_POST['idcontr'])) &&(isset($_POST['fpm']) && !empty($_POST['fpm']))  ){
			$idA = $_POST['idcontr'];
			$fA = $_POST['fpm'];
			
			insertAsist($idA,$fA);		
		echo "1";
	}else{
		echo "0";
	}
		break;
	default:
		echo "DESCONOCIDA";
		break;
}

//*****FUNCIONES DE INSERCION 
function insertaConceptos($nomC,$descr,$coast){
	try{
		$dbh = new Conexion();
		$consulta = "INSERT INTO conceptos(nombreConc,descripcion,costo) VALUES('".$nomC."','".$descr."','".$coast."')";
		$dbh->exec($consulta);
	}catch(PDOException $e){
		echo $e->getMessage();
	}
		$dbh = null;
}

function insertaCont($idcli,$idopt,$fechc,$mesin,$pag){
	try{
		$dbh = new Conexion();
		$consulta = "INSERT INTO contrato(id_cli,id_concepto,fecha_contrato,mes_ini,status) VALUES('".$idcli."','".$idopt."','".$fechc."','".$mesin."','".$pag."')";
			$dbh->exec($consulta);
	}catch(PDOException $e){
		echo $e->getMessage();
	}
		$dbh = null;
}

function insertaMens($idc,$fpm,$fppm,$pag){
	try{
		$dbh = new Conexion();
		$consulta = "INSERT INTO pagos(id_contrato,fecha_pago,fecha_proxPagoM,status) VALUES('".$idc."','".$fpm."','".$fppm."','".$pag."')";
			$dbh->exec($consulta);
	}catch(PDOException $e){
		echo $e->getMessage();
	}
		$dbh = null;
}

function insertAsist($idA,$fA){
	try{
		$dbh = new Conexion();
		$consulta = "INSERT INTO asistencias(id_cli,fecha) VALUES('".$idA."','".$fA."')";
			$dbh->exec($consulta);
	}catch(PDOException $e){
		echo $e->getMessage();
	}
		$dbh = null;
}

//FUNCIONES DE RECUPERACION DE DATOS
function getContrato(){
	$ultimoC="";
	try{
		$dbh = new Conexion();
		$stm = $dbh->prepare("select id_contrato from contrato order by id_contrato desc");
		$stm->execute();
		$datos = $stm->fetch();
			$ultimoC = $datos[0];
	}catch(PDOException $e){
		echo $e->getMessage();
	}
		$dbh = null;
	return $ultimoC;
}

function get_proximP($param){
	$ultimoP="";
	try{
		$dbh = new Conexion();
		$stm = $dbh->prepare("select fecha_proxPagoM from pagos where id_contrato = '".$param."' order by id_pago DESC");
		$stm->execute();
		$datos = $stm->fetch();
			$ultimoC = $datos[0];

	}catch(PDOException $e){
		echo $e->getMessage();
	}
		$dbh = null;
	return $ultimoC;
}

function existeContrato(){
	return $param;
}
?>