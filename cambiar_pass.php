<?php 
session_start();
require_once 'conexion.php';
$pass = $_POST['pass'];
$id=$_SESSION['usuario'][0]['ID_USUARIO'];

$sentencia = $pdo->prepare("UPDATE TABLA_ACCESOS SET PASS= :PASS WHERE ID_USUARIO= :ID");
$sentencia->bindParam(':PASS', $pass);
$sentencia->bindParam(':ID', $id);
$sentencia->execute();

echo'

<html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</html>

<script type="text/javascript"> swal({
        title: "¡MODIFICADA!",
        text: "CONTRASEÑA MODIFICADA",
        icon: "success",
        type: "success"
    }).then(function() {
        window.location = "index.php";
    });</script>
';


?>