<?php 
session_start();
require_once 'conexion.php';

$direccion = $_POST['direccion_n'];
$CP = $_POST['CP_n'];
$num_ext=$_POST['num_ext_n'];
$Estado = $_POST['Estado_n'];
$Municipio = $_POST['municipio_n'];
$ref = $_POST['ref_n'];
$region = $_POST['region_n'];
$ID_USUARIO =$_SESSION['usuario'][0]['ID_USUARIO'];
$COL= $_POST['colonia'];
if(isset($_POST['tienda'])){
    $es_tienda=$_POST['tienda'];
}

if($es_tienda==1){
    $sentence=$pdo->prepare("INSERT INTO USUARIO_DIRECCION VALUES (ID_USUARIO_DIRECCION, :DIRECCION, :CP, :NUMERO, :NOTA_DIRECCION, :ID_USUARIO, :ESTADO, :MUNICIPIO, :REGION, :TIENDA)");
    $sentence->bindParam(':DIRECCION',$direccion);
    $sentence->bindParam(':CP',$CP);
    $sentence->bindParam(':NUMERO',$num_ext);
    $sentence->bindParam(':NOTA_DIRECCION',$ref);
    $sentence->bindParam(':ID_USUARIO',$ID_USUARIO);
    $sentence->bindParam(':ESTADO',$Estado);
    $sentence->bindParam(':MUNICIPIO',$Municipio);
    $sentence->bindParam(':REGION',$region);
    $sentence->bindParam(':TIENDA',$es_tienda);
    $sentence->execute();
}else{
    $sentence=$pdo->prepare("INSERT INTO USUARIO_DIRECCION VALUES (ID_USUARIO_DIRECCION, :DIRECCION, :COL, :CP, :NUMERO, :NOTA_DIRECCION, :ID_USUARIO, :ESTADO, :MUNICIPIO, :REGION, 0)");
$sentence->bindParam(':DIRECCION',$direccion);
$sentence->bindParam(':COL',$COL);
$sentence->bindParam(':CP',$CP);
$sentence->bindParam(':NUMERO',$num_ext);
$sentence->bindParam(':NOTA_DIRECCION',$ref);
$sentence->bindParam(':ID_USUARIO',$ID_USUARIO);
$sentence->bindParam(':ESTADO',$Estado);
$sentence->bindParam(':MUNICIPIO',$Municipio);
$sentence->bindParam(':REGION',$region);
$sentence->execute();
}



echo'<html>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
            
            </html>
            
            <script> swal({
                    title: "¡REGISTRADA!",
                    text: "DIRECCIÓN AGREGADA",
                    icon: "success",
                    type: "success"
                }).then(function() {
                    window.location = "login.php";
                });</script>';











?>