<?php 
require_once 'conexion.php';
session_start();
$usuario=$_POST['username'];
$pass=$_POST['password'];
 
$sentencia=$pdo->prepare("SELECT * FROM TABLA_ACCESOS WHERE EMAIL= :EMAIL AND PASS= :PASS");
$sentencia->bindParam('EMAIL',$usuario);
$sentencia->bindParam('PASS',$pass);
$sentencia->execute();
$usuario_existe= $sentencia->rowCount();

$DATOS_ACCESO=$sentencia->fetchAll(PDO::FETCH_ASSOC);



 if($usuario_existe==1){
     $ID_USUARIO = $DATOS_ACCESO[0]['ID_USUARIO'];
     $sentencia_2=$pdo->prepare("SELECT * FROM USUARIO INNER JOIN TABLA_USUARIO_ROL ON USUARIO.ID_USUARIO = TABLA_USUARIO_ROL.ID_USUARIO WHERE USUARIO.ID_USUARIO= :ID");
     $sentencia_2->bindParam('ID',$ID_USUARIO);
     $sentencia_2->execute();
     $DATOS_USUARIO=$sentencia_2->fetchAll(PDO::FETCH_ASSOC);
     $rol=$DATOS_USUARIO[0]['ID_ROL'];
     
        
            $_SESSION['log-on']=true;
            $_SESSION['rol']=$rol;
            $_SESSION['usuario']=$DATOS_USUARIO;
            header("location:index.php");


 }else{
            echo'<html>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
            
            </html>
            
            <script> swal({
                    title: "¡DATOS INCORRECTOS!",
                    text: "ingresa datos validos",
                    icon: "error",
                    type: "error"
                }).then(function() {
                    window.location = "login.php";
                });</script>
            ';
 }






?>