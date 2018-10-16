<?php 


use Spipu\Html2Pdf\Html2Pdf;

require '../vendor/autoload.php';

if (isset($_POST['contrato'])) {

	ob_start();
	require_once 'inscripcion.php';
	$contenido = ob_get_clean();


$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($contenido);
$doc = $html2pdf->output('enviar.pdf');




}else
 echo "<h1>SIN PARAMETROS </h1>";
 ?>

