<?php 
session_start();
require_once 'conexion.php';

$opcion=$_POST['opcion'];
$id=$_SESSION['usuario'][0]['ID_USUARIO'];

if($opcion==1){
    $sentencia=$pdo->prepare("SELECT ID_VENTA, NOMBRE_USUARIO,FOLIO, NOMBRE_ESTADO_VENTA, TOTAL_VENTA, CONCAT(DAY(STR_TO_DATE(FECHA_VENTA, '%Y-%m-%d')),'-', MONTH(STR_TO_DATE(FECHA_VENTA, '%Y-%m-%d')),'-', YEAR(STR_TO_DATE(FECHA_VENTA, '%Y-%m-%d'))) AS FECHA_VENTA FROM `VENTA` INNER JOIN USUARIO ON VENTA.ID_USUARIO=USUARIO.ID_USUARIO INNER JOIN ESTADO_VENTA ON VENTA.ESTADO=ESTADO_VENTA.ID_ESTADO_VENTA WHERE USUARIO.ID_USUARIO=:ID ORDER BY ID_VENTA DESC");
$sentencia->bindParam(':ID',$id);

$sentencia->execute();
$num_ventas=$sentencia->rowCount();
$lista=$sentencia->fetchAll(PDO::FETCH_ASSOC);


if($num_ventas>=1){?>
  
  <input class="form-control" id="myInput" type="text" placeholder="Buscar...">

<table class="rwd-table">
<thead>
    <tr>
                          <th>CLIENTE</th>
                          <th>FOLIO</th>
                          <th>ESTADO</th>
                          <th>TOTAL</th>
                          <th>FECHA</th>
                          <th>TIPO DE PAGO</th>
                          <th>ACCIONES</th>
    </tr>
    </thead>
    
    <tbody id="myTable">
    
                              <?php
                              foreach($lista as $venta){
 
  
                                  ?>
                              
                               <tr>
                                        <td data-th="CLIENTE"><form name="formListado-fila-<?php echo $venta['ID_VENTA']?>" action="detalle_compra.php" method="POST" style="display:none;"><input name="ID_VENTA" type="hidden" value="<?php echo $venta['ID_VENTA']?>" />
                                        </form><?php echo $venta['NOMBRE_USUARIO']?></td>
                                     
                                      <td data-th="FOLIO"><?php echo $venta['FOLIO']?></td>
                                      <td data-th="ESTADO"><?php echo $venta['NOMBRE_ESTADO_VENTA']?></td>
                                      <td data-th="TOTAL"><?php echo '$ '.$venta['TOTAL_VENTA'].' MXN'?></td>
                                      <td data-th="FECHA"><?php echo $venta['FECHA_VENTA']?></td>
                                      <td data-th="PAGO"><?php echo $venta['TIPO_PAGO']?></td>
                                      <td data-th="ACCION"><button style="background-color: #F28705; color:white; margin-right: 4px;"  onclick="enviar2(<?php echo $venta['ID_VENTA']?>)">DETALLE</button></td>
                                    </tr>
                              
                           
                                <?php } ?>
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


   echo 'AUN NO HAS COMPRADO';
   } 
  

}






















if($opcion==2){?>
    

    <div class="login">
  <form action="" method="post">
    <h1>Cambiar Contraseña<span></h1>
    <!-- <label for="username">Username:</label> -->
    <input type="password" id="pass" name="pass" placeholder="Nueva contraseña" required>
    <input type="password" id="pass2" name="pass2" placeholder="Confirmar" required>
    <!-- <label for="password">Password:</label> -->
    <button type="submit" onclick="Cambiar_pass()">Cambiar</button>
  </form>
  
</div>

 <?php }

?>