<?php 
session_start();
require_once 'conexion.php';
$orderID = $_POST['id_orden'];
$id_venta = $_POST['id_venta'];
$clientID="AT5mR6Dctn0kh6i8mAFN8BX5RxCahfNIPe7sVjMl019n_aLi1Hxz0XFqFLIDPs-a5gBYuAMzPLj5wdZ-";
$secret="ED81PPsPTKdKH7EqhNQa52aWXJCWdWayEsz0EuJ6hQBoQ41ct0kj4er_rlXan7OcMNY3sn2_DVvOcKp0";
$Login= curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($Login,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($Login,CURLOPT_USERPWD,$clientID.":".$secret);
curl_setopt($Login,CURLOPT_POSTFIELDS,"grant_type=client_credentials");
$RESPUESTA=curl_exec($Login);


$objRespuesta=json_decode($RESPUESTA);
$accessToken=$objRespuesta->access_token;



$Venta= curl_init("https://api.sandbox.paypal.com/v2/checkout/orders/".$orderID);
curl_setopt($Venta,CURLOPT_HTTPHEADER,array("Content-Type: application/json","Authorization: Bearer ".$accessToken));
curl_setopt($Venta, CURLOPT_RETURNTRANSFER, true);



$Respuesta_venta=curl_exec($Venta);
$objDatos_transaccion = json_decode($Respuesta_venta);
$Status_transaccion=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->status;

if($Status_transaccion=='COMPLETED'){
    $Total_bruto=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;
    $comision_paypal=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value;
    $total_neto=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->net_amount->value;
    $id_transaccion=$objDatos_transaccion->purchase_units[0]->payments->captures[0]->id;

   
    



    
    $sentencia=$pdo->prepare("UPDATE VENTA SET ESTADO=1, COMISION_PAYPAL=:COMISION, CODIGO_VENTA_PAYPAL=:CODIGO WHERE ID_ORDEN_PAYPAL=:ID_ORDEN");
    $sentencia->bindParam(':COMISION',$comision_paypal);
    $sentencia->bindParam(':CODIGO',$id_transaccion);
    $sentencia->bindParam(':ID_ORDEN',$orderID);
    $sentencia->execute();


    $sentencia_2=$pdo->prepare("UPDATE ENVIO_VENTAS SET ESTADO_ENVIO='Pendiente' WHERE VENTA=$id_venta");
   // $sentencia_2->bindParam(':ESTADO','Pendiente');
   // $sentencia_2->bindParam(':ID',$id_venta);
    $sentencia_2->execute();
 }

?>