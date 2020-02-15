<?php
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';
$i=0;

unset($_SESSION['Confirm']);
unset($_SESSION['info_envio']);
unset($_SESSION['ent_personal']);
unset($_SESSION['pago']);

?>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="CSS/Estilo_productos.css" >
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="JS/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<LINK REL=StyleSheet HREF="CSS/Estilos_principal.css" TYPE="text/css">
<script src="JS/enviar.js"></script>

<title>Heart Gift</title>
<html lang="es">
<head>
	
	

	
</head>
<body>
	
</body>
</html>
</head>
<body>
	<?php 
	$sentencia_banner=$pdo->prepare("SELECT * FROM IMG_BANNER ORDER BY ID_BANNER DESC LIMIT 1");
	$sentencia_banner->execute();
	$img_banner=$sentencia_banner->fetchAll(PDO::FETCH_ASSOC);
	?>
  <?php 
  include 'banner.php';
  ?>
    
  


<?php


$sentencia=$pdo->prepare(" SELECT *FROM PRODUCTO INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.CATEGORIA=CATEGORIA_PRODUCTO.ID_CATEGORIA WHERE PRODUCTO.DESCUENTO='SI' AND PRODUCTO.ESTADO_PRODUCTO=1;
");
$sentencia->execute();
$listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
	<h1 id="Titulo_principal">Productos destacados</h1>
	<div id="popup" style="display: none;">
    <div class="content-popup">
        <div class="close"><a href="#" id="close"><i class="fa fa-close" style="font-size:24px;color:white;"></i></a></div>
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
	
<div class="list">

	<?php foreach($listaProductos as $producto){
		$i++?>
		
		<div class="product">
		<img alt="shoes1" src="<?php echo $producto['IMG_PRODUCTO']?>">
		<div><h2><?php echo $producto['NOMBRE_PRODUCTO']?> <a href="Ver_categoria.php?cat=<?php echo $producto['CATEGORIA']?>&pagina=1" style="color: black; font-size: 15px; "><p>ver todos</i></p></a></h2>
		<p class="price"><?php echo '$'.$producto['PRECIO_UNIDAD']?></p>
		
		
		<form action="" method="post" name="form-producto-<?php echo $producto['ID_PRODUCTO']?>'">
		<input type="hidden" name="id" id="<?php echo $producto['ID_PRODUCTO']?>-id" value="<?php echo openssl_encrypt($producto['ID_PRODUCTO'],COD,KEY);?>">
		<input type="hidden" name="nombre" id="<?php echo $producto['ID_PRODUCTO']?>-nombre" value="<?php echo openssl_encrypt($producto['NOMBRE_PRODUCTO'],COD,KEY);?>">
		<input type="hidden" name="precio" id="<?php echo $producto['ID_PRODUCTO']?>-precio" value="<?php echo openssl_encrypt($producto['PRECIO_UNIDAD'],COD,KEY);?> ">
		<input type="hidden" name="cantidad" id="<?php echo $producto['ID_PRODUCTO']?>-cantidad"value="<?php echo openssl_encrypt(1,COD,KEY);?>">
		<input type="hidden" name="producto" id="<?php echo $producto['ID_PRODUCTO']?>-producto"value="<?php echo openssl_encrypt($i,COD,KEY);?> ">
		<a href="#" onclick="enviar(<?php echo $producto['ID_PRODUCTO']?>)"><p>AGREGAR</p></a>
		</form>
		 	 
	</div>
	</div>

		<?php } ?>
			
		
</div>
<?php include 'footer.php'?>
    


</body>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
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