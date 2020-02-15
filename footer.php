
<?php 




?>


<div class="footer">
    <div class="section">
        <a href="#"><h3>LEGAL</h3></a>
        <ul>
        <li><a href="terminos_y_condiciones">Terminos y condiciones</a></li>
        <li><a href="devoluciones">Devoluciones</a></li>
        <li><a href="terminos_compra">Terminos de Compra</a></li>        
        
        </ul>
     
      
        
    </div>
    <div class="section">
    <a href=""><h3>CATEGORÍAS</h3></a>
    <ul>
    <?php 
                    $sentencia=$pdo->prepare(" SELECT *FROM CATEGORIA_PRODUCTO WHERE ESTADO_CAT=1");
                    $sentencia->execute();
                    $listaCategorias=$sentencia->fetchAll(PDO::FETCH_ASSOC);
                    foreach($listaCategorias as $categorias){
                            echo '<li><a href="http://regalodelcorazon.com/Ver_categoria.php?cat='.$categorias['ID_CATEGORIA'].'&pagina=1">'.$categorias['NOMBRE_CATEGORIA'].'</a></li>';
                    }
                    
                    
                    
                    ?>
    </ul>
    </div>
    <div class="section">
    <a href="#"><h3>NOSOTROS</h3></a>
    <ul>
            <li><a href="nosotros">Conócenos</a></li>
    </ul>
        
      
    </div>





</div>