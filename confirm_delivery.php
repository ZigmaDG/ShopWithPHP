<?php 
session_start();
$delivery=$_POST['delivery'];
$personal = $_POST['personal'];
if($delivery==1 && $personal==0){
    $_SESSION['Confirm']=2;

}elseif($delivery==2 && $personal==1){
    $_SESSION['Confirm']=2;
    $_SESSION['ent_personal']=1;
}


?>