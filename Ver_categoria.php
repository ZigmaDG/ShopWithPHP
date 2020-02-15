<?php 
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';
$categoria=$_GET['cat'];
$sentencia=$pdo->prepare(" SELECT *FROM PRODUCTO INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.CATEGORIA=CATEGORIA_PRODUCTO.ID_CATEGORIA WHERE PRODUCTO.CATEGORIA=$categoria and PRODUCTO.ESTADO_PRODUCTO=1;");
$sentencia->execute();
$num_paginas= $sentencia->rowCount();

$articulos_x_pagina=5;
$paginas=$num_paginas/5;
$paginas=ceil($paginas);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="JS/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <LINK REL=StyleSheet HREF="CSS/categoria.css" TYPE="text/css">
    <link rel="stylesheet" href="CSS/paginacion.css" >

    <script src="JS/enviar.js"></script>
  
</head>
<body>
<?php 
  include 'banner.php';
  ?>
    <section class="contenedor_productos">

    
    <?php 
    
       
    
       



        if(!$_GET){
          header('Location:Ver_categoria.php?pagina=1');  
    }

    $inicial = ($_GET['pagina']-1)*$articulos_x_pagina;

        $sentencia_2=$pdo->prepare(" SELECT *FROM PRODUCTO INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.CATEGORIA=CATEGORIA_PRODUCTO.ID_CATEGORIA WHERE PRODUCTO.CATEGORIA=$categoria AND PRODUCTO.ESTADO_PRODUCTO=1 LIMIT :iniciar, :narticulos;");
        $sentencia_2->bindParam(':iniciar', $inicial,PDO::PARAM_INT);
        $sentencia_2->bindParam(':narticulos', $articulos_x_pagina,PDO::PARAM_INT);
        $sentencia_2->execute();

        $listaProductos=$sentencia_2->fetchAll(PDO::FETCH_ASSOC);
     
        echo '<h1 id="Titulo_principal">'.$listaProductos[0]['NOMBRE_CATEGORIA'].'</h1>'



        
        ?> 
          <title><?php echo $listaProductos[0]['NOMBRE_CATEGORIA']?></title>
    <div class="lista">
            <?php 
                foreach($listaProductos as $producto){?>
                <div class="producto_cat">
                    <div class="img_container">
                   <a href="Ver_producto.php?item=<?php echo $producto['ID_PRODUCTO']?>"><img src="<?php echo $producto['IMG_PRODUCTO']?>" alt=""></a>
                    </div>
                       
                        <div class="desc_container">

                        <p>  <a href="Ver_producto.php?item=<?php echo $producto['ID_PRODUCTO']?>"><?php echo $producto['NOMBRE_PRODUCTO']?></a> </p>
                        <p class="categoria"><?php echo $producto['NOMBRE_CATEGORIA']?></p>
                        <p class="precio"><?php echo '$ '.$producto['PRECIO_UNIDAD']?></p>
                        </div>
                      

                </div>
            <?php }?>
    
    
    
    
    
    
    </div>
    <div class="paginacion">
    
  <ul class="f3-widget-paginator">
    
    <li class="previous">				
      <a rel="prev"  class="<?php echo $_GET['pagina']<=1? 'isDisabled':' ' ?>" href="Ver_categoria.php?cat=<?php echo $categoria?>&pagina=<?php echo $_GET['pagina']-1 ?>">previous</a>
    </li>

    <?php for($i=0;$i<$paginas;$i++):?>



    <li class="<?php echo $_GET['pagina']==$i+1 ? 'current' :'' ?>">
      <a  href="Ver_categoria.php?cat=<?php echo $categoria?>&pagina=<?php echo $i+1?>"><?php echo $i+1?></a>
    </li>
   <?php endfor?>
  

    <li class="next" >
      <a rel="next" class="<?php echo $_GET['pagina']>=$paginas? 'isDisabled':' ' ?>"  href="Ver_categoria.php?cat=<?php echo $categoria?>&pagina=<?php echo $_GET['pagina']+1 ?>">next</a>
    </li>
  </ul>

    </div>
    </section>
    <?php include 'footer.php'?>
</body>
</html>