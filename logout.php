<?php 
session_start();

unset($_SESSION['info_envio']);
unset($_SESSION['log-on']);
unset($_SESSION['usuario']);
$_SESSION['Confirm']=0;
header("location:index.php");

?>