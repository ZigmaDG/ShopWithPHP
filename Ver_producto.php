<?php
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';
$item=$_GET['item'];
?>


<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/Estilo_productos.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="JS/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <LINK REL=StyleSheet HREF="CSS/Estilos_principal.css" TYPE="text/css">
    <LINK REL=StyleSheet HREF="CSS/ver_producto.css" TYPE="text/css">

    <script src="JS/enviar.js"></script>

    <title>Ver Producto</title>
    <body>
    <?php $sentencia=$pdo->prepare(" SELECT *FROM PRODUCTO INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.CATEGORIA=CATEGORIA_PRODUCTO.ID_CATEGORIA WHERE PRODUCTO.ID_PRODUCTO=$item;");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        
        ?> 

        <div class="Cont_producto">
        <div id="popup" style="display: none;">
    <div class="content-popup">
        <div class="close"><a href="#" id="close"><i class="fa fa-close" style="font-size:24px;color:black;"></i></a></div>
        <div>
        	<h2>Producto Añadido</h2>
			<p id="respa"></p>
			<div class="btns">
			<a href="index">Seguir comprando</a>
			<a href="Carrito">Ver carrito</a>
			
			</div>
            
            <div style="float:left; width:100%;">
    	</div>
        </div>
    </div>
</div>
<div class="popup-overlay"></div>

            <div class="Cont_img">
                     <img src="<?php print_r($listaProductos[0]['IMG_PRODUCTO'])?>" alt="">
            </div>
            <div class="Cont_info">
                <div class="info">
                <p id="Nombre_producto"> <b><?php print_r($listaProductos[0]['NOMBRE_PRODUCTO'])?></b></p>
                <p id="Nombre_categoria"> <?php print_r($listaProductos[0]['NOMBRE_CATEGORIA'])?></p>
                <p id="Nombre_desc"> <?php print_r($listaProductos[0]['DESCRIPCION_PRODUCTO'])?></p>
                <p id="precio"><b> $ <?php print_r($listaProductos[0]['PRECIO_UNIDAD'])?></b></p>
               
                <form action="" method="post" name="form-producto-<?php echo $producto['ID_PRODUCTO']?>'">
		<input type="hidden" name="id" id="<?php print_r($listaProductos[0]['ID_PRODUCTO'])?>-id" value="<?php echo openssl_encrypt($listaProductos[0]['ID_PRODUCTO'],COD,KEY);?>">
		<input type="hidden" name="nombre" id="<?php print_r($listaProductos[0]['ID_PRODUCTO'])?>-nombre" value="<?php echo openssl_encrypt($listaProductos[0]['NOMBRE_PRODUCTO'],COD,KEY)?>">
		<input type="hidden" name="precio" id="<?php print_r($listaProductos[0]['ID_PRODUCTO'])?>-precio" value="<?php echo openssl_encrypt($listaProductos[0]['PRECIO_UNIDAD'],COD,KEY)?> ">
		<input type="hidden" name="cantidad" id="<?php print_r($listaProductos[0]['ID_PRODUCTO'])?>-cantidad"value="<?php echo openssl_encrypt(1,COD,KEY)?> ">
		<input type="hidden" name="producto" id="<?php print_r($listaProductos[0]['ID_PRODUCTO'])?>-producto"value="<?php echo openssl_encrypt($listaProductos[0]['ID_PRODUCTO'],COD,KEY)?> ">
		<a href="#"id="Add_cart" onclick="enviar(<?php print_r($listaProductos[0]['ID_PRODUCTO'])?>)">AGREGAR</a>
		</form>

                </div>
                


            </div>
            <?php include 'footer.php'?>
        </div>
        
        
    </body>
    <script>
$(document).ready(function(){
  
 
    $('#close').on('click', function(){
        $('#popup').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        location.reload(true);
        return false;
    });
});
</script>
</html>