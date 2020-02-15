<?php 
require_once 'conexion.php';
$nombre=$_POST['nombre'];

 $sentencia=$pdo->prepare(" SELECT * FROM CATEGORIA_PRODUCTO WHERE NOMBRE_CATEGORIA= :NOMBRE;");
 $sentencia->bindParam(':NOMBRE',$nombre);
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
            $sentencia_2=$pdo->prepare("INSERT INTO CATEGORIA_PRODUCTO VALUES(ID_CATEGORIA, :NOMBRE, 1)");
                          $sentencia_2->bindParam(':NOMBRE',$nombre);
                          $sentencia_2->execute();

                          echo'

                                  <html>
                                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


                                  </html>

                                  <script type="text/javascript"> swal({
                                          title: "¡REGISTRADA!",
                                          text: "NUEVA CATEGORIA AGREGADA",
                                          icon: "success",
                                          type: "success"
                                      }).then(function() {
                                          window.location = "index.php";
                                      });</script>
                                  ';
        }



?>