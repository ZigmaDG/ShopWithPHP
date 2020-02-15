<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
require 'constantes.php';
/*
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'mx1.hostinger.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'info@regalodelcorazon.com';
$mail->Password = 'lq3KJaCq7ZdG';
$mail->setFrom('info@regalodelcorazon.com', 'HEARTGIFT');
$mail->addAddress('guillermo.ramos.r95@gmail.com', 'HOLA memo');
$mail->Subject = 'PHPMailer SMTP message';
$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->AltBody = 'This is a plain text message body';
$mail->Body = 'Hola mundo desde <b>phpmailer</b>';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';}*/

 $email='guillermo.ramos.r95@gmail.com';
 $pass='123456';
    $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'mx1.hostinger.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'info@regalodelcorazon.com';
        $mail->Password = EMAIL_PASSWORD;
        $mail->setFrom('info@regalodelcorazon.com', 'HEARTGIFT');
        $mail->addAddress($email);
        $mail->Subject = 'Gracias por registrarte';
        $mail->msgHTML(file_get_contents('message.html'), __DIR__);
        $mail->AltBody = 'This is a plain text message body';
        $mail->Body = 'Hola estos son tus datos de acceso <br><b>Correo: </b> '.$email.'<br><b>Contraseña: </b> '.$pass;
        $mail->send();
       
?>