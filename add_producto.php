<?php 
require_once 'conexion.php';

$file = $_FILES['file']['name'];
$nombre=$_POST['name'];
$categoria=$_POST['Categoria'];
$precio=$_POST['Precio'];
$desc=$_POST['desc'];



if(isset($_POST['descuento'])){
    $oferta=$_POST['descuento'];
}else{
    $oferta='NO';
}







$sentencia_comp=$pdo->prepare(" SELECT *FROM PRODUCTO WHERE NOMBRE_PRODUCTO= :NOMBRE;");
$sentencia_comp->bindParam(':NOMBRE',$nombre);
$sentencia_comp->execute();
$num_paginas= $sentencia_comp->rowCount();

if($num_paginas==1)
{
    echo '
                          <html>
                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                  
                  
                  </html>
                          
                          
                          
                          <script type="text/javascript">',
                          'swal({
                          title: "¡ERROR!",
                          text: "El producto ya existe",
                          icon: "error",
                          type: "error"
                      }).then(function() {
                          window.location = "index.php";
                      });',
                          '</script>';
}else{
    $allowedExts = array("gif", "jpeg", "jpg", "png","JPG", "JPEG","PNG","GIF");
    $explode=explode(".", $file);
    $extension = end($explode);
    if ((($_FILES['file']["type"] == "image/gif")
    || ($_FILES['file']["type"] == "image/jpeg")
    || ($_FILES['file']["type"] == "image/jpg")
    || ($_FILES['file']["type"] == "image/png")
    || ($_FILES['file']["type"] == "image/JPG")
    || ($_FILES['file']["type"] == "image/JPEG")
    || ($_FILES['file']["type"] == "image/PNG")
    || ($_FILES['file']["type"] == "image/GIF"))
    && in_array($extension, $allowedExts)){
        move_uploaded_file($_FILES['file']['tmp_name'],"IMG-RESOURCES/IMG-PRODUCTS/" . $_FILES['file']['name']);

        $URL = "IMG-RESOURCES/IMG-PRODUCTS/".$file;



        $sentencia=$pdo->prepare("INSERT INTO PRODUCTO VALUES(ID_PRODUCTO, :NOMBRE, :PRECIO, :DESCRIPCION, :CATEGORIA, :IMG_PRODUCTO, :DESCUENTO, 1)");
        $sentencia->bindParam(':NOMBRE',$nombre);
        $sentencia->bindParam(':PRECIO',$precio);
        $sentencia->bindParam(':DESCRIPCION',$desc);
        $sentencia->bindParam(':CATEGORIA',$categoria);
        $sentencia->bindParam(':IMG_PRODUCTO',$URL);
        $sentencia->bindParam(':DESCUENTO',$oferta);


        $sentencia->execute();

        
        echo'

                <html>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


                </html>

                <script type="text/javascript"> swal({
                        title: "¡REGISTRADO!",
                        text: "NUEVO PRODUCTO AGREGADO",
                        icon: "success",
                        type: "success"
                    }).then(function() {
                        window.location = "index.php";
                    });</script>
                ';
    }else{
        echo '
        <html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</html>
        
        
        
        <script type="text/javascript">',
        'swal({
        title: "¡ERROR!",
        text: "el archivo  no es imágen",
        icon: "error",
        type: "error"
    }).then(function() {
        window.location = "index.php";
    });',
        '</script>';
    }
}


                   


                 


?>
