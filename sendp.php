<?php 
session_start();
require_once 'conexion.php';
$id=openssl_decrypt($_POST['id'],COD,KEY);


echo   $id;



?>