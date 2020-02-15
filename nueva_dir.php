<?php 
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';




?>

<style>

.warn {
    
    color: red;
    font-size:13px;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <LINK REL=StyleSheet HREF="CSS/pop_up.css" TYPE="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/Estilo_registro.css">


  
  <title>NUEVA DIRECCION</title>
</head>
<body>

<div class="form_registro">
<form action="add_dir.php" method="post">

<div class="pop-up">
                    <label for="">Dirección</label>
                    <input type="text" name="direccion_n" id="direccion_n" class="form-control" placeholder="Dirección" aria-describedby="helpId">
                    
                  </div>

                  <div class="pop-up">
                    <label for="">Código postal</label>
                    <input type="text" name="CP_n" id="CP_n" class="form-control" placeholder="Código postal" aria-describedby="helpId">
                
                  </div>  

                  <div class="pop-up">
                    <label for="">Número exterior</label>
                    <input type="text" name="num_ext_n" id="num_ext_n" class="form-control" placeholder="Número exterior" aria-describedby="helpId">
                    
                  </div>  


                  <div class="pop-up">
                    <label for="">Estado</label>
                   <select name="Estado_n" id="Estado_n">
                    <?php 
                        $sentencia=$pdo->prepare(" SELECT * FROM ESTADO_REPUBLICA");

                        $sentencia->execute();
                        $lista_Estados=$sentencia->fetchAll(PDO::FETCH_ASSOC);
                        foreach($lista_Estados as $estados){?>
                        <option value="">-- SELECCIONE --</option>
                          <option value="<?php echo $estados['ID_ESTADO_REPUBLICA']?>"><?php echo $estados['NOMBRE_ESTADO_REPUBLICA']?></option>
                        <?php } ?>
                        
                
                   </select>
                  </div>
                  
                  <div class="pop-up">
                    <label for="">Municipio</label>
                   <select name="municipio_n" id="municipio_n">
                   <option value="">-- SELECCIONE --</option>
                   
                   </select>
                  </div>
                  <div class="pop-up">
                    <label for="">Region</label>
                   <select name="region_n" id="region_n">
                   <option value="">-- SELECCIONE --</option>
                   
                   </select>
                  </div>        
                
                  <div class="pop-up">
                    <label for="">Referencia/característica</label>
                    <textarea maxlength="100" name="ref_n" id="ref_n" type="text" placeholder=" " required onkeyup="this.value=mail(this.value)"></textarea>
                  </div>
                <input type="hidden" value="1" name="tienda" id="tienda">
                  <div class="cont_btn_añadir">
                 <input type="submit" class="btn_dir" value="AÑADIR">

                  </div>
                
                  

</form>
                   
               

</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
	
		$("#Estado_n").change(function(){
			$.get("get_cities.php","Estado_n="+$("#Estado_n").val(), function(data){
				$("#municipio_n").html(data);
				console.log(data);
			});
    });
    
    $("#municipio_n").change(function(){
			$.get("get_region_local.php","municipio_n="+$("#municipio_n").val(), function(data){
				$("#region_n").html(data);
				console.log(data);
			});
		});

    $("#dir").change(function(){
			$.get("get_envio.php","dir="+$("#dir").val(), function(data){
				$("#costo_envio").val(data);
				console.log(data);
			});
		});
	});
</script>

</html>