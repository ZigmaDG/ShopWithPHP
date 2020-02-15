<?php 
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/ventas.css">
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
                <a href="" class="btn_consultar">CONSULTAR</a>
                </div>
                                
                            
                          
                     </form>


           
        
        </div>
    
</body>
</html>