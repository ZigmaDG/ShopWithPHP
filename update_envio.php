<?php 
require_once 'conexion.php';
$estado = $_POST['est_envio'];
$id = $_POST['id_envio'];

$sentencia = $pdo->prepare("UPDATE ENVIO_VENTAS SET ESTADO_ENVIO=$estado WHERE ID_ENVIO=$id");
$sentencia->execute();


?>