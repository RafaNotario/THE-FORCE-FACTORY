<?php 

date_default_timezone_set('Etc/UTC');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(TRUE);

try{
	$mail->IsSMTP();
	$mail->SMTPDebug = 1; //SALIDA DE DATOS DE DEPURACION ENTRE 0 - 4 MENOR MAYOR
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';//con SSL no envia PROTOCOLO DE SEGURIDAD DE LA CAPA DE TRANSPORTE
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;// 587->TLS, 465->SSL
	$mail->Username = "arsagomonitoreo397@gmail.com";
	$mail->Password = "monitoreo6";


	$mail->setFrom('arsagomonitoreo397@gmail.com','arsago monitoreo');

	$mail->addAddress('rafaelnotariorodriguez@gmail.com');
	
//PARA QUE EL CORREOS SEA ANALIZADO COMO HTML 
	$mail->isHTML(true);
	$mail->Body = '<html> Saludos, <strong>Gracias</strong> por elegirnos. <br> Es un <strong> placer </strong> atenderle. </html>';
	$mail->AltBody = 'Saludos, GRACIAS por elegirnos, es un placer atenderle. ';
	
	$mail->Subject = 'THE FORCE FACTORY.net';
	
	//$mail->addCC('kebokorps@hotmail.com','COPIA RECIBO: ');//enviar copia de carbon a mas destinatarios visible para todos
	
	//$mail->addBCC('grupo.arsago.consultor@gmail.com');//copia de carbon no visible en la lista de remitentes

	$mail->Body = 'Prueba de phpmailer';

	$mail->addAttachment('enviar.pdf','RECIBO DE INSCRIPCION TFF');
	$mail->send();

	echo "Enviado";


	}catch (Exception $e){
		echo $e->errorMessage();
	}catch (\Exception $e){
		echo $e->getMessage();
	}

//ultranet

?>

