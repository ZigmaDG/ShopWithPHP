<?php 
require_once 'conexion.php';

$dir = $_GET['dir'];

$sentencia = $pdo->prepare("SELECT PRECIO_ENVIO FROM USUARIO_DIRECCION INNER JOIN REGION_ENTREGA ON USUARIO_DIRECCION.REGION_DIRECCION=REGION_ENTREGA.ID_REGION_ENTREGA WHERE USUARIO_DIRECCION.ID_USUARIO_DIRECCION=$dir");
$sentencia->execute();


$lista_direccion=$sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($lista_direccion as $direccion){
    echo $direccion['PRECIO_ENVIO'];
}
?>