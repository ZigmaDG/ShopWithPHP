<?php 
require_once 'conexion.php';

$venta = $_POST['id_venta'];

$sentencia = $pdo->prepare("UPDATE VENTA SET ESTADO=3 WHERE ID_VENTA= :ID");
$sentencia->bindParam(':ID', $venta);
$sentencia->execute();


$sentencia_env = $pdo->prepare("UPDATE ENVIO_VENTAS SET ESTADO_ENVIO=6 WHERE VENTA= :ID");
$sentencia_env->bindParam(':ID', $venta);
$sentencia_env->execute();


?>