<?php 
require_once 'conexion.php';
$estado=$_POST['estado'];
$municipio=$_POST['municipio'];

 $sentencia=$pdo->prepare(" SELECT *FROM MUNICIPIO_ESTADO WHERE NOMBRE_MUNICIPIO= :MUNICIPIO;");
 $sentencia->bindParam(':MUNICIPIO',$municipio);
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
                          text: "El municipio ya existe",
                          icon: "error",
                          type: "error"
                      }).then(function() {
                          window.location = "index.php";
                      });',
                          '</script>';
        }else{
            $sentencia_2=$pdo->prepare("INSERT INTO MUNICIPIO_ESTADO VALUES(ID_MUNICIPIO, :MUNICIPIO, :ESTADO)");
                        $sentencia_2->bindParam(':MUNICIPIO',$municipio);
                        $sentencia_2->bindParam(':ESTADO',$estado);
                        $sentencia_2->execute();

                          echo'

                                  <html>
                                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


                                  </html>

                                  <script type="text/javascript"> swal({
                                          title: "¡REGISTRADA!",
                                          text: "NUEVO MUNICIPIO AGREGADO",
                                          icon: "success",
                                          type: "success"
                                      }).then(function() {
                                          window.location = "index.php";
                                      });</script>
                                  ';
        }



?>