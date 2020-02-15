<?php 
require_once 'conexion.php';
$estado=$_POST['estado'];

 $sentencia=$pdo->prepare(" SELECT *FROM ESTADO_REPUBLICA WHERE NOMBRE_CATEGORIA= :ESTADO;");
 $sentencia->bindParam(':ESTADO',$estado);
$sentencia->execute();
$num_paginas= $sentencia->rowCount();

if($num_paginas==1){
    echo '
                          <html>
                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                  
                  
                  </html>
                          
                          
                          
                          <script type="text/javascript">',
                          'swal({
                          title: "¡ERROR!",
                          text: "La categoría ya existe",
                          icon: "error",
                          type: "error"
                      }).then(function() {
                          window.location = "index.php";
                      });',
                          '</script>';
        }else{
            $sentencia_2=$pdo->prepare("INSERT INTO ESTADO_REPUBLICA VALUES(ID_ESTADO_REPUBLICA, :ESTADO)");
                          $sentencia_2->bindParam(':ESTADO',$estado);
                          $sentencia_2->execute();

                          echo'

                                  <html>
                                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


                                  </html>

                                  <script type="text/javascript"> swal({
                                          title: "¡REGISTRADA!",
                                          text: "NUEVO ESTADO AGREGADO",
                                          icon: "success",
                                          type: "success"
                                      }).then(function() {
                                          window.location = "index.php";
                                      });</script>
                                  ';
        }



?>