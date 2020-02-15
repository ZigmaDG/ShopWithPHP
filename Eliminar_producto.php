<?php 
session_start();
$TOTAL=0;
$id_producto=$_POST['id'];
$carrito=$_SESSION['Carrito'];
    unset($carrito[$id_producto]);
    $carrito = array_values(array_filter($carrito));    
    $_SESSION['Carrito']=$carrito;
    $leng=count($carrito);
    foreach($_SESSION['Carrito'] as  $indice=>$producto)  {
        (double) $TEMP=(double)$_SESSION['Carrito'][$indice]['PRECIO']*(int)$_SESSION['Carrito'][$indice]['CANTIDAD'];
          $TOTAL= $TOTAL + (double)$TEMP;
         
 }
    echo 'TOTAL $'.$TOTAL;
    include 'contador.php';
?>