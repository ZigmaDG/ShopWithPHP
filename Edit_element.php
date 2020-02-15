<?php 

require_once 'conexion.php';
if(isset($_POST['id_producto'])){
    $id_producto=$_POST['id_producto'];
    $nombre=$_POST['name'];
    $desc=$_POST['desc'];
    $precio=$_POST['Precio'];
    $categoria=$_POST['Categoria'];
  
    
    if(isset($_POST['descuento'])){
        $descuento=$_POST['descuento'];
    }else{
        $descuento='NO';
    }
    
 
    if($_FILES['file_edit']['size'] == 0){
                
        $sentencia=$pdo->prepare("UPDATE PRODUCTO SET NOMBRE_PRODUCTO = :NOMBRE, PRECIO_UNIDAD = :PRECIO, DESCRIPCION_PRODUCTO = :DESCRIPCION, CATEGORIA = :CATEGORIA, DESCUENTO = :DESCUENTO WHERE ID_PRODUCTO=$id_producto");
        $sentencia->bindParam(':NOMBRE',$nombre);
        $sentencia->bindParam(':PRECIO',$precio);
        $sentencia->bindParam(':DESCRIPCION',$desc);
        $sentencia->bindParam(':CATEGORIA',$categoria);
        $sentencia->bindParam(':DESCUENTO',$descuento);
        $sentencia->execute();
        
        echo'

        <html>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        </html>

        <script type="text/javascript"> swal({
                title: "¡MODIFICADO!",
                text: "PRODUCTO MODIFICADO",
                icon: "success",
                type: "success"
            }).then(function() {
                window.location = "index.php";
            });</script>
        ';
    }else{
        $file=$_FILES['file_edit']['name'];

        $allowedExts = array("gif", "jpeg", "jpg", "png","JPG", "JPEG","PNG","GIF");
        $explode=explode(".", $file);
        $extension = end($explode);
        if ((($_FILES['file_edit']["type"] == "image/gif")
        || ($_FILES['file_edit']["type"] == "image/jpeg")
        || ($_FILES['file_edit']["type"] == "image/jpg")
        || ($_FILES['file_edit']["type"] == "image/png")
        || ($_FILES['file_edit']["type"] == "image/JPG")
        || ($_FILES['file_edit']["type"] == "image/JPEG")
        || ($_FILES['file_edit']["type"] == "image/PNG")
        || ($_FILES['file_edit']["type"] == "image/GIF"))
        && in_array($extension, $allowedExts)){
            move_uploaded_file($_FILES['file_edit']['tmp_name'],"IMG-RESOURCES/IMG-PRODUCTS/" . $_FILES['file_edit']['name']);
    
            $URL = "IMG-RESOURCES/IMG-PRODUCTS/".$file;

            $sentencia=$pdo->prepare("UPDATE PRODUCTO SET NOMBRE_PRODUCTO = :NOMBRE, PRECIO_UNIDAD = :PRECIO, DESCRIPCION_PRODUCTO = :DESCRIPCION, CATEGORIA = :CATEGORIA, IMG_PRODUCTO = :IMG, DESCUENTO = :DESCUENTO WHERE ID_PRODUCTO=$id_producto");
            $sentencia->bindParam(':NOMBRE',$nombre);
            $sentencia->bindParam(':PRECIO',$precio);
            $sentencia->bindParam(':DESCRIPCION',$desc);
            $sentencia->bindParam(':CATEGORIA',$categoria);
            $sentencia->bindParam(':IMG',$URL);
            $sentencia->bindParam(':DESCUENTO',$descuento);
            $sentencia->execute();

            echo'

                <html>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


                </html>

                <script type="text/javascript"> swal({
                        title: "¡MODIFICADO!",
                        text: "PRODUCTO MODIFICADO",
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
} }


if(isset($_POST['id_categoria'])){
    

    $id_categoria=$_POST['id_categoria'];
    $nombre =$_POST['name'];
    $sentencia=$pdo->prepare("UPDATE CATEGORIA_PRODUCTO SET NOMBRE_CATEGORIA = :NOMBRE WHERE ID_CATEGORIA=$id_categoria");
    $sentencia->bindParam(':NOMBRE',$nombre);
    $sentencia->execute();

    echo'

                <html>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


                </html>

                <script type="text/javascript"> swal({
                        title: "¡MODIFICADO!",
                        text: "CATEGORIA MODIFICADA",
                        icon: "success",
                        type: "success"
                    }).then(function() {
                        window.location = "index.php";
                    });</script>
                ';


}


?> 