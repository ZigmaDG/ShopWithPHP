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
$mail->addAddress($email);
$mail->Subject = 'Gracias por comprar en Heart Gift';
$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->AltBody = 'This is a plain text message body';
$mail->Body = 'Hola, en estos momentos paypal está verificando el pago. Puedes ver darle seguimiento a tu compra en el apartado <br><b>Mi cuenta </b> <br>

<br><b>Inicia sesión en: </b> http://regalodelcorazon.com/login.php';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>