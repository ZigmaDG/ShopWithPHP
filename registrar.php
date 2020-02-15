<?php
require_once 'conexion.php';
$nombre=$_POST['name'];
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
require 'constantes.php';
$telefono=$_POST['N_tel'];
$email=$_POST['email'];
$pass=$_POST['password'];


$sentencia=$pdo->prepare("SELECT * FROM TABLA_ACCESOS WHERE EMAIL=:email");
$sentencia->bindParam(':email',$email);
$sentencia->execute();
$Email_existente= $sentencia->rowCount();

if($Email_existente==1){
    echo '
    <html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</html>
    
    
    
    <script type="text/javascript">',
    'swal({
      title: "USUARIO EMAIL YA EXISTE",
      text: "Verificar la información ingresada",
      icon: "error",
      type: "error"
  }).then(function() {
      window.location = "Registro.php";
  });',
    '</script>';   
 }else{
    $sentencia_2=$pdo->prepare("INSERT INTO USUARIO VALUES(ID_USUARIO, :NOMBRE, :EMAIL, :N_TEL)");
    $sentencia_2->bindParam(':NOMBRE',$nombre);
    $sentencia_2->bindParam(':EMAIL',$email);
    $sentencia_2->bindParam(':N_TEL',$telefono,PDO::PARAM_INT);
    $sentencia_2->execute();

    $sentencia_3=$pdo->prepare("SELECT * FROM USUARIO WHERE EMAIL=:email");
    $sentencia_3->bindParam(':email',$email);
    $sentencia_3->execute();

    $Email_existente= $sentencia_3->rowCount();
    $Datos_usuario=$sentencia_3->fetchAll(PDO::FETCH_ASSOC);
    $ID_USUARIO = $Datos_usuario[0]['ID_USUARIO'];


    if($Email_existente==1){
        $sentencia_4=$pdo->prepare("INSERT INTO TABLA_ACCESOS VALUES(ID_ACCESOS_USUARIO, :ID_USUARIO, :EMAIL, :PASS)");
        $sentencia_4->bindParam(':ID_USUARIO',$ID_USUARIO,PDO::PARAM_INT);
        $sentencia_4->bindParam(':EMAIL',$email);
        $sentencia_4->bindParam(':PASS',$pass);
        $sentencia_4->execute();

        $sentencia_5=$pdo->prepare("INSERT INTO TABLA_USUARIO_ROL VALUES(ID_USUARIO_ROL, 2, :ID_USUARIO)");
        $sentencia_5->bindParam(':ID_USUARIO',$ID_USUARIO,PDO::PARAM_INT);
        $sentencia_5->execute();
 
        include 'mail_registro.php';
       
        echo'<html>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
            
            </html>
            
            <script> swal({
                    title: "¡REGISTRADO!",
                    text: "EL EMAIL CON TUS DATOS PUEDE TARDAR 24HRS EN LLEGAR",
                    icon: "success",
                    type: "success"
                }).then(function() {
                    window.location = "login.php";
                });</script>';
    }

 }
?>