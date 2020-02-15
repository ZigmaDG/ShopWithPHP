<?php 
session_start();
require_once 'conexion.php';
$ID_USUARIO =$_SESSION['usuario'][0]['ID_USUARIO'];
$folio=$_GET['Orderid'];
$clientID="AR456NbW_u3nBISmNZGtCkuYnVEAvtb-YRB1hCKT4X4D29nkpn9vIMjtdxiPtrHTnmRQjaizab4FhUIV";
$secret="EF3G24GTQhUQJTZhowWbdeVqThdOD7A6iaTrcsnXUMk8ia6BNZxFTPnTGpXcQVFQH-WLlHl0i3_vxXqq";


$sentencia_orden=$pdo->prepare("SELECT FOLIO FROM VENTA WHERE FOLIO= :ORDEN");
$sentencia_orden->bindParam(':ORDEN',$folio);
$sentencia_orden->execute();
$existe_orden=$sentencia_orden->rowCount();


$email = $_SESSION['usuario'][0]['EMAIL'];
$subject = "Gracias por  comprar en Heartgift.com";
$message = " Puedes consultar detalles en el apartado MI CUENTA>COMPRAS ";
   $Login= curl_init("https://api.paypal.com/v1/oauth2/token");
   curl_setopt($Login,CURLOPT_RETURNTRANSFER,TRUE);
   curl_setopt($Login,CURLOPT_USERPWD,$clientID.":".$secret);
   curl_setopt($Login,CURLOPT_POSTFIELDS,"grant_type=client_credentials");
   $RESPUESTA=curl_exec($Login);

   
   $objRespuesta=json_decode($RESPUESTA);
   $accessToken=$objRespuesta->access_token;
   


   $Venta= curl_init("https://api.paypal.com/v2/checkout/orders/".$folio);
   curl_setopt($Venta,CURLOPT_HTTPHEADER,array("Content-Type: application/json","Authorization: Bearer ".$accessToken));
   curl_setopt($Venta, CURLOPT_RETURNTRANSFER, true);



   $Respuesta_venta=curl_exec($Venta);
  // print_r($Respuesta_venta);   

  $objDatos_transaccion = json_decode($Respuesta_venta);
  // $obj_prueba=json_decode($Respuesta_venta->getBody()->getContents())[0];
   //print_r($objDatos_transaccion->links);
  // $arrdatos_transaccion = get_object_vars($objDatos_transaccion);
   //print_r($arrdatos_transaccion);
   //print_r($obj_prueba);

   $merchant_id=$objDatos_transaccion->purchase_units[0]->payee->merchant_id;
   $email_cobrador=$objDatos_transaccion->purchase_units[0]->payee->email_address;
   $id_transaccion=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->id;
   $Status_transaccion=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->status;
   $Datos_Pago=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->amount;
   $id_session_compra=$objDatos_transaccion->purchase_units[0]->reference_id;

   if($Status_transaccion=='COMPLETED'){
      $Total_bruto=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;
      $comision_paypal=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value;
      $total_neto=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->net_amount->value;
      
   }elseif ($Status_transaccion=='PENDING') {
      $Total_bruto=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->amount->value;
   }     
      $datos_Cliente=$objDatos_transaccion->payer;
  
   curl_close($Login);
   curl_close($Venta);

      if($existe_orden==1){
         echo'

         <html>
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


         </html>

         <script type="text/javascript"> swal({
                 title: "¡ERROR!",
                 text: "Ha ocurrido un error",
                 icon: "error",
                 type: "error"
             }).then(function() {
                 window.location = "index.php";
             });</script>
         ';
      }else{
         if($Status_transaccion=='COMPLETED'){

            if(isset($_SESSION['ent_personal']) && $_SESSION['ent_personal']==1){
            $SID=session_id();
         
            $mensaje_pago="<h3>Pago aprovado</h3>";
      
             /*SENTENCIA PARA SUBIR VENTA*/
               $sentencia=$pdo->prepare("INSERT INTO VENTA VALUES(ID_VENTA, :ID_USUARIO, :TOTAL_VENTA, :COMISION_PAYPAL, NOW(), 1, :ORDEN_PAYPAL, 'PAYPAL', :MSJ, :FECHA)");
         
               $sentencia->bindParam(':ID_USUARIO', $ID_USUARIO);
               $sentencia->bindParam(':TOTAL_VENTA', $Total_bruto);
               $sentencia->bindParam(':COMISION_PAYPAL', $comision_paypal);
               //$sentencia->bindParam(':ESTADO', $Status_transaccion);
               $sentencia->bindParam(':ORDEN_PAYPAL', $folio);
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
               


               include 'mail_pago_aprobado.php';
               include 'mail_compra.php';


               $folio=null;
      
               echo'
      
               <html>
               <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
      
               </html>
      
               <script type="text/javascript"> swal({
                       title: "¡PAGO ACREDITADO!",
                       text: "Estamos preparando tus productos",
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
               $sentencia=$pdo->prepare("INSERT INTO VENTA VALUES(ID_VENTA, :ID_USUARIO, :TOTAL_VENTA, :COMISION_PAYPAL, NOW(), 1, :ORDEN_PAYPAL, 'PAYPAL', :MSJ, :FECHA)");
         
               $sentencia->bindParam(':ID_USUARIO', $ID_USUARIO);
               $sentencia->bindParam(':TOTAL_VENTA', $Total_bruto);
               $sentencia->bindParam(':COMISION_PAYPAL', $comision_paypal);
               //$sentencia->bindParam(':ESTADO', $Status_transaccion);
               $sentencia->bindParam(':ORDEN_PAYPAL', $folio);
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
               unset($_SESSION['Cont']);
               unset($_SESSION['info_envio']);
               $_SESSION['Confirm']=0;
               include 'mail_pago_aprobado.php';
               include 'mail_compra.php';
               $folio=null;
      
               echo'
      
               <html>
               <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
      
               </html>
      
               <script type="text/javascript"> swal({
                       title: "¡PAGO ACREDITADO!",
                       text: "Estamos preparando tus productos(revisa tu spam)",
                       icon: "success",
                       type: "success"
                   }).then(function() {
                       window.location = "index.php";
                   });</script>
               ';
         }
      
      
      }
      
        
         /*SUBIR COMPRA A BASE DE DATOS SI LA TRANSACCION ESTÁ EN REVISION Y PENDIENTE*/
      
         if($Status_transaccion=='PENDING'){
           if(isset($_SESSION['ent_personal']) &&  $_SESSION['ent_personal']==1){
            $SID=session_id();
         
            $mensaje_pago="<h3>Pago aprovado</h3>";
      
             /*SENTENCIA PARA SUBIR VENTA*/
               $sentencia=$pdo->prepare("INSERT INTO VENTA VALUES(ID_VENTA, :ID_USUARIO, :TOTAL_VENTA, 0, NOW(), 2,  :ORDEN_PAYPAL, , 'PAYPAL', :MSJ, :FECHA)");
         
               $sentencia->bindParam(':ID_USUARIO', $ID_USUARIO);
               $sentencia->bindParam(':TOTAL_VENTA', $Total_bruto);
               $sentencia->bindParam(':ORDEN_PAYPAL', $folio);
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
      
               $sentencia_env=$pdo->prepare("INSERT INTO ENVIO_VENTAS VALUES(ID_ENVIO, :DIRECCION, 5, :VENTA, :RECIBE, :TEL, :HORARIO)");
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
               include 'mail_pago_pendiente.php';
               include 'mail_compra.php';
               $folio=null;
               echo'
      
               <html>
               <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
      
               </html>
      
               <script type="text/javascript"> swal({
                       title: "¡PAGO EN REVISION!",
                       text: "DENTRO DE 48 hrs se acreditará tu pago",
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
               $sentencia=$pdo->prepare("INSERT INTO VENTA VALUES(ID_VENTA, :ID_USUARIO, :TOTAL_VENTA, 0, NOW(), 2, :ORDEN_PAYPAL, 'PAYPAL', :MSJ, :FECHA)");
         
               $sentencia->bindParam(':ID_USUARIO', $ID_USUARIO);
               $sentencia->bindParam(':TOTAL_VENTA', $Total_bruto);
               $sentencia->bindParam(':ORDEN_PAYPAL', $folio);
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
      
               $sentencia_env=$pdo->prepare("INSERT INTO ENVIO_VENTAS VALUES(ID_ENVIO, :DIRECCION, 4, :VENTA, :RECIBE, :TEL, :HORARIO)");
               $sentencia_env->bindParam(':DIRECCION', $_SESSION['info_envio'][0]['DIR']);
               $sentencia_env->bindParam(':VENTA', $id_venta);
               $sentencia_env->bindParam(':RECIBE', $_SESSION['info_envio'][0]['DESTINATARIO']);
               $sentencia_env->bindParam(':TEL', $_SESSION['info_envio'][0]['NUM_CONTACTO']);
               $sentencia_env->bindParam(':HOARIO', $_SESSION['info_envio'][0]['HORARIO']);
               $sentencia_env->execute();
               unset($_SESSION['Carrito']);
               unset($_SESSION['info_envio']);
               unset($_SESSION['Cont']);
               $_SESSION['Confirm']=0;
               include 'mail_pago_pendiente.php';
               include 'mail_compra.php';
               $folio=null;
               echo'
      
               <html>
               <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
      
               </html>
      
               <script type="text/javascript"> swal({
                       title: "¡PAGO EN REVISION!",
                       text: "DENTRO DE 48 hrs se acreditará tu pago",
                       icon: "success",
                       type: "success"
                   }).then(function() {
                       window.location = "index.php";
                   });</script>
               ';
           }
         
         }
      
      

      }
   /*SUBIR COMPRA A BASE DE DATOS SI LA SE COMPLETÓ LA TRANSACCION*/

   


   



      

   ?>
