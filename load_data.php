<?php
session_start();
require_once 'conexion.php';
$anio = $_POST['anio'];
$mes = $_POST['mes'];


$sentencia=$pdo->prepare("SELECT ID_VENTA, NOMBRE_USUARIO, FOLIO, NOMBRE_ESTADO_VENTA, TIPO_PAGO, TOTAL_VENTA, CONCAT(DAY(STR_TO_DATE(FECHA_VENTA, '%Y-%m-%d')),'-', MONTH(STR_TO_DATE(FECHA_VENTA, '%Y-%m-%d')),'-', YEAR(STR_TO_DATE(FECHA_VENTA, '%Y-%m-%d'))) AS FECHA_VENTA FROM `VENTA` INNER JOIN USUARIO ON VENTA.ID_USUARIO=USUARIO.ID_USUARIO INNER JOIN ESTADO_VENTA ON VENTA.ESTADO=ESTADO_VENTA.ID_ESTADO_VENTA WHERE YEAR(STR_TO_DATE(FECHA_VENTA, '%Y-%m-%d'))=:ANIO AND MONTH(STR_TO_DATE(FECHA_VENTA, '%Y-%m-%d'))=:MES ORDER BY ID_VENTA DESC");
$sentencia->bindParam(':ANIO',$anio);
$sentencia->bindParam(':MES',$mes);
$sentencia->execute();
$num_ventas=$sentencia->rowCount();
$lista=$sentencia->fetchAll(PDO::FETCH_ASSOC);


if($num_ventas>=1){?>
            <input class="form-control" id="myInput" type="text" placeholder="Buscar...">

                        <br>
                        <table class="table table-bordered table-striped" id="indextable">
                            <thead>
                            <tr>
                            <th><a href="#">CLIENTE</a></th>
                            <th><a href="#">FOLIO</a></th>
                            <th><a href="#">ESTADO</a></th>
                            <th><a href="#">TOTAL</a></th>
                            <th><a href="#">FECHA</a></th>
                            <th>TIPO DE PAGO</th>
                            <th>ACCIONES</th>
                            </tr>
                            </thead>
                            
                                <tbody id="myTable"> 

                                <?php
                                foreach($lista as $venta){
   
    
                                    ?>
                                
                                 <tr>
                                          <td><form name="formListado-fila-<?php echo $venta['ID_VENTA']?>" action="detalle_venta.php" method="POST" style="display:none;"><input name="ID_VENTA" type="hidden" value="<?php echo $venta['ID_VENTA']?>" />
                                          </form><?php echo $venta['NOMBRE_USUARIO']?></td>
                                       
                                        <td><?php echo $venta['FOLIO']?></td>
                                        <td><?php echo $venta['NOMBRE_ESTADO_VENTA']?></td>
                                        <td><?php echo $venta['TOTAL_VENTA']?></td>
                                        <td><?php echo $venta['FECHA_VENTA']?></td>
                                        <td><?php echo $venta['TIPO_PAGO']?></td>
                                        <td><button style="background-color: #F28705; color:white; margin-right: 4px;"  onclick="enviar2(<?php echo $venta['ID_VENTA']?>)">DETALLE</button></td>
                                      </tr>
                                
                             
                                  <?php }
                                
                                ?>
                                </tbody>
                        </table>
                        <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
  function enviar2(id) {
    elForm= document.getElementsByName('formListado-fila-'+id)[0];
    elForm.submit();
  }
</script>
<script>
  function enviar3(id) {
    elForm= document.getElementsByName('formListado2-fila-'+id)[0];
    elForm.submit();
  }
</script>
<?php } else{


   echo 'NO HAY VENTAS EN ESTE PERIODO';
   } ?>