<?php 
session_start();
(int)$cantidad=$_POST['cantidad'];
(int)$id=$_POST['id'];

$_SESSION['Carrito'][$id]['CANTIDAD']=$cantidad;
echo '<br>';


include 'contador.php';


?>