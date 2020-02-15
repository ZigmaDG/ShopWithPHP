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
$mail->Username = 'ventas@regalodelcorazon.com';
$mail->Password = 'ukotzxnBJF2y';
$mail->setFrom('ventas@regalodelcorazon.com', 'Heart Gift');
$mail->addAddress('ventas.heartgift@gmail.com');
$mail->Subject = 'Compraron';
$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->AltBody = 'This is a plain text message body';
$mail->Body = 'Puedes ver el detalle de la venta con el siguiente folio: <b> '.$folio.'</b><br>
<br><b>Inicia sesión en: </b> http://regalodelcorazon.com/login.php';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>