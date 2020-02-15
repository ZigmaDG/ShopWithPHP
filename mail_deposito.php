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
$mail->Subject = 'En espera del comprobante de pago para Heart Gift';
$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->AltBody = 'This is a plain text message body';
$mail->Body = 'Hola, en estos momentos estamos preparando tus productos y esperando la confirmación del depósito. Puedes darle seguimiento a tu compra en el apartado <br><b>Mi cuenta </b> <br>
con el siguiente folio: <b> '.$folio.'</b><br> Por favor deposita máximo en 48hrs , envía tu comprobante y #folio por WhatsApp 4491818616 o a <b>ventas.heartgift@gmail.com</b>
<br><b>Inicia sesión en: </b> http://regalodelcorazon.com/login.php <br>
<p>No Cuenta: 4152 3134 3487 3035</p>
<p>BBVA Bancomer</p>';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>