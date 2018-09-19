<?php 

require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

if (isset($_POST['contrato'])) {

	ob_start();
	require_once 'inscripcion.php';
	$contenido = ob_get_clean();


$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($contenido);
$html2pdf->output();

}else
 echo "<h1>SIN PARAMETROS </h1>";
 ?>

