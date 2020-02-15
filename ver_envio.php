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
$id_venta = $_GET['id_venta'];
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
    <title>DETALLE ENVIO</title>
</head>
<body>

<div class="content_detalle">
<h2>Información del envío</h2>
    <table class="table table-bordered table-striped" id="indextable">
    <tbody id="myTable">
    <?php
        
        $sentencia=$pdo->prepare("SELECT * FROM   ENVIO_VENTAS  INNER JOIN USUARIO_DIRECCION ON USUARIO_DIRECCION.ID_USUARIO_DIRECCION=ENVIO_VENTAS.LUGAR_ENVIO INNER JOIN ESTADO_REPUBLICA ON ESTADO_REPUBLICA.ID_ESTADO_REPUBLICA=USUARIO_DIRECCION.ESTADO INNER JOIN MUNICIPIO_ESTADO ON MUNICIPIO_ESTADO.ID_MUNICIPIO=USUARIO_DIRECCION.MUNICIPIO  INNER JOIN REGION_ENTREGA ON REGION_ENTREGA.ID_REGION_ENTREGA=USUARIO_DIRECCION.REGION_DIRECCION INNER JOIN ESTADO_ENVIO ON ESTADO_ENVIO.ID_ESTADO_ENVIO=ENVIO_VENTAS.ESTADO_ENVIO WHERE VENTA=:ID");
        $sentencia->bindParam(':ID',$id_venta);
        $sentencia->execute();
        $detalle=$sentencia->fetchAll(PDO::FETCH_ASSOC);

        foreach($detalle as $venta){
                $ESTADO =$venta['ESTADO_ENVIO'];
                $sentencia_2=$pdo->prepare("SELECT * FROM ESTADO_ENVIO WHERE ID_ESTADO_ENVIO!=$ESTADO");
                $sentencia_2->execute();
                $estado_envio=$sentencia_2->fetchAll(PDO::FETCH_ASSOC);

                
                
                ?>
            <tr>
            <td Colspan="4"><b>Recibe: </b><?php echo $venta['RECIBE']?></td>
            
             </tr>


        <tr>
                
                <td><b>Tel. Contacto:</b></td>
                <td><b><?php echo $venta['TEL_CONTACTO']?></b></td>
                <td></td>
                <td></td>

        </tr>

                
                <tr>
                    <td><b>ESTADO</b></td>
                    <td ><b>MUNICIPIO</b></td>
                    <td><b>REGION</b></td>
                    <td></td>

                </tr>
                
                <tr>
                        <td ><?php echo $venta['NOMBRE_ESTADO_REPUBLICA']?></td>
                        <td ><?php echo $venta['NOMBRE_MUNICIPIO']?></td>
                        <td><?php echo $venta['NOMBRE_REGION']?></td>
                        <td></td>


                <tr>
                        <td Colspan="4"><b>DIRECCIÓN</b></td>


                </tr>
                
                </tr>
                <tr>
                        <td Colspan="4"> <?php echo $venta['DIRECCION'].' '.$venta['NUMERO'].' '.$venta['CP'].' '.$venta['NOTA_DIRECCION']?></td>

                        

                </tr>
                <tr>
                     <td><b>ESTADO Y METODO DE ENTREGA:</b></td>
              
                <td>
                <form action="" method="post">
                    <input type="hidden" id="id_envio" name="id_envio" value="<?php echo $venta['ID_ENVIO']?>">
                    <select name="est_envio" id="est_envio">
                             <option value="<?php echo $venta['ID_ESTADO_ENVIO']?>"><?php echo $venta['NOMBRE_ESTADO_ENVIO']?></option>
                     <?php 
                     foreach($estado_envio as $envio){?>
                            <option value="<?php echo $envio['ID_ESTADO_ENVIO']?>"><?php echo $envio['NOMBRE_ESTADO_ENVIO']?></option>
                     <?php }
                     
                     ?>
                     </select>
                     <button class="btn_actualizar" onclick="updateEnvio()">Actualizar</button></td>
                </form>
                     </td>
                    </tr>
           <tr >
           <td Colspan=4></td>
           
           </tr>

           <tr >
           <td Colspan=4></td>
           
           </tr>
           <tr>
           
           </tr>
       <?php }
    
    ?>

        </tbody>
        </table>  
    </div>
</body>
</html>