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

$id=$_POST['ID_CATEGORIA'];


$sentencia=$pdo->prepare(" SELECT *FROM CATEGORIA_PRODUCTO WHERE ID_CATEGORIA=$id;");       
$sentencia->execute();
$Producto=$sentencia->fetchAll(PDO::FETCH_ASSOC);

        
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/Estilo_form_edit.css">
    <script src="JS/jquery.min.js"></script>
    <script src="JS/check.js"></script>
    <title>EDITAR PRODUCTOS</title>
</head>
<body>
<form class="form" method="post" enctype="multipart/form-data" action="Edit_element.php">
      <h1>EDITAR CATEGORÍA</h1>
    

      
      <div class="form-group">
      
      <input type="hidden" name="id_categoria" value="<?php echo $id?>" >
      <input type="text" readonly placeholder=" "  name="name" id="name" required value="<?php echo $Producto[0]['NOMBRE_CATEGORIA']?>">
      <label for="name">Nombre</label>
      <span>  <input type="checkbox" name="suspended" id="s"></span>
        
      </div>

      


      <input type="submit" value="Editar">

    </form>

</body>
</html>