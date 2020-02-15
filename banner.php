<?php 
require_once 'conexion.php';


?>


<head>
<script src="JS/jquery.min.js"></script>
<LINK REL=StyleSheet HREF="CSS/banner.css" TYPE="text/css">
<script src="JS/banner.js"></script>
<script src="https://kit.fontawesome.com/24953e27ba.js"></script>
</head>

<div id="slider">
<!--    Start: Buttons-->
  <button class="control_next"><i class="fa fa-chevron-right"></i></button>
  <button class="control_prev"><i class="fa fa-chevron-left"></i></button>
<!--    End: Buttons-->
<!--    Start: Images-->
  <ul class="image_slider_ul">

    <?php 
       $sentencia_comprob=$pdo->prepare("SELECT * FROM CONT_BANNER INNER JOIN IMG_BANNER ON CONT_BANNER.IMG_BANNER=IMG_BANNER.ID_BANNER ORDER BY ID_CONT_BANNER");
       $sentencia_comprob->execute();
       $img_actual=$sentencia_comprob->fetchAll(PDO::FETCH_ASSOC);
    foreach($img_actual as $img){?> 
      <li>
        <div class="bgimage" >
          <img src="<?php echo $img['URL_BANNER']?>" alt="">
       </div>
      </li>
    <?php }

    
      ?>
   
  </ul>
<!--    End: Images-->
<!--    Start: Indicators-->
  <div class="indicator_con">
    <ul class="indicator"></ul>
  </div>
<!--    End Indicators-->
</div>

