<?php 
session_start();
include 'header.php';
include 'header2.php';
if($_SESSION['rol']!=1)
{
    echo 'NO ESTAS AUTORIZADO';
    die();
}

require_once 'conexion.php';
$id_venta=$_POST['ID_VENTA'];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/detalle_venta.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="JS/enviar.js"></script>
    <title>DETALLE VENTA</title>
</head>
<body>
    <div class="content_detalle">
    <table class="table table-bordered table-striped" id="indextable">
    <tbody id="myTable">
    <?php
        
        $sentencia=$pdo->prepare("SELECT * FROM `VENTA` INNER JOIN USUARIO 
        ON VENTA.ID_USUARIO=USUARIO.ID_USUARIO INNER JOIN ESTADO_VENTA 
        ON VENTA.ESTADO=ESTADO_VENTA.ID_ESTADO_VENTA  WHERE ID_VENTA=:ID");
        $sentencia->bindParam(':ID',$id_venta);
        $sentencia->execute();
        $detalle=$sentencia->fetchAll(PDO::FETCH_ASSOC);

        foreach($detalle as $venta){?>

           <tr>
                <td><form name="formListado-fila-<?php echo $venta['FOLIO']?>" 
                action="Edit_producto.php" method="POST" style="display:none;">
                <input name="ID_ORDEN" type="hidden" value="<?php echo $venta['FOLIO']?>" />
          </form></td>
                <td></td>
                <td Colspan="3"><b>Fecha y hora: </b><?php echo $venta['FECHA_VENTA']?></td>
                
            </tr>
            <tr>
            <td Colspan="4"><b>Cliente: </b><?php echo $venta['NOMBRE_USUARIO']?></td>
            
             </tr>

             <tr>

             <td><b>Estado: </b> <?php echo $venta['NOMBRE_ESTADO_VENTA']?></td>
            <td>
            <form action="" method="post">
            <input type="hidden" id="id_orden" name="id_orden" value="<?php echo $venta['FOLIO']?>">
            <input type="hidden" id="id_venta" name="id_venta" value="<?php echo $id_venta?>">

            </form>
            <?php if($venta['TIPO_PAGO']=='PAYPAL'){
                echo ' <button  onclick="estadopaypal()" class="btn_actualizar">ACTUALIZAR</button></td>';
            }else{
                echo ' <button  onclick="estadodeposito()" class="btn_actualizar">APROBAR</button></td>';
            }
            
            
            ?>
            <td><button  onclick="cancelar_compra()" class="btn_actualizar">CANCELAR</button></td>
             </tr>
        <tr>
                
                <td Colspan="2"><b>Productos</b></td>
                <td><b>Cantidad</b></td>
                <td><b>Precio x unidad</b></td>

        </tr>

                <?php 
                    $sentencia_2=$pdo->prepare("SELECT * FROM DETALLE_VENTAS INNER JOIN PRODUCTO ON DETALLE_VENTAS.ID_PRODUCTO=PRODUCTO.ID_PRODUCTO INNER JOIN VENTA ON VENTA.ID_VENTA=DETALLE_VENTAS.ID_FACTURA INNER JOIN ENVIO_VENTAS ON ENVIO_VENTAS.VENTA=VENTA.ID_VENTA INNER JOIN USUARIO_DIRECCION ON USUARIO_DIRECCION.ID_USUARIO_DIRECCION=ENVIO_VENTAS.LUGAR_ENVIO INNER JOIN REGION_ENTREGA ON REGION_ENTREGA.ID_REGION_ENTREGA=USUARIO_DIRECCION.REGION_DIRECCION INNER JOIN ESTADO_ENVIO ON ESTADO_ENVIO.ID_ESTADO_ENVIO=ENVIO_VENTAS.ESTADO_ENVIO WHERE DETALLE_VENTAS.ID_FACTURA=:ID");
                    $sentencia_2->bindParam(':ID',$id_venta);
                    $sentencia_2->execute();
                    $num_productos=$sentencia_2->rowCount();
                    $lista_productos=$sentencia_2->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach($lista_productos as $producto){?>
                        <tr>
                            <td Colspan="2"> <?php echo $producto['NOMBRE_PRODUCTO']?></td>
                            <td><?php echo $producto['CANTIDAD_PRODUCTO'].' pza'?></td>
                            <td><?php echo '$ '.$producto['PRECIO'].' MXN'?></td>
                        </tr>


                   <?php }
                ?>

                <tr>


                </tr>
                
                <tr>
                        <td Colspan="2"> </td>
                        <td><b>Costo envío </b></td>
                        <td>$ <?php echo $producto['PRECIO_ENVIO']?> MXN</td>


                <tr>
                        <td Colspan="2"> </td>
                        <td><b>Subtotal </b></td>
                        <td>$ <?php echo $venta['TOTAL_VENTA']?> MXN</td>


                </tr>
                
                </tr>
                <tr>
                        <td Colspan="2"> </td>
                        <td><b>Comisión</b></td>
                        <td>-$ <?php echo $venta['COMISION_PAYPAL']?> MXN</td>
                        

                </tr>
                <tr>
                        <td Colspan="2"> </td>
                        <td><b>TOTAL</b></td>
                        <td>$ <?php echo $total =   $venta['TOTAL_VENTA']- $venta['COMISION_PAYPAL'] ?> MXN</td>
                    </tr>
           <tr >
           <td Colspan=4></td>
           
           </tr>

           <tr >
           <td Colspan=4></td>
           
           </tr>
           <tr>
           <td><b>ENVIO: </b></td>
           <td>
            <form action="ver_envio.php">
            <input type="hidden" value="<?php echo $id_venta?>" id="id_venta" name="id_venta">
            <button class="btn_actualizar"><?php echo $producto['NOMBRE_ESTADO_ENVIO'].' >>'?></button></td>

            </form>
           </tr>
       <?php }
    
    ?>

        </tbody>
        </table>  
    </div>
   
</body>
</html>