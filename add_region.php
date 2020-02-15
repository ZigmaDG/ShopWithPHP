<?php 
require_once 'conexion.php';
$estado=$_POST['estado'];
$municipio=$_POST['municipio'];
$region =$_POST['region'];
$costo =$_POST['costo'];

 $sentencia=$pdo->prepare(" SELECT *FROM REGION_ENTREGA WHERE NOMBRE_REGION= :REGION;");
 $sentencia->bindParam(':REGION',$region);
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
                          text: "La region ya existe",
                          icon: "error",
                          type: "error"
                      }).then(function() {
                          window.location = "index.php";
                      });',
                          '</script>';
        }else{
            $sentencia_2=$pdo->prepare("INSERT INTO REGION_ENTREGA VALUES(ID_REGION_ENTREGA, :REGION, :MUNICIPIO, :COSTO)");
                          $sentencia_2->bindParam(':REGION',$region);
                          $sentencia_2->bindParam(':MUNICIPIO',$municipio);
                          $sentencia_2->bindParam(':COSTO',$costo);
                         
                          
                          $sentencia_2->execute();

                          echo'

                                  <html>
                                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


                                  </html>

                                  <script type="text/javascript"> swal({
                                          title: "¡REGISTRADA!",
                                          text: "NUEVA REGION AGREGADA",
                                          icon: "success",
                                          type: "success"
                                      }).then(function() {
                                          window.location = "index.php";
                                      });</script>
                                  ';
        }



?>