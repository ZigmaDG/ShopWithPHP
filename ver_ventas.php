<?php 
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';

if($_SESSION['rol']!=1)
{
    echo 'NO ESTAS AUTORIZADO';
    die();
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/ventas.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="JS/enviar.js"></script>
    <title>Ver Ventas</title>
</head>
<body>
    
        <div class="container">
                    <form action="">
                    <div class="form-group">
                      <label for="">Mes</label>
                      
                            <select name="mes" id="mes">
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>

                         </select>
                    </div>
                        <div class="form-group">
                        <label for="">Año</label>
                        <?php 
                            $sentence=$pdo->prepare("SELECT DISTINCT 
                            YEAR(STR_TO_DATE(FECHA_VENTA, '%Y-%m-%d')) as anio from VENTA
                            ");
                            //$sentence->bindParam(':BUSQUEDA',$busqueda);
                            $sentence->execute();
                            $lista=$sentence->fetchAll(PDO::FETCH_ASSOC);?>
        
                     <select name="anio" id="anio">
                        <?php foreach($lista as $anio){?>
                        <option value="<?php echo $anio['anio']?>"><?php echo $anio['anio']?></option>
                        <?php }  ?>

    
            </select>
                </div>
                <div class="form-group-a">
                <a href="#" class="btn_consultar" onclick="venta(1)">CONSULTAR</a>
                </div>
                                
                            
                          
                     </form>

               <div id="tabla_venta"></div>
                           
        
        </div>


<script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
</script>

<script>
  function enviar2(id) {
    elForm= document.getElementsByName('formListado-fila-'+id)[0];
    elForm.submit();
  }
</script>
</body>
</html>