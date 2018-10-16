<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try{
	$mail->IsSMTP();
	$mail->SMTPDebug = 2; //con =1 no envia
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';//con SSL no envia
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;// 587 465
	$mail->Username = "arsagomonitoreo397@gmail.com";
	$mail->Password = "monitoreo6";


	$mail->setFrom('arsagomonitoreo397@gmail.com','arsago monitoreo');

	$mail->addAddress('monitoreoarsago@hotmail.com');
	$mail->isHTML(true);

	$mail->Subject = 'HP CUENTA';

	$mail->Body = 'Prueba de phpmailer';

	$mail->send();
	echo "Enviado";


	}catch (Exception $e){
		echo $e->errorMessage();
	}catch (\Exception $e){
		echo $e->getMessage();
	}

//ultranet

?>

