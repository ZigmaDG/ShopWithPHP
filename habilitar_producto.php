<?php 
require_once 'conexion.php';

$id = $_POST['ID_PRODUCTO'];

$sentencia = $pdo->prepare("UPDATE PRODUCTO SET ESTADO_PRODUCTO=1 WHERE ID_PRODUCTO=:ID");
$sentencia->bindParam(':ID',$id);
$sentencia->execute();
echo'

        <html>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        </html>

        <script type="text/javascript"> swal({
                title: "HABILITADO!",
                text: "PRODUCTO REACTIVADO",
                icon: "success",
                type: "success"
            }).then(function() {
                window.location = "editar.php?edit=1";
            });</script>
        ';


?>