<?php 
session_start();
require_once 'conexion.php';
$ID_USUARIO =$_SESSION['usuario'][0]['ID_USUARIO'];

$total = openssl_decrypt($_POST['total']);
$total_verificador=$_SESSION['total'];
$email = $_SESSION['usuario'][0]['EMAIL'];
$subject = "Gracias por  comprar en Heartgift.com";
$message = " Puedes consultar detalles en el apartado MI CUENTA>COMPRAS ";
if($total!=$total_verificador){
    $total=$total_verificador;
}
function generateRandomString($length = 17) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$folio =  generateRandomString();

if(isset($_SESSION['ent_personal']) && $_SESSION['ent_personal']==1){
    $SID=session_id();
 
    $mensaje_pago="<h3>Pago aprovado</h3>";

     /*SENTENCIA PARA SUBIR VENTA*/
       $sentencia=$pdo->prepare("INSERT INTO VENTA VALUES(ID_VENTA, :ID_USUARIO, :TOTAL_VENTA, 0, NOW(), 2, :FOLIO, 'DEPOSITO', :MSJ, :FECHA)");
 
       $sentencia->bindParam(':ID_USUARIO', $ID_USUARIO);
       $sentencia->bindParam(':TOTAL_VENTA', $total);
       
       //$sentencia->bindParam(':ESTADO', $Status_transaccion);
       $sentencia->bindParam(':FOLIO', $folio);
       $sentencia->bindParam(':MSJ', $_SESSION['info_envio'][0]['MSJ']);
       $sentencia->bindParam(':FECHA', $_SESSION['info_envio'][0]['FECHA']);

       $sentencia->execute();

       $id_venta= $pdo->lastInsertId();

       
/*SENTENCIA PARA SUBIR DETALLE DE VENTA*/

    foreach($_SESSION['Carrito'] as $indice=>$producto)
    {

       $sentencia=$pdo->prepare("INSERT INTO DETALLE_VENTAS VALUES(ID_DETALLE_VENTA, :ID_PRODUCTO, :CANTIDAD_PRODUCTO, :PRECIO, :ID_VENTA)");
       $sentencia->bindParam(':ID_PRODUCTO', $producto['ID']);
       $sentencia->bindParam(':CANTIDAD_PRODUCTO', $producto['CANTIDAD']);
       $sentencia->bindParam(':PRECIO', $producto['PRECIO']);
       $sentencia->bindParam(':ID_VENTA', $id_venta);
       $sentencia->execute();
       


      
       /**/
    }

       /*SENTENCIA ENVÍO */

       $sentencia_env=$pdo->prepare("INSERT INTO ENVIO_VENTAS VALUES(ID_ENVIO, :DIRECCION,2, :VENTA, :RECIBE, :TEL, :HORARIO)");
       $sentencia_env->bindParam(':DIRECCION', $_SESSION['info_envio'][0]['DIR']);
       $sentencia_env->bindParam(':VENTA', $id_venta);
       $sentencia_env->bindParam(':RECIBE', $_SESSION['info_envio'][0]['DESTINATARIO']);
       $sentencia_env->bindParam(':TEL', $_SESSION['info_envio'][0]['NUM_CONTACTO']);
       $sentencia_env->bindParam(':HORARIO', $_SESSION['info_envio'][0]['HORARIO']);
       $sentencia_env->execute();
       unset($_SESSION['Carrito']);
       unset($_SESSION['Cont']);
       unset($_SESSION['info_envio']);
       $_SESSION['Confirm']=0;
       include 'mail_deposito.php';
       include 'mail_compra.php';



       echo'

       <html>
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


       </html>

       <script type="text/javascript"> swal({
               title: "¡PEDIDO HECHO!",
               text: "Por favor deposita máximo en 48hrs, envia tu comprobante y #folio por WhatsApp 4491818616",
               icon: "success",
               type: "success"
           }).then(function() {
               window.location = "index.php";
           });</script>
       ';

 }else{
    $SID=session_id();
 
    $mensaje_pago="<h3>Pago aprovado</h3>";

     /*SENTENCIA PARA SUBIR VENTA*/
       $sentencia=$pdo->prepare("INSERT INTO VENTA VALUES(ID_VENTA, :ID_USUARIO, :TOTAL_VENTA, 0, NOW(), 2, :FOLIO, 'DEPOSITO', :MSJ, :FECHA)");
 
       $sentencia->bindParam(':ID_USUARIO', $ID_USUARIO);
       $sentencia->bindParam(':TOTAL_VENTA', $total);
       
       //$sentencia->bindParam(':ESTADO', $Status_transaccion);
       $sentencia->bindParam(':FOLIO', $folio);
       $sentencia->bindParam(':MSJ', $_SESSION['info_envio'][0]['MSJ']);
       $sentencia->bindParam(':FECHA', $_SESSION['info_envio'][0]['FECHA']);

       $sentencia->execute();

       $id_venta= $pdo->lastInsertId();

       
/*SENTENCIA PARA SUBIR DETALLE DE VENTA*/

    foreach($_SESSION['Carrito'] as $indice=>$producto)
    {
       $sentencia=$pdo->prepare("INSERT INTO DETALLE_VENTAS VALUES(ID_DETALLE_VENTA, :ID_PRODUCTO, :CANTIDAD_PRODUCTO, :PRECIO, :ID_VENTA)");
       $sentencia->bindParam(':ID_PRODUCTO', $producto['ID']);
       $sentencia->bindParam(':CANTIDAD_PRODUCTO', $producto['CANTIDAD']);
       $sentencia->bindParam(':PRECIO', $producto['PRECIO']);
       $sentencia->bindParam(':ID_VENTA', $id_venta);
       $sentencia->execute();
       


      
       /**/
    }

       /*SENTENCIA ENVÍO */

       $sentencia_env=$pdo->prepare("INSERT INTO ENVIO_VENTAS VALUES(ID_ENVIO, :DIRECCION, 1, :VENTA, :RECIBE, :TEL, :HORARIO)");
       $sentencia_env->bindParam(':DIRECCION', $_SESSION['info_envio'][0]['DIR']);
       $sentencia_env->bindParam(':VENTA', $id_venta);
       $sentencia_env->bindParam(':RECIBE', $_SESSION['info_envio'][0]['DESTINATARIO']);
       $sentencia_env->bindParam(':TEL', $_SESSION['info_envio'][0]['NUM_CONTACTO']);
       $sentencia_env->bindParam(':HORARIO', $_SESSION['info_envio'][0]['HORARIO']);
       $sentencia_env->execute();
       unset($_SESSION['Carrito']);
       unset($_SESSION['info_envio']);
       unset($_SESSION['Cont']);
       $_SESSION['Confirm']=0;
       include 'mail_deposito.php';
       include 'mail_compra.php';
       echo'

       <html>
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


       </html>

       <script type="text/javascript"> swal({
               title: "¡PEDIDO HECHO!",
               text: "Por favor deposita máximo en 48hrs, envia tu comprobante y #folio por WhatsApp 4491818616",
               icon: "success",
               type: "success"
           }).then(function() {
               window.location = "index.php";
           });</script>
       ';
 }



?>