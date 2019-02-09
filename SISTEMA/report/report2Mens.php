<?php 
date_default_timezone_set('America/Mexico_City');
use Spipu\Html2Pdf\Html2Pdf;//para pdf
use PHPMailer\PHPMailer\PHPMailer;//para mailer
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
if (isset($_POST['contrato'])) {
$mail = new PHPMailer(TRUE);
	ob_start();
	require_once 'mensualidad.php';
	$contenido = ob_get_clean();
	$html2pdf = new Html2Pdf('P','A4','es',false,'UTF-8');//mL mT mR mB
	$html2pdf->writeHTML($contenido);
	$html2pdf->output();// funciona -> '','S'
	$doc = $html2pdf->output('','S');// funciona -> '','S' se obtiene el pdf en forma de cadena de texto
try{
	$mail->IsSMTP();
	$mail->SMTPDebug = 0; //SALIDA DE DATOS DE DEPURACION ENTRE 0 - 4 MENOR MAYOR
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';//con SSL no envia PROTOCOLO DE SEGURIDAD DE LA CAPA DE TRANSPORTE
	$mail->Host = "smtp.gmail.com";//smtp.gmail.com
	$mail->Port = 587;// 587->TLS, 465->SSL tenia 25
	$mail->Username = "arsagomonitoreo397@gmail.com";//arsagomonitoreo397@gmail.com
	$mail->Password = "1-Bikepsito1000000";//monitoreo6
	$mail->setFrom('admin@theforcefactorymx.com','RECIBO MENSUALIDAD TFF');//arsagomonitoreo397@gmail.com arsago monitoreo 
	$mail->addAddress($_POST['mail']);
	
//PARA QUE EL CORREOS SEA ANALIZADO COMO HTML 
	$mail->isHTML(true);
	$mail->Body = '<html> Saludos, <strong>Gracias</strong> por elegirnos. <br> Es un <strong> placer </strong> atenderle. </html>';
	$mail->AltBody = 'Saludos, GRACIAS por elegirnos, es un placer etenderle. ';
	
	$mail->Subject = 'theforcefactorymx.com';
	
	//$mail->addCC('kebokorps@hotmail.com','COPIA RECIBO MENSUALIDAD: ');//enviar copia de carbon a mas destinatarios visible para todos
	
	$mail->addBCC('rafaelnotariorodriguez@gmail.com','COPIA RECIBO MENSUALIDAD');//copia de carbon no visible en la lista de remitentes
	$mail->Body = 'Recibo de pago mensualidad The Force Factory';
	date_default_timezone_set("America/Mexico_City");
	$mail->addStringAttachment($doc,'C_'.Date("Y-m-d",time()).'.pdf','base64','application/pdf');
	
	$mail->send();
	echo "Enviado";
	}catch (Exception $e){
		echo $e->errorMessage();
	}catch (\Exception $e){
		echo $e->getMessage();
	}
}else
 echo "<h1>SIN PARAMETROS </h1>";
 ?>