<?php
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';

$i=0;
$TOTAL=0;

?>


<html>
    <head>
    <LINK REL=StyleSheet HREF="CSS/Estilo_carrito.css" TYPE="text/css">
    <LINK REL=StyleSheet HREF="CSS/jquery.nice-number.css" TYPE="text/css">
    <script src="JS/jquery.min.js"></script>
    <script src="JS/actualizar_cantidad.js"></script>
    <script src="JS/borrar_elemento.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    <script type="text/javascript" src="JS/jquery.nice-number.js"></script>
    <script>
    $(function(){

            $('input[type="number"]').niceNumber();

            });
    </script>

    </head>
    <body>
        <?php if(!isset($_SESSION['Carrito'][0])){

                echo '<div class="Container_cart"> <h3>El carrito está vacío </h3>';
              include 'footer.php';
              echo '</div>';

                }else{?>
                    
                   

                   <div class="container">
                   <div class="logoHeart">
                       <img src="IMG-RESOURCES/logoCarrito.png" alt="">
                   </div>
                   <div class="Carrito">
                        <h2>CARRITO DE COMPRAS</h2>
                            <table >
                                <th>Producto</th>
                                <th>Precio x unidad</th>
                                <th>Cantidad</th>
                               <?php foreach($_SESSION['Carrito'] as $itemCarrito){
                                   ?>
                            <tr id=" <?php echo $i?>">
                            
                               <td><?php echo $itemCarrito['NOMBRE']?></td> 
                               <td><?php echo '$ '.$itemCarrito['PRECIO'].' MXN'?></td>
                               <td><?php echo '<form id="'.$i.'" action="post"><div class="box">
                                <input class="cantidad" type="number" name="'.$i.'" id="'.$i.'-cantidad" min ="1" value="'.(int)$itemCarrito['CANTIDAD'].'">
                                </div>
                                <input type="hidden" id="'.$i.'" name="id" value="'.$i.'"></form>'?></td>
                               <td><form action="post">
                               <input type="hidden" id="<?php echo $i?>-id" name="id" value="<?php echo $i?>">
                               <button style="font-size:24px" id="<?php echo $i?>" class="borrar"> <i class="fa fa-close"></i></button>
                                    
                               </form></td>
                            </tr>
                                
	                            
                    
               <?php $i++; } 
               foreach($_SESSION['Carrito'] as  $indice=>$producto)  {
                (double) $TEMP=(double)$_SESSION['Carrito'][$indice]['PRECIO']*(int)$_SESSION['Carrito'][$indice]['CANTIDAD'];
                  $TOTAL= $TOTAL + (double)$TEMP;
                  $_SESSION['total']=$TOTAL;
         }?>
               <td id="total"><?php echo 'TOTAL: $'.$TOTAL ?></td>
               <td></td>
               <td><form method="POST" action="<?php if(isset($_SESSION['log-on'])){ echo 'pagar.php'; }else{ echo 'login.php'; }?>">
                        <input type="hidden" id="total" name="total" value="<?php echo openssl_encrypt($TOTAL,COD,KEY);?>">
                        <input type="submit" value="PAGAR">
                        </form></td>

                </table>
                
                             </div>
                        
                   </div>
                   <?php include 'footer.php'?>
                       
                             
            <?php }?> 
           
       
    </body>
</html>





