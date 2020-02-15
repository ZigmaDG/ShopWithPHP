<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://tiendaonlineprueba2.000webhostapp.com/JS/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<LINK REL=StyleSheet HREF="CSS/Estilo_header2.css" TYPE="text/css">
<LINK REL=StyleSheet HREF="CSS/footer.css" TYPE="text/css">
<?php
require_once 'conexion.php';
?>
</head>


<nav>


        <div id="section_account">
        <?php  if(isset($_SESSION['log-on']))
        {
        ?>
            <a id="btn_registrarse" href="Mi_cuenta.php"> Mi cuenta</a>
            <a id="btn_registrarse" href="logout.php"> Salir</a>
          <?php } else{ ?>
                <a id="btn_registrarse" href="login.php">Iniciar sesión</a>
                <a id="btn_registrarse" href="Registro.php"> Crear cuenta</a>
          <?php  }?>

          
          <?php if(isset($_SESSION['Cont']) && $_SESSION['Cont']>=1){  echo ' <span class="fa-stack has-badge" data-count='.$_SESSION['Cont'];}
                    else{ echo ' <span class="fa-stack2 has-badge" data-count="99"'; }?>
																						
                     <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                    <a href="Carrito" id="cont"><i style="" class="fa fa-shopping-cart fa-stack-2x red-cart"></i></a>
                    </span>
        </div>

  
        <label for="drop" class="toggle">Menu</label>
        <input type="checkbox" id="drop" />
            <ul class="menu">
                <li><a href="http://regalodelcorazon.com/index.php">Inicio</a></li>
                <li>
                    <!-- First Tier Drop Down -->
                    <label for="drop-1" class="toggle">Categorías +</label>
                    <a href="#">Categorías</a>
                    <input type="checkbox" id="drop-1"/>
                    <ul>
                    <?php 
                    $sentencia=$pdo->prepare(" SELECT *FROM CATEGORIA_PRODUCTO WHERE ESTADO_CAT=1");
                    $sentencia->execute();
                    $listaCategorias=$sentencia->fetchAll(PDO::FETCH_ASSOC);
                    foreach($listaCategorias as $categorias){
                            echo '<li><a href="http://regalodelcorazon.com/Ver_categoria.php?cat='.$categorias['ID_CATEGORIA'].'&pagina=1">'.$categorias['NOMBRE_CATEGORIA'].'</a></li>';
                    }
                    
                    
                    
                    ?>
                    
                        
                        
                    </ul> 

                </li>
               
               
               
                <?php 
                if(isset($_SESSION['rol']))
                {
                    if($_SESSION['rol']==1){
                        ?>
                    <li>
                    <label for="drop-4" class="toggle">ADMINISTRACIÓN</label>
                    <a href="#">ADMINISTRACIÓN</a>
                    <input type="checkbox" id="drop-4"/>
                    <ul>
                         
                        <li>
                        <label for="drop-5" class="toggle">AÑADIR</label>
                            <a href="#">AÑADIR</a>         
                            <input type="checkbox" id="drop-5"/>
                            <ul>    
                                     <li><a href="http://regalodelcorazon.com/nueva_dir.php">DIRECCIÓN RETIRO</a></li>
                                     <li><a href="http://regalodelcorazon.com/nuevo_banner.php">NUEVO BANNER</a></li>
                                     <li><a href="http://regalodelcorazon.com/Select_banner.php">EDITAR BANNER</a></li>
                                     <li><a href="http://regalodelcorazon.com/nuevo_producto.php">NUEVO PRODUCTO</a></li>
                                     <li><a href="http://regalodelcorazon.com/nueva_categoria.php">NUEVA CATEGORIA</a></li>
                                     <li><a href="http://regalodelcorazon.com/nueva_categoria.php">NUEVA ZONA</a>
                                     <ul>
                                     <li> <a href="http://regalodelcorazon.com/nuevo_estado.php">ESTADO</a></li>
                                     <li><a href="http://regalodelcorazon.com/nuevo_municipio.php">MUNICIPIO</a></li>
                                     <li><a href="http://regalodelcorazon.com/nueva_region.php">REGION</a></li>
                                     </ul>
                                     </li>
                            </ul>
                        </li>
                        <li>
                            <label for="drop-6" class="toggle">VENTAS</label>
                            <a href="#">VENTAS</a>         
                            <input type="checkbox" id="drop-6"/>
                            <ul>
                                     <li><a href="http://regalodelcorazon.com/ver_ventas.php">VER VENTAS</a></li>
                                     
                            </ul>
                            </li>
                        
                        </li>
                        <li>
                        <label for="drop-7" class="toggle">EDITAR</label>
                            <a href="#">EDITAR</a>         
                            <input type="checkbox" id="drop-7"/>
                            <ul>
                                     <li><a href="http://regalodelcorazon.com/editar.php?edit=1">PRODUCTOS</a></li>
                                     <li><a href="http://regalodelcorazon.com/editar.php?edit=2">CATEGORIAS</a></li>
                                     <li><a href="http://regalodelcorazon.com/editar.php?edit=3">DIRECCION RETIRO</a></li>
                                     
                            </ul>
                        </li>
                    </ul>
                    
                    </li>
                    <?php }?>
                <?php } ?>
              
               
                
            </ul>
        </nav>


        
</html>