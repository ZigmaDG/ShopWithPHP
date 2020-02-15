<?php 
require_once 'conexion.php';

$id = $_POST['ID_CATEGORIA'];

$sentencia = $pdo->prepare("UPDATE CATEGORIA_PRODUCTO SET ESTADO_CAT=1 WHERE ID_CATEGORIA=:ID");
$sentencia->bindParam(':ID',$id);
$sentencia->execute();
echo'

        <html>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        </html>

        <script type="text/javascript"> swal({
                title: "¡HABILITADO!",
                text: "CATEGORIA REACTIVADA",
                icon: "success",
                type: "success"
            }).then(function() {
                window.location = "editar.php?edit=2";
            });</script>
        ';


?>