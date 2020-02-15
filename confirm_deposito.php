<?php 
require_once 'conexion.php';

$venta = $_POST['id_venta'];

$sentencia = $pdo->prepare("UPDATE VENTA SET ESTADO=1 WHERE ID_VENTA= :ID");
$sentencia->bindParam(':ID', $venta);
$sentencia->execute();


?>