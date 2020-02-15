<?php
include "conexion.php";
/*
$db=connect();
$query=$db->query("select * from city where state_id=$_GET[state_id]");
$states = array();





while($r=$query->fetch_object()){ $states[]=$r; }
if(count($states)>0){
print "<option value=''>-- SELECCIONE --</option>";
foreach ($states as $s) {
	print "<option value='$s->id'>$s->name</option>";
}
}else{
print "<option value=''>-- NO HAY DATOS --</option>";
}
*/

$id_Estado=$_GET['Estado_n'];




 $sentencia=$pdo->prepare(" SELECT * FROM MUNICIPIO_ESTADO INNER JOIN ESTADO_REPUBLICA ON MUNICIPIO_ESTADO.ESTADO=ESTADO_REPUBLICA.ID_ESTADO_REPUBLICA WHERE MUNICIPIO_ESTADO.ESTADO=$id_Estado");

 $sentencia->execute();

 $lista_Municipios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
 $num_element=$sentencia->rowCount();
 if($num_element>0){
     echo ' <option value="">-- SELECCIONE --</option>';
     foreach($lista_Municipios as $municipios){?>
        <option value="<?php echo $municipios['ID_MUNICIPIO']?>"><?php echo $municipios['NOMBRE_MUNICIPIO']?></option>
         <?php } 
        
        
        }else{


            echo '<option value="">NO HAY RESULTADOS</option>';
        }
        
        ?>
 

