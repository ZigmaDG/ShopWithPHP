<?php 
$id_1=$_POST['banner1'];
$id_2=$_POST['banner2'];
$id_3=$_POST['banner3'];
$id_4=$_POST['banner4'];

require_once 'conexion.php';



$sentencia_comprob=$pdo->prepare("SELECT * FROM CONT_BANNER INNER JOIN IMG_BANNER ON CONT_BANNER.IMG_BANNER=IMG_BANNER.ID_BANNER");
$sentencia_comprob->execute();
$num_sentencia= $sentencia_comprob->rowCount();

if($num_sentencia==0){
    $sentencia1=$pdo->prepare("INSERT INTO CONT_BANNER VALUES(1,$id_1)");
    $sentencia1->execute();
    $sentencia2=$pdo->prepare("INSERT INTO CONT_BANNER VALUES(2,$id_2)");
    $sentencia2->execute();
    $sentencia3=$pdo->prepare("INSERT INTO CONT_BANNER VALUES(3,$id_3)");
    $sentencia3->execute();
    $sentencia4=$pdo->prepare("INSERT INTO CONT_BANNER VALUES(4,$id_4)");
    $sentencia4->execute();
    echo'

        <html>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        </html>

        <script type="text/javascript"> swal({
                title: "¡LISTO!",
                text: "IMG AÑADIDA",
                icon: "success",
                type: "success"
            }).then(function() {
                window.location = "index.php";
            });</script>
        ';  

}if($num_sentencia>0){
    $sentencia1=$pdo->prepare("UPDATE CONT_BANNER SET IMG_BANNER=$id_1 WHERE ID_CONT_BANNER=1");
    $sentencia1->execute();
    $sentencia2=$pdo->prepare("UPDATE CONT_BANNER SET IMG_BANNER=$id_2 WHERE ID_CONT_BANNER=2");
    $sentencia2->execute();
    $sentencia3=$pdo->prepare("UPDATE CONT_BANNER SET IMG_BANNER=$id_3 WHERE ID_CONT_BANNER=3");
    $sentencia3->execute();
    $sentencia4=$pdo->prepare("UPDATE CONT_BANNER SET IMG_BANNER=$id_4 WHERE ID_CONT_BANNER=4");
    $sentencia4->execute();
    echo'

        <html>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        </html>

        <script type="text/javascript"> swal({
                title: "¡MODIFICADO!",
                text: "BANNER MODIFICADO",
                icon: "success",
                type: "success"
            }).then(function() {
                window.location = "index.php";
            });</script>
        ';
}


?>