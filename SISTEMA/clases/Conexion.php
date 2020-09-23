<?php

class Conexion extends PDO{
	private $db = 'mysql';
	private $host = 'localhost:3310';//:3310
	private $nomDB = 'ff';
	private $usuario = 'root';
	private $contraseña = '';//KSWAiFUlPy

	public function __construct(){
		//sobrescribimos el metodo constructor de la clase PDO
		try{
			parent::__construct($this->db.':host='.$this->host.';dbname='.$this->nomDB,$this->usuario,$this->contraseña);
		}catch(PDOException $e){
			echo "ha ocurrido un error. Detalle: ".$e->getMessage();
			exit();
		}
	}
}
//132.148.19.178
 ?>