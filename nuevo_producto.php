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

  
  <title>NUEVO PRODUCTO</title>
</head>
<body>
  <?php $sentencia=$pdo->prepare(" SELECT *FROM CATEGORIA_PRODUCTO ;");
 
        $sentencia->execute();

        $lista_Cat=$sentencia->fetchAll(PDO::FETCH_ASSOC);
     ?>
    <form class="form" method="post" enctype="multipart/form-data" action="add_producto.php">
      <h1>NUEVO PRODUCTO</h1>
      <div class="form-group">
      <input type="file"  class="form-control" name="file"></input>
        <label for="name">Imágen</label>
       
      </div>

      
      <div class="form-group">
        <input type="text" placeholder=" "  name="name" id="name" required>
        <label for="name">Nombre</label>
        <div class="error">
          <i class="fas fa-exclamation-circle"></i>
          ¡Error!
        </div>
      </div>

      <div class="form-group">
 
       
         <select  name="Categoria" id="Categoria">
         <option value='default'>Categoria</option>
           <?php foreach($lista_Cat as $Categoria){?>
            <option value="<?php echo $Categoria['ID_CATEGORIA']?>"><?php echo $Categoria['NOMBRE_CATEGORIA']?></option>
           
           <?php }?>
         </select>
       </div>
        

       <div class="form-group">
                        
              <textarea maxlength="250" name="desc" id="desc" type="text" placeholder=" " required onkeyup="this.value=mail(this.value)"></textarea>
              <label for="desc">Descripción</label>
             </div>
            


        <div class="form-group">
        <input type="text" placeholder=" " name="Precio" id="Precio" required>
        <label for="Precio">Precio</label>
        <div class="error">
          <i class="fas fa-exclamation-circle"></i>
          ¡Error!
        </div>
      </div>
       
      
      
      <div class="form-group">
      
        <label for="Precio">Ofertar en descuento</label>
        <span>  <input type="checkbox" class="descuento" name="descuento" id="descuento" value="SI"></span>
       
      </div>


      <input type="submit" value="Añadir">

    </form>
</body>
</html>