function enviar(produc){
    var id=document.getElementById(produc+'-id').value;
    var nombre=document.getElementById(produc+'-nombre').value;
    var precio=document.getElementById(produc+'-precio').value;
    var cantidad=document.getElementById(produc+'-cantidad').value;
    var producto=document.getElementById(produc+'-producto').value;
    
    event.preventDefault()
    var dataen ='id='+encodeURIComponent(id)+'&nombre='+encodeURIComponent(nombre)+'&precio='+encodeURIComponent(precio)+'&cantidad='+encodeURIComponent(cantidad)+'&producto='+encodeURIComponent(producto);
    
    $.ajax({
        type:'post',
        url:'send.php',
        data:dataen,
        success:function(resp){
            $("#respa").html(resp);
            $('#popup').fadeIn('slow');
            $('.popup-overlay').fadeIn('slow');
            $('.popup-overlay').height($(window).height());
        }
    });
    return false;
}



function confirmar(){
       
        var entrega=document.getElementById('entrega').value;
        var horario=document.getElementById('horario').value;
        var destinatario=document.getElementById('destinatario').value;
        var num_contacto=document.getElementById('num_contacto').value;
        var msj=document.getElementById('msj').value;
        var fecha=document.getElementById('calendar').value;
        if(entrega==1){
            var envio=document.getElementById('costo_envio').value;
            var dir=document.getElementById('dir').value;          
            var dataen ='&dir='+dir+'&destinatario='+destinatario+'&num_contacto='+num_contacto+'&costo_envio='+envio+'&entrega='+entrega+'&msj='+msj+'&calendar='+fecha+'&horario='+horario;

        }else{
            var dataen ='&dir='+dir+'&destinatario='+destinatario+'&num_contacto='+num_contacto+'&entrega='+entrega+'&msj='+msj+'&calendar='+fecha+'&horario='+horario;

        }
if(destinatario=='' || num_contacto==''){
    alert('llena todos los campos')
}else{ 
    event.preventDefault()
location.reload(true);
  
$.ajax({
    type:'post',
    url:'send_confirm.php',
    data:dataen,
    success:function(resp){
        $("#respa").html(resp);
    }
});
return false;
}
     
}


function Direccion(){
    var Dir = document.getElementById('direccion_n').value;
    var Col = document.getElementById('colonia').value;
    var CP = document.getElementById('CP_n').value;
    var Num_ext = document.getElementById('num_ext_n').value;
    var Estado = document.getElementById('Estado_n').value;
    var Municipio = document.getElementById('municipio_n').value;
    var ref = document.getElementById('ref_n').value;
    var region = document.getElementById('region_n').value;


    if(Dir=='' || CP=='' || Num_ext=='' || Estado=='' || Municipio=='' || ref=='' || Col==''){
        alert('Rellena todos los campos');
    }else{
        event.preventDefault();
        var dataen ='direccion_n='+Dir+'&CP_n='+CP+'&num_ext_n='+Num_ext+'&colonia='+Col+'&Estado_n='+Estado+'&municipio_n='+Municipio+'&ref_n='+ref+'&region_n='+region;
 location.reload(true);
      
    $.ajax({
        type:'post',
        url:'add_dir.php',
        data:dataen,
        success:function(resp){
            alert(Dir+' '+CP+' '+Num_ext+' '+Estado+' '+Municipio+' '+ref);
        }
    });
    return false;
    }

}

function venta(){
    var anio=document.getElementById('anio').value;
    var mes=document.getElementById('mes').value;
    event.preventDefault()
    var dataen= 'anio='+anio+'&mes='+mes;

    $.ajax({
        type:'post',
        url:'tabla.php',
        data:dataen,
        success:function(resp){
            $("#tabla_venta").html(resp);
            
        }
    });
    return false;
}

function delivery(){
    
           var deliver = document.getElementById('delivery').value;
           var personal = document.getElementById('personal').value;

           event.preventDefault()
           var dataen = 'delivery='+deliver+'&personal='+personal;
           location.reload(true);
            $.ajax({
        type:'post',
        url:'confirm_delivery.php',
        data:dataen
    });
    return false;
        }
   
function delivery2(){
    
    var deliver = document.getElementById('delivery2').value;
    var personal = document.getElementById('personal2').value;

    event.preventDefault()
    var dataen = 'delivery='+deliver+'&personal='+personal;
    location.reload(true);
     $.ajax({
 type:'post',
 url:'confirm_delivery.php',
 data:dataen
});
return false;
 }

function estadopaypal(){
    var orden = document.getElementById('id_orden').value;
    var venta = document.getElementById('id_venta').value;
    event.preventDefault()
    var dataen ='id_orden='+orden+'&id_venta='+venta;
    
    location.reload(true);
    $.ajax({
        type:'post',
        url:'update_statusPaypal.php',
        data:dataen
       
       });
       return false;
}

function estadoenvio(){
    var orden = document.getElementById('id_orden').value;
    var venta = document.getElementById('id_venta').value;
    event.preventDefault()
    var dataen ='id_orden='+orden+'&id_venta='+venta;
    
    location.reload(true);
    $.ajax({
        type:'post',
        url:'update_statusPaypal.php',
        data:dataen
       
       });
       return false;
}

function updateEnvio(){
            var estado = document.getElementById('est_envio').value;
            var id = document.getElementById('id_envio').value;
            event.preventDefault()
            var dataen ='est_envio='+estado+'&id_envio='+id;
            
    location.reload(true);
    $.ajax({
        type:'post',
        url:'update_envio.php',
        data:dataen
       
       });
       return false;
}

function ver_compras(){

    var opcion = 1;
    event.preventDefault()
    var dataen='opcion='+opcion
    //location.reload(true);
    $.ajax({
        type:'post',
        url:'ver_opcion.php',
        data:dataen,
        success:function(resp){
            $("#container").html(resp);
        }
       
       });

}


function ver_datos(){

    var opcion = 2;
    event.preventDefault()
    var dataen='opcion='+opcion
    //location.reload(true);
    $.ajax({
        type:'post',
        url:'ver_opcion.php',
        data:dataen,
        success:function(resp){
            $("#container").html(resp);
        }
       
       });

}

function metodo_pago(){
            var pago = document.getElementById('pago1').value;

           event.preventDefault()
           var dataen = 'pago='+pago;
           location.reload(true);
            $.ajax({
        type:'post',
        url:'confirm_metodopago.php',
        data:dataen
    });
    return false;
}

function metodo_pago2(){
    var pago = document.getElementById('pago2').value;

   event.preventDefault()
   var dataen = 'pago='+pago;
   location.reload(true);
    $.ajax({
type:'post',
url:'confirm_metodopago.php',
data:dataen
});
return false;
}

function estadodeposito(){
    var venta = document.getElementById('id_venta').value;

    event.preventDefault()
    var dataen ='id_venta='+venta;
    location.reload(true);
    $.ajax({
    type:'post',
    url:'confirm_deposito.php',
    data:dataen
    });
    return false;
}

function Cambiar_pass(){
    var pass = document.getElementById('pass').value;
    var pass2 = document.getElementById('pass2').value;
    event.preventDefault()
if(pass!=pass2){
    alert('Las contraseñas no coinciden');
}else{
    var dataen ='pass='+pass+'&pass2='+pass2;
    location.reload(true);
    $.ajax({
    type:'post',
    url:'cambiar_pass.php',
    data:dataen,
    success:function(resp){
        $("#container").html(resp);
    }
    });
    return false;
}


}

function cancelar_compra(){
    var orden = document.getElementById('id_orden').value;
    var venta = document.getElementById('id_venta').value;
    event.preventDefault()
    var dataen ='id_orden='+orden+'&id_venta='+venta;
    
    location.reload(true);
    $.ajax({
        type:'post',
        url:'cancelar_compra.php',
        data:dataen
       
       });
       return false;
}