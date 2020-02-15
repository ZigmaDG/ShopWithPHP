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

$id=$_POST['ID_PRODUCTO'];


$sentencia=$pdo->prepare(" SELECT *FROM PRODUCTO INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.CATEGORIA=CATEGORIA_PRODUCTO.ID_CATEGORIA WHERE PRODUCTO.ID_PRODUCTO=$id;");       
$sentencia->execute();
$Producto=$sentencia->fetchAll(PDO::FETCH_ASSOC);
$Categ=$Producto[0]['NOMBRE_CATEGORIA'];

$sentencia_2=$pdo->prepare(" SELECT *FROM CATEGORIA_PRODUCTO WHERE NOT NOMBRE_CATEGORIA='$Categ';");
 
        $sentencia_2->execute();

        $lista_Cat=$sentencia_2->fetchAll(PDO::FETCH_ASSOC);

        
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/Estilo_form_edit_productos.css">
    <script src="JS/jquery.min.js"></script>
    <script src="JS/check.js"></script>
    <title>EDITAR PRODUCTOS</title>
</head>
<body>
<form class="form" method="post" enctype="multipart/form-data" action="Edit_element.php">
      <h1>EDITAR PRODUCTO</h1>
      <input type="hidden" name="id_producto" value="<?php echo $id?>" >
      <div class="form-group">
      <input type="file"  class="form-control" name="file_edit"></input>
        <label for="file">Imágen</label>
       
      </div>

      
      <div class="form-group">
      
     
      <input type="text" readonly placeholder=" "  name="name" id="name" required value="<?php echo $Producto[0]['NOMBRE_PRODUCTO']?>">
      <label for="name">Nombre</label>
      <span>  <input type="checkbox" name="suspended" id="s"></span>
       
      </div>

      <div class="form-group">
 
       
         <select  name="Categoria" id="Categoria">
       
            <option value="<?php echo $Producto[0]['ID_CATEGORIA']?>"><?php echo $Producto[0]['NOMBRE_CATEGORIA']?></option>
            <?php foreach($lista_Cat as $Categoria){?>
              <option value="<?php echo $Categoria['ID_CATEGORIA']?>"><?php echo $Categoria['NOMBRE_CATEGORIA']?></option>

           <?php }?>
         </select>
       </div>
        

       <div class="form-group">
                        
              <textarea maxlength="250" readonly name="desc" id="desc" type="text" placeholder=" " required onkeyup="this.value=mail(this.value)"><?php echo $Producto[0]['DESCRIPCION_PRODUCTO']?></textarea>
              <label for="desc">Descripción</label>
              <span>  <input type="checkbox" name="suspended" id="s1"></span>
             </div>
            


        <div class="form-group">
        <input type="text" placeholder=" " readonly name="Precio" id="Precio" required value="<?php echo $Producto[0]['PRECIO_UNIDAD']?>">
        <label for="Precio">Precio</label>
        <span>  <input type="checkbox" name="suspended" id="s2"></span>
        
      </div>
       

      
      
      <div class="form-group">
      <span>  <input type="checkbox" class="descuento" name="descuento" id="descuento" value="SI" <?php echo $Producto[0]['DESCUENTO']=='SI'? 'checked':' ' ?>></span>

        <label for="Precio">Ofertar en descuento</label>
       
      </div>


      <input type="submit" value="Añadir">

    </form>
</body>
</html>