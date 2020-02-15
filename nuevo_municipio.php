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

  
  <title>NUEVO MUNICIPIO</title>
</head>
<body>
 

    <form class="form" method="post" enctype="multipart/form-data" action="add_municipio.php">
      <h1>NUEVO MUNICIPIO</h1>
      
        <?php 
        $sentencia=$pdo->prepare("SELECT * FROM ESTADO_REPUBLICA");
        $sentencia->execute();
       $estados= $sentencia->fetchAll(PDO::FETCH_ASSOC);
        ?>
      
      <div class="form-group">
        <select name="estado" id="estado">
        <?php 
        foreach($estados as $estado){?>
    <option value="<?php echo $estado['ID_ESTADO_REPUBLICA']?>"><?php echo $estado['NOMBRE_ESTADO_REPUBLICA']?></option>
        <?php }
        ?>
        
        
        </select>
       
      </div>

      <div class="form-group">
        <input type="text" placeholder=""  name="municipio" id="municipio" required>
        <label for="name">Municipio</label>
       
      </div>

    


      <input type="submit" value="Añadir">

    </form>
</body>
</html>