<?php 
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';

if($_SESSION['log-on']!=true)
{
   
    header('Location: login.php');
    exit;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <LINK REL=StyleSheet HREF="CSS/menu_cuenta.css" TYPE="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="CSS/ventas.css">
    <link rel="stylesheet" href="CSS/cambiar_pass.css" >

    <script src="JS/jquery.min.js"></script>
    <script src="JS/enviar.js"></script>


    <title>Mi cuenta</title>
</head>
<body>
        <div class="menu_cuenta">
            
                <a href="#" onclick="ver_compras()"><i class='fa fa-shopping-bag'></i>Compras</a>
                <a href="#" onclick="ver_datos()"><i class='far fa-user'></i>Datos </a>
        </div>
        <div class="menu_cuenta2">
            
            <a href="#" onclick="ver_compras()"><i class='fa fa-shopping-bag'></i></a>
            <a href="#" onclick="ver_datos()"><i class='far fa-user'></i></a>
           
         </div>
        <div class="opcion" id="container">
        </div>
        

        
</body>
<script>
  function enviar2(id) {
    elForm= document.getElementsByName('formListado-fila-'+id)[0];
    elForm.submit();
  }
</script>
</html>