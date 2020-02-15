<?php 
include "conexion.php";
$id_region=$_GET['municipio_n'];



 $sentencia=$pdo->prepare("SELECT * FROM REGION_ENTREGA WHERE ID_MUNICIPIO_REGION=$id_region AND PRECIO_ENVIO !=0");

 $sentencia->execute();
 $lista_regiones=$sentencia->fetchAll(PDO::FETCH_ASSOC);
 $num_element=$sentencia->rowCount();
 if($num_element>0){
  echo ' <option value="">-- SELECCIONE --</option>';
  foreach($lista_regiones as $region){?>
    <option value="<?php echo $region['ID_REGION_ENTREGA']?>"><?php echo $region['NOMBRE_REGION'].' Costo $'.$region['PRECIO_ENVIO']?></option>
     <?php } }else{

       echo '<option value="">NO HAY RESULTADOS</option>';
 }?>


