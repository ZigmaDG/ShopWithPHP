<?php
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/Estilo_registro.css">

    <script src="JS/jquery.min.js"></script>
    <script src="JS/enviar.js"></script>

    <title>Seleccionar IMG</title>
</head>
<body>

<div class="form_registro">


    <?php 
     $sentencia=$pdo->prepare("SELECT * FROM IMG_BANNER");
     $sentencia->execute();
     $img_banner=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    
     $sentencia_comprob=$pdo->prepare("SELECT * FROM CONT_BANNER INNER JOIN IMG_BANNER ON CONT_BANNER.IMG_BANNER=IMG_BANNER.ID_BANNER ORDER BY ID_CONT_BANNER");
     $sentencia_comprob->execute();
     $img_actual=$sentencia_comprob->fetchAll(PDO::FETCH_ASSOC);

     $num_sentencia= $sentencia_comprob->rowCount();
    
    ?>
    <form action="select_img.php" class="form" method="post">
        <h1>SELECCIONAR IMÁGENES</h1>
    <div class="banner">
      <label for="">Primera imágen</label>
        <select name="banner1" id="banner1">
        <?php if($num_sentencia>0){
                        echo '<option value="'.$img_actual[0]['ID_BANNER'].'">'.$img_actual[0]['URL_BANNER'].'</option>';

            }
            foreach($img_banner as $img){
                echo '<option value="'.$img['ID_BANNER'].'">'.$img['URL_BANNER'].'</option>';

            }
            ?> 
        
        </select>
    </div>

    <div class="banner">
      <label for="">Segunda imágen</label>
        <select name="banner2" id="banner2">
        <?php if($num_sentencia>0){
                        echo '<option value="'.$img_actual[1]['ID_BANNER'].'">'.$img_actual[1]['URL_BANNER'].'</option>';

            }
            foreach($img_banner as $img){
                echo '<option value="'.$img['ID_BANNER'].'">'.$img['URL_BANNER'].'</option>';

            }
            ?> 
        <option value="">img 2</option>
        </select>
    </div>
        
    <div class="banner">
      <label for="">Tercera imágen</label>
        <select name="banner3" id="banner3">
        <?php if($num_sentencia>0){
                        echo '<option value="'.$img_actual[2]['ID_BANNER'].'">'.$img_actual[2]['URL_BANNER'].'</option>';

            }
            foreach($img_banner as $img){
                echo '<option value="'.$img['ID_BANNER'].'">'.$img['URL_BANNER'].'</option>';

            }
            ?> 
        <option value="">img 3</option>
        </select>
    </div>
    

    <div class="banner">
      <label for="">Cuarta imágen</label>
        <select name="banner4" id="banner4">
        <?php if($num_sentencia>0){
                        echo '<option value="'.$img_actual[3]['ID_BANNER'].'">'.$img_actual[3]['URL_BANNER'].'</option>';

            }
            foreach($img_banner as $img){
                echo '<option value="'.$img['ID_BANNER'].'">'.$img['URL_BANNER'].'</option>';

            }
            ?> 
       
        </select>
    </div>
    <input type="submit" value="Subir">
    </form>
</div>
</body>
</html>