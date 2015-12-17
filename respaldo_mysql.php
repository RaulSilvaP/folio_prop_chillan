<?php 
require('class.phpmailer.php');
require('class.smtp.php');
//  PARAMETROS DE CONFIGURACION DEL PROGRAMA DE RESPALDO DE MYSQL CON ENVIO DE EMAIL
$fecha = date("d-m-Y");
$camino = "/home/cbruser/Dropbox/";
$servidor_smtp = "mail.rsp.cl";
$cuenta_origen = "rsilva@rsp.cl";
$nombre_origen = "Raul Silva";
$asunto = "Aviso de respaldo Mysql a Dropbox CBR CHILLAN. ".$fecha;
$body = "Aviso de envio de respaldo de Mysql a Dropbox CBR CHILLAN. Fecha: ".$fecha;
$cuenta_destino = "alarmarsp@gmail.com";
$nombre_destino = "Alarmarsp Gmail";
$username_email = "raulsilva@rsp.cl";
$password_email = "sg91829182";

//**********************************************************************************



$bd_flash="mysqldump --user=root --password=cbruser2015 flash > ".$camino."flash_".$fecha.".sql";
$bd_cbr="mysqldump --user=root --password=cbruser2015 cbr > ".$camino."cbr_".$fecha.".sql";
$bd_indices="mysqldump --user=root --password=cbruser2015 indices > ".$camino."indices_".$fecha.".sql";
$bd_inscripciones="mysqldump --user=root --password=cbruser2015 inscripciones > ".$camino."inscripciones_".$fecha.".sql";


system($bd_flash);
system($bd_cbr);
system($bd_indices);
system($bd_inscripciones);



$mail = new PHPMailer();

$mail->IsSMTP();

/* Sustituye (ServidorDeCorreoSMTP)  por el host de tu servidor de correo SMTP*/
$mail->Host = $servidor_smtp;

/* Sustituye  ( CuentaDeEnvio )  por la cuenta desde la que deseas enviar por ejem. prueba@domitienda.com  */

$mail->From = $cuenta_origen;

$mail->FromName = $nombre_origen;	

$mail->Subject = $asunto;

$mail->AltBody = "prueba";

$mail->MsgHTML($body);

/* Sustituye  (CuentaDestino )  por la cuenta a la que deseas enviar por ejem. admin@domitienda.com  */
$mail->AddAddress($cuenta_destino, $nombre_destino);

$mail->SMTPAuth = true;

/* Sustituye (CuentaDeEnvio )  por la misma cuenta que usaste en la parte superior en este caso  prueba@domitienda.com  y sustituye (ContraseñaDeEnvio)  por la contraseña que tenga dicha cuenta */

$mail->Username = $username_email;
$mail->Password = $password_email;

if(!$mail->Send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
} else {
echo "Message sent!";
}



 ?>