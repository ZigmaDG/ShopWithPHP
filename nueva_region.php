<?php 
session_start();

include 'header.php';
include 'header2.php';
require_once 'conexion.php';


if($_SESSION['rol']!=1)
{
    echo 'NO ESTAS AUTORIZADO';
    die();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/Estilo_registro.css">

  
  <title>NUEVA REGION DE ENVÍO</title>
</head>
<body>
 

    <form class="form" method="post" enctype="multipart/form-data" action="add_region.php">
      <h1>NUEVA REGION DE ENVÍO</h1>
      
        <?php 
        $sentencia=$pdo->prepare("SELECT * FROM ESTADO_REPUBLICA");
        $sentencia->execute();
       $estados= $sentencia->fetchAll(PDO::FETCH_ASSOC);

       
        ?>
      
      <div class="form-group">
        <select name="estado" id="estado">
        <option value="0">-- SELECCIONE --</option>
        <?php 
        foreach($estados as $estado){?>
    <option value="<?php echo $estado['ID_ESTADO_REPUBLICA']?>"><?php echo $estado['NOMBRE_ESTADO_REPUBLICA']?></option>
        <?php }
        ?>
        
        </select>
       
      </div>

      <div class="form-group">
        <select name="municipio" id="municipio">
        
        
        </select>
       
      </div>

      <div class="form-group">
        <input type="text" placeholder=""  name="region" id="region" required>
        <label for="name">Región</label>
       
      </div>
      <div class="form-group">
        <input type="text" placeholder=""  name="costo" id="costo" required>
        <label for="name">Costo de envío</label>
       
      </div>


    


      <input type="submit" value="Añadir">

    </form>

    <script>
    
    $(document).ready(function(){
	
    $("#estado").change(function(){
        $.get("get_municipios.php","estado="+$("#estado").val(), function(data){
            $("#municipio").html(data);
            console.log(data);
        });
});


});


    </script>
</body>
</html>