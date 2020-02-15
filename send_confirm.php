<?php 
session_start();
require_once 'conexion.php';
$sentencia_retiro=$pdo->prepare('SELECT * FROM USUARIO_DIRECCION WHERE DIR_TIENDA=1 ORDER BY ID_USUARIO_DIRECCION DESC LIMIT 1');
           $sentencia_retiro->execute();
           
          $dir_local=$sentencia_retiro->fetchAll(PDO::FETCH_ASSOC);
$dir_actual=$_POST['dir'];
$direccion_nueva=$_POST['dir'];
$destinatario = $_POST['destinatario'];
$num_contacto = $_POST['num_contacto'];
$entrega = $_POST['entrega'];
$msj = $_POST['msj'];
$fecha = $_POST['calendar'];
$horario = $_POST['horario'];

if($entrega==1){
    $envio = $_POST['costo_envio'];
    if($dir_actual=='nueva_dir'){
    
        $_SESSION['Confirm']=3;
        $datos_envio= array (
            'DIR'=> $direccion_nueva,
            'DESTINATARIO'=> $destinatario,
            'NUM_CONTACTO'=> $num_contacto,
        'COSTO_ENVIO'=> $envio,
          'MSJ'=> $msj,
            'FECHA'=> $fecha,
          'HORARIO' => $horario);
            $_SESSION['info_envio'][0]=$datos_envio;
    }else{
        $_SESSION['Confirm']=3;
        $datos_envio= array (
            'DIR'=> $dir_actual,
            'DESTINATARIO'=> $destinatario,
            'NUM_CONTACTO'=> $num_contacto,
            'COSTO_ENVIO'=> $envio,
            'MSJ'=> $msj,
              'FECHA'=> $fecha,
              'HORARIO' => $horario);
            $_SESSION['info_envio'][0]=$datos_envio;
        
    }

}else{
    $envio = "0";

    
    
        $_SESSION['Confirm']=3;
        $datos_envio= array (
            'DIR'=> $dir_local[0]['ID_USUARIO_DIRECCION'],
            'DESTINATARIO'=> $destinatario,
            'NUM_CONTACTO'=> $num_contacto,
        'COSTO_ENVIO'=> $envio,
        'MSJ'=> $msj,
          'FECHA'=> $fecha,
          'HORARIO' => $horario);
            $_SESSION['info_envio'][0]=$datos_envio;
   

    

}






?>
