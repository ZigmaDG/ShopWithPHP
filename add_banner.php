<?php 
require_once 'conexion.php';

$file = $_FILES['banner']['name'];











    $allowedExts = array("gif", "jpeg", "jpg", "png","JPG", "JPEG","PNG","GIF");
    $explode=explode(".", $file);
    $extension = end($explode);
    if ((($_FILES['banner']["type"] == "image/gif")
    || ($_FILES['banner']["type"] == "image/jpeg")
    || ($_FILES['banner']["type"] == "image/jpg")
    || ($_FILES['banner']["type"] == "image/png")
    || ($_FILES['banner']["type"] == "image/JPG")
    || ($_FILES['banner']["type"] == "image/JPEG")
    || ($_FILES['banner']["type"] == "image/PNG")
    || ($_FILES['banner']["type"] == "image/GIF"))
    && in_array($extension, $allowedExts)){
        move_uploaded_file($_FILES['banner']['tmp_name'],"IMG-RESOURCES/IMG-PRODUCTS/" . $_FILES['banner']['name']);

        $URL = "IMG-RESOURCES/IMG-PRODUCTS/".$file;



        $sentencia=$pdo->prepare("INSERT INTO IMG_BANNER VALUES(ID_BANNER, :IMG_PRODUCTO)");
        
        $sentencia->bindParam(':IMG_PRODUCTO',$URL);
       


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


                 


?>
