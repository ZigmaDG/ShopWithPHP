<?php 
require_once 'conexion.php';
$correo = $_POST['username'];


$sentencia=$pdo->prepare("SELECT EMAIL, PASS FROM TABLA_ACCESOS WHERE EMAIL= :EMAIL");
$sentencia->bindParam(':EMAIL',$correo);
$sentencia->execute();
$exite=$sentencia->rowCount();
$datos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

if($exite==1){
    foreach($datos as $enviar){

        $message='Aqui estan tus datos de acceso: Correo '.$enviar['EMAIL'].' Contraseña: '.$enviar['PASS'];
        mail($enviar['EMAIL'], 'DATOS DE ACCESO', $message);
        echo'

        <html>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        </html>

        <script type="text/javascript"> swal({
                title: "¡DATOS ENVIADOS!",
                text: "revisa tu correo",
                icon: "success",
                type: "success"
            }).then(function() {
                window.location = "login.php";
            });</script>
        ';

        
    }
}else{
    echo'

         <html>
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


         </html>

         <script type="text/javascript"> swal({
                 title: "¡NO EXISTE ESTE USUARIO!",
                 text: "verifica la información",
                 icon: "error",
                 type: "error"
             }).then(function() {
                 window.location = "recuperar_cuenta.php";
             });</script>
         ';
}

?>