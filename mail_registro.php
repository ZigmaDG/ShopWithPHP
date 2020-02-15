<?php 
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
require 'constantes.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'mx1.hostinger.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'info@regalodelcorazon.com';
$mail->Password = EMAIL_PASSWORD;
$mail->setFrom('info@regalodelcorazon.com', 'Heart Gift');
$mail->addAddress($email);
$mail->Subject = 'Gracias por registrarte';
$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->AltBody = 'This is a plain text message body';
$mail->Body = 'Hola, estos son tus datos de acceso <br><b>Correo: </b> '.$email.'<br><b>Contraseña: </b> '.$pass.'
<br><b>Inicia sesión en: </b> http://regalodelcorazon.com/login.php';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>