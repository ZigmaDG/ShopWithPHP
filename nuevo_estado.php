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

  
  <title>NUEVO ESTADO</title>
</head>
<body>
 

    <form class="form" method="post" enctype="multipart/form-data" action="add_estado.php">
      <h1>NUEVO ESTADO</h1>
      

      
      <div class="form-group">
        <input type="text" placeholder=" "  name="estado" id="estado" required>
        <label for="name">Estado</label>
       
      </div>

    


      <input type="submit" value="Añadir">

    </form>
</body>
</html>