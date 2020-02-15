<?php 
session_start();
if(isset($_SESSION['log-on'])){
  $acceso=true;
}else{
  header('Location:index.php');
}
include 'header.php';
include 'header2.php';
require_once 'conexion.php';

$total=openssl_decrypt($_POST['total'],COD,KEY);
$SID=session_id();
$ID_USUARIO=$_SESSION['usuario'][0]['ID_USUARIO'];
$confirm=$_SESSION['Confirm'];
if(isset($_SESSION['info_envio'])){
  $datos_envio=$_SESSION['info_envio'];
  $total = $total+$datos_envio[0]['COSTO_ENVIO'];
  
}
$_SESSION['total']=$total;
if(isset( $_SESSION['pago'])){
  $pago=  $_SESSION['pago'];
}

?>

<!DOCTYPE html>

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <LINK REL=StyleSheet HREF="CSS/Estilo_pago.css" TYPE="text/css">

    <LINK REL=StyleSheet HREF="CSS/pop_up.css" TYPE="text/css">
    <script src="JS/jquery.min.js"></script>
    <script src="JS/enviar.js"></script>
    <link rel="stylesheet" href="CSS/Estilo_productos.css" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="CSS/jquery-ui.css">
<script src="JS/jquery.min.js"></script>

<script src="JS/jquery-ui.js"></script>


    
</head>

<body>
    <!-- Set up a container element for the button -->
    <div class="page-wrapper">
              </div>
              <div class="modal-wrapper">
                <div class="modal">
                  <div class="head">
                  <h3>NUEVA DIRECCIÓN</h3>
                    <a class="btn-close trigger" href="javascript:;"></a>
                  </div>
                  <div class="content">

                  <form action="" method="post">
                  <div class="pop-up">
                    <label for="">Dirección</label>
                    <input type="text" name="direccion_n" id="direccion_n" class="form-control" placeholder="Dirección" aria-describedby="helpId">
                    
                  </div>
                  <div class="pop-up">
                    <label for="">Número exterior e interior</label>
                    <input type="text" name="num_ext_n" id="num_ext_n" class="form-control" placeholder="Número exterior e interior" aria-describedby="helpId">
                    
                  </div>  
                  <div class="pop-up">
                    <label for="">Colonia</label>
                    <input type="text" name="colonia" id="colonia" class="form-control" placeholder="Colonia" aria-describedby="helpId">
                    
                  </div>  

                  <div class="pop-up">
                    <label for="">Código postal</label>
                    <input type="text" name="CP_n" id="CP_n" class="form-control" placeholder="Código postal" aria-describedby="helpId">
                
                  </div>  



                  <div class="pop-up">
                    <label for="">Estado</label>
                   <select name="Estado_n" id="Estado_n">
                    <?php 
                        $sentencia=$pdo->prepare(" SELECT * FROM ESTADO_REPUBLICA");

                        $sentencia->execute();
                        $lista_Estados=$sentencia->fetchAll(PDO::FETCH_ASSOC);
                        foreach($lista_Estados as $estados){?>
                        <option value="">-- SELECCIONE --</option>
                          <option value="<?php echo $estados['ID_ESTADO_REPUBLICA']?>"><?php echo $estados['NOMBRE_ESTADO_REPUBLICA']?></option>
                        <?php } ?>
                        
                
                   </select>
                  </div>
                  
                  <div class="pop-up">
                    <label for="">Municipio</label>
                   <select name="municipio_n" id="municipio_n">
                   <option value="">-- SELECCIONE --</option>
                   
                   </select>
                  </div>
                  <div class="pop-up">
                    <label for="">Region</label>
                   <select name="region_n" id="region_n">
                   <option value="">-- SELECCIONE --</option>
                   
                   </select>
                  </div>        
                
                  <div class="pop-up">
                    <label for="">Referencia/característica</label>
                    <textarea maxlength="100" name="ref_n" id="ref_n" type="text" placeholder=" " required onkeyup="this.value=mail(this.value)"></textarea>
                  </div>
 
                  <div class="cont_btn_añadir">
                  <a href="#" class="btn_dir" onclick="Direccion(1)">Añadir</a>

                  </div>
                
                  
                  </form>
                  </div>
                </div>
              </div>

    <div class="container_pago">
    <div class="datos_envio" id="datos_envio">


    <?php 
    if($confirm==0){?>
      <h2>Elegir método de pago</h2>
           


            <form action="#" method="post">

                 <input type="hidden" value="1" id="pago1" name="pago1">
                  <a href="#" onclick="metodo_pago()">Pagar con PAYPAL</a>
            </form>

            <form action="#" method="post">

            <input type="hidden" value="2" id="pago2" name="pago2">

                 <a href="#" onclick="metodo_pago2()">Depósito bancario</a>
            </form>
 
   <?php }?>

   <?php 
    if($confirm==1){?>
      <h2>Elegir método de entrega</h2>
           


            <form action="#" method="post">

                 <input type="hidden" value="1" id="delivery" name="delivery">
                 <input type="hidden" value="0" id="personal" name="personal">
                  <a href="#" onclick="delivery()">Envío a domicilio (solo Aguascalientes)</a>
            </form>

          
   <?php }?>















        <?php 
        if($confirm==2){
          
           
          
          $sentencia=$pdo->prepare(" SELECT *FROM USUARIO_DIRECCION WHERE ID_USUARIO=$ID_USUARIO ;");
 
          $sentencia->execute();
          $num_dir = $sentencia->rowCount();
  
          $lista_Dir=$sentencia->fetchAll(PDO::FETCH_ASSOC);
          ?>
                <form action="" method="post" id="myForm">
              <?php if(!isset($_SESSION['ent_personal'])) {?>
               <h2>Datos  para envío(solo Aguascalientes)</h2>
              <hr>
                   
                       <div class="form-group">
             
                          <label for="direccion">Usar esta dirección: </label>
                         <a class="btn trigger" href="javascript:;">Nueva Dirección</a>
                         <?php 
                         if($num_dir>=1){?>
                         <select name="dir" id="dir">
                          <option value="0">-- SELECCIONE --</option>
                          <?php foreach($lista_Dir as $Direccion){?>
                  
                            <option value="<?php echo $Direccion['ID_USUARIO_DIRECCION']?>"><?php echo $Direccion['CP'].' '.$Direccion['DIRECCION'].', Número: #'.$Direccion['NUMERO']?></option>
                      
                           <?php }?>
                  
                           </select>
                           <?php }else{?>
                           <option value="0">--AGREGA UNA DIRECCION--</option>

                           <?php  }?>
                           </div>  <?php }
               
                            ?>
               
              
                       
                           <div class="form-group">
               
                     <input type="text" class="input" name="destinatario" id="destinatario" placeholder="Nombre y Apellido de quien recibe">

                     </div>
                        <div class="form-group">
                   <input type="text" class="input" name="num_contacto" id="num_contacto" placeholder="Teléfono de contacto">
                   </div>
                   <div class="form-group">
                    
                    <textarea maxlength="150" name="msj" id="msj" type="text" placeholder="Mensaje con dedicatoria(opcional)" required onkeyup="this.value=mail(this.value)"></textarea>
                  </div>
                  <div class="form-group">
                  <input type="text" readonly id="calendar" name="calendar" value="" placeholder="Fecha de entrega"/>

                  </div>
                  <div class="form-group">
                    <label for="">Horario de entrega deseado</label>
                              <select name="horario" id="horario">
                                <?php 
                                 $sentencia_horario=$pdo->prepare(" SELECT *FROM HORARIO_ENTREGA ");
 
                                 $sentencia_horario->execute();
                                 $lista_Horario=$sentencia_horario->fetchAll(PDO::FETCH_ASSOC);

                               foreach($lista_Horario as $horario){?>
                  
                                  <option value="<?php echo $horario['RANGO_HORAS']?>"><?php echo $horario['RANGO_HORAS']?></option>
                            
                                
                               <?php } ?>
                              
                              </select>
                  </div>
                  
                   <?php if(!isset($_SESSION['ent_personal']))
                   {?>
                   <div class="form-group">
                     <label for="">Costo de envío en MXN</label>
                     <input type="text" class="input" name="costo_envio" id="costo_envio" placeholder="Costo del envío" readonly value="">
                   </div>
                 
                    <input type="hidden" class="input" name="entrega" id="entrega" value="1">

                    <?php }else{?>
                     <input type="hidden" class="input" name="entrega" id="entrega" value="2">
                     <?php }?>
                   
             
              

                   </form>



              <p id="respa"></p>
       <?php }if($confirm==3){
         
         if(isset($_SESSION['ent_personal']) && $_SESSION['ent_personal']==1){  
           $sentencia_retiro=$pdo->prepare('SELECT * FROM USUARIO_DIRECCION WHERE DIR_TIENDA=1 ORDER BY ID_USUARIO_DIRECCION DESC LIMIT 1');
           $sentencia_retiro->execute();
           
          $dir_local=$sentencia_retiro->fetchAll(PDO::FETCH_ASSOC);
           ?>
            <h2>Recoger en nuestra sucursal</h2>
              <label for=""style="text-aling:center;" >Recoge: <?php echo $datos_envio[0]['DESTINATARIO']?></label><br>
              <label for=""style="text-aling:center;" >Recoger en: <?php echo $dir_local[0]['DIRECCION'].' #'.$dir_local[0]['NUMERO'].'('.$dir_local[0]['NOTA_DIRECCION'].')'?></label><br>
              <label for=""style="text-aling:center;" >Tel. de Contacto: 47474747</label><br>
              <label for=""style="text-aling:center;" >Dedicatoria: <?php echo $datos_envio[0]['MSJ']?></label><br>
              <label for=""style="text-aling:center;" >Fecha deseada de entrega: <?php echo $datos_envio[0]['FECHA']?></label><br>

        
        
        
        <?php } else{?>



          <h2>DATOS DE ENVÍO</h2>
       <hr>   

              <?php 
              $sentencia=$pdo->prepare("SELECT * FROM USUARIO_DIRECCION WHERE ID_USUARIO_DIRECCION=:DIR");
              $sentencia->bindParam(':DIR', $datos_envio[0]['DIR']);
              $sentencia->execute();
              $Dir_envio=$sentencia->fetchAll(PDO::FETCH_ASSOC);
              ?>
              
              <label for=""style="text-aling:center;" ><?php echo  $Dir_envio[0]['DIRECCION'].' #'.$Dir_envio[0]['NUMERO'].' '.$Dir_envio[0]['CP']?></label><br>
              <label for=""style="text-aling:center;" >Recibe: <?php echo  $datos_envio[0]['DESTINATARIO']?></label><br>
              <label for="" style="text-aling:center;">Tel. Contacto: <?php echo  $datos_envio[0]['NUM_CONTACTO']?></label><br>


              <div class="Carrito">
                        <h2>CARRITO DE COMPRAS</h2>
                            <table >
                                <th>Producto</th>
                                <th>Precio x unidad</th>
                                <th>Cantidad</th>
                               <?php foreach($_SESSION['Carrito'] as $itemCarrito){ ?>
                            <tr id=" <?php echo $i?>">
                            
                               <td><?php echo $itemCarrito['NOMBRE']?></td> 
                               <td><?php echo '$ '.$itemCarrito['PRECIO'].' MXN'?></td>
                               <td><?php echo (int)$itemCarrito['CANTIDAD']?></td>
                               
                            </tr>
                              
	                            
                    
               <?php $i++; } 
               foreach($_SESSION['Carrito'] as  $indice=>$producto)  {
                (double) $TEMP=(double)$_SESSION['Carrito'][$indice]['PRECIO']*(int)$_SESSION['Carrito'][$indice]['CANTIDAD'];
                  $TOTAL= $TOTAL + (double)$TEMP;
                  $_SESSION['total']=$TOTAL;
         }?>
                <tr>
                  <td><b>COSTO DE ENVÍO</b></td>
                  <td><?php echo '$ '.$datos_envio[0]['COSTO_ENVIO'].' MXN';?></td>
                </tr>
               <td id="total"><?php echo 'TOTAL: $'.$TOTAL ?></td>
               
               

                </table>
                
                             </div>
             <!-- FIN DE CARRITO --> 
      <?php }
    } ?>
       
    </div>
    <div class="Pago">

          <?php if($confirm>=1 && $pago==1){?>


              <h2>Pagar con paypal  $<?php echo $total.' MXN'; ?></h2>

    
                <div class="btnpaypal" >

          <?php 
         if($confirm==1 || $confirm==2){ 
    
                   ?>
        
                    <div class="msj_confirm"><p>Esperando confirmación... </p></div>
                    <?php if($confirm==2){ ?>
                    <div class="btn_container"><a href="#" id="btn_confirm" onclick="confirmar(1)">CONFIRMAR COMPRA</a></div>

                  <?php }
              }elseif($confirm==3){
                   echo '<div id="paypal-button-container"></div>';
              }

          ?>
         

        </div>


      </div>
            
        <?php  }?>
        <?php if($confirm>=1 && $pago==2){?>
          <h2>Monto a depositar  $<?php echo $total.' MXN'; ?></h2>
          <?php 
         if($confirm==1 || $confirm==2){ 
    
                   ?>
                    <div class="btnpaypal"> 
                      <div class="msj_confirm"><p>Esperando confirmación... </p></div>
                  
                      <?php if($confirm==2){ ?>
                    <div class="btn_container"><a href="#" id="btn_confirm" onclick="confirmar(1)">CONFIRMAR COMPRA</a></div>

                  </div>
                  
                  <?php }
               }elseif($confirm==3){
                  
                  
                  
                  ?>
                   <p>No Cuenta: 4152 3134 3487 3035</p>
                  <p>BBVA Bancomer</p>
                      <form action="validar_deposito.php" method="post">
                        <input type="hidden" id="total" name="total" value="<?php echo openssl_encrypt($total,COD,KEY)?>">
                        
                        <button id="btn_confirm">Generar Pedido</button>

                      </form>
                 
                 
                  
          <?php 
                 } 
               } ?>






    </div>
    
               
    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AR456NbW_u3nBISmNZGtCkuYnVEAvtb-YRB1hCKT4X4D29nkpn9vIMjtdxiPtrHTnmRQjaizab4FhUIV&currency=MXN"></script>

    <script>
  paypal.Buttons({
    style: {
                layout: 'horizontal'
            },
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '<?php echo $total?>'
          },reference_id: "<?php echo $SID;?>"
        }]
      });
    },
    onApprove: function(data, actions) {
      // Capture the funds from the transaction
      return actions.order.capture().then(function(details) {
        // Show a success message to your buyer
        
        window.location="verificar_pago.php?Orderid="+data.orderID;
      });
    }
  }).render('#paypal-button-container');
</script>

<script>



function borrardir() {
  var value="";
  $.each($('#datos_envio input[type=radio]:checked'), function() {
    $('#dir_nueva').val(value);
  });
  
}

$(document).ready(function() {
  $('#datos_envio input[type=radio]').change(borrardir);
  //_____________________________^^^^^^^_^^^^^^^^^^^
  //Use change event instead of click, handler can be attached this way
});
</script>

<script>

$(document).ready(function(){
    $('#myForm input[type="text"]').blur(function(){
        if(!$(this).val()){
            $(this).addClass("error");
        } else{
            $(this).removeClass("error");
        }
    });
});
</script>

<script>    

$(document).ready(function(){

 

    if($('#dir_2:checked').length){
        $('#dir_nueva').attr('readonly',false); // On Load, should it be read only?
    }
    if($('#dir_1:checked').length){
        $('#dir_nueva').attr('readonly',true); // On Load, should it be read only?
    }



    $('#dir_2').change(function(){
        if($('#dir_2:checked').length){
            $('#dir_nueva').attr('readonly',false); //If checked - Read only
        }else{
            $('#dir_nueva').attr('readonly',true);//Not Checked - Normal
        }
    });


    $('#dir_1').change(function(){
        if($('#dir_1:checked').length){
            $('#dir_nueva').attr('readonly',true); //If checked - Read only
        }else{
            $('#dir_nueva').attr('readonly',false);//Not Checked - Normal
        }
    });
});

    
    
    
    
    </script>

    <script>
        $( document ).ready(function() {
  $('.trigger').click(function() {
     $('.modal-wrapper').toggleClass('open');
    $('.page-wrapper').toggleClass('blur');
     return false;
  });
});
    </script>

 
    <script type="text/javascript">
	$(document).ready(function(){
	
		$("#Estado_n").change(function(){
			$.get("get_cities.php","Estado_n="+$("#Estado_n").val(), function(data){
				$("#municipio_n").html(data);
				console.log(data);
			});
    });
    
    $("#municipio_n").change(function(){
			$.get("get_region.php","municipio_n="+$("#municipio_n").val(), function(data){
				$("#region_n").html(data);
				console.log(data);
			});
		});

    $("#dir").change(function(){
			$.get("get_envio.php","dir="+$("#dir").val(), function(data){
				$("#costo_envio").val(data);
				console.log(data);
			});
		});
	});
</script>
    <script>
    function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

console.log(makeid(17));
    
    </script>
   <script>



$(document).ready(function(){
    $('#calendar').datepicker({
        minDate: +3
    });
});


</script>


<script>

$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#calendar").datepicker();
});

</script>
</body>
    