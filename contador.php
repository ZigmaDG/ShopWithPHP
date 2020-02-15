<?php 

session_start();
$_SESSION['Cont']=0;

foreach($_SESSION['Carrito'] as $item){
    $_SESSION['Cont']= $_SESSION['Cont']+$item['CANTIDAD'];
}


?>