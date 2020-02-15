<?php 
session_start();
$pago=$_POST['pago'];
if($pago==1){
    $_SESSION['Confirm']=1;
    $_SESSION['pago']=$pago;

}elseif($pago==2){
    $_SESSION['Confirm']=1;
    $_SESSION['pago']=$pago;
}


?>