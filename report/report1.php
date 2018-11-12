<?php 
date_default_timezone_set('Etc/UTC');
use Spipu\Html2Pdf\Html2Pdf;//para pdf
use PHPMailer\PHPMailer\PHPMailer;//para mailer
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
if (isset($_POST['contrato'])) {
$mail = new PHPMailer(TRUE);
	ob_start();
	require_once 'inscripcion.php';
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
	$mail->Port = 25;// 587->TLS, 465->SSL
	$mail->Username = "arsagomonitoreo397@gmail.com";//arsagomonitoreo397@gmail.com
	$mail->Password = "monitoreo6";//monitoreo6
	$mail->setFrom('arsagomonitoreo397@gmail.com','CONTRATO TFF');//arsagomonitoreo397@gmail.com arsago monitoreo 
	$mail->addAddress($_POST['mail']);
	
//PARA QUE EL CORREOS SEA ANALIZADO COMO HTML 
	$mail->isHTML(true);
	$mail->Body = '<html> Saludos, <strong>Gracias</strong> por elegirnos. <br> Es un <strong> placer </strong> atenderle. </html>';
	$mail->AltBody = 'Saludos, GRACIAS por elegirnos, es un placer etenderle. ';
	
	$mail->Subject = 'theforcefactorymx.com';
	
	//$mail->addCC('kebokorps@hotmail.com','COPIA RECIBO: ');//enviar copia de carbon a mas destinatarios visible para todos
	
	//$mail->addBCC('grupo.arsago.consultor@gmail.com');//copia de carbon no visible en la lista de remitentes
	$mail->Body = 'Contrato de inscripcion The Force Factory';
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