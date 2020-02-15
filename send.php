<?php 
session_start();

require_once 'conexion.php';
$id=openssl_decrypt($_POST['id'],COD,KEY);
if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
    $nombre=openssl_decrypt($_POST['nombre'],COD,KEY);
}

$cantidad=openssl_decrypt($_POST['cantidad'],COD,KEY);
$precio=openssl_decrypt($_POST['precio'],COD,KEY);
$i=openssl_decrypt($_POST['producto'],COD,KEY);

if(!isset($_SESSION['Carrito'])){
    $producto = array(
            'ID' =>$id,
            'NOMBRE'=>$nombre,
            'CANTIDAD'=> $cantidad,
            'PRECIO' =>$precio
        
    );
    $_SESSION['Carrito'][0]=$producto;

    echo '<b>'.$nombre.'</b> añadido' ;
    
}
else
{
    
    if(in_array($id,array_column($_SESSION['Carrito'],'ID')))
    {
        $carrito=$_SESSION['Carrito'];
        $key=array_search($id,array_column($_SESSION['Carrito'],'ID'));
        $tempCantidad=(int)$carrito[$key]['CANTIDAD']+1;
        $carrito[$key]['CANTIDAD']=$tempCantidad;
        $_SESSION['Carrito']=$carrito;
        
        echo '<b style="color:#F20574;">'.$nombre.'</b> añadido' ;
   
    }else{  
        
        $NumeroProductos=count($_SESSION['Carrito']);
        $producto = array(
            'ID' =>$id,
            'NOMBRE'=>$nombre,
            'CANTIDAD'=> $cantidad,
            'PRECIO' =>$precio
            
            
        );
        $_SESSION['Carrito'][$NumeroProductos]=$producto;
        
        echo '<b style="color:#F20574;">'.$nombre.'</b> añadido';
   
       

}
    
}

include 'contador.php';





?>