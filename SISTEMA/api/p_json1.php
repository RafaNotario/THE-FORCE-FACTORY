
<?php
$var = "";

$var = $_GET['term'];

$myObj = new stdClass();

$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";

$myObj->param = $var;

$response = array();

$myJSON = json_encode($myObj);

$mensaje = "";

if (empty($var)) {

	echo $myJSON;
}else{
	echo $myJSON;
};

//echo $myJSON;

?>