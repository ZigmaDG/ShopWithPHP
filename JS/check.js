
$(document).ready(function(){

    if($('#s:checked').length){
        $('#name').attr('readonly',false); // On Load, should it be read only?
    }

    if($('#s1:checked').length){
        $('#desc').attr('readonly',false); // On Load, should it be read only?
    }
    if($('#s2:checked').length){
        $('#Precio').attr('readonly',false); // On Load, should it be read only?
    }
    if($('#s3:checked').length){
        $('#A_paterno').attr('readonly',false); // On Load, should it be read only?
    }
    if($('#s4:checked').length){
        $('#A_materno').attr('readonly',false); // On Load, should it be read only?
    }
    


    
    $('#s').change(function(){
        if($('#s:checked').length){
            $('#name').attr('readonly',false); //If checked - Read only
        }else{
            $('#name').attr('readonly',true);//Not Checked - Normal
        }
    });


    $('#s1').change(function(){
        if($('#s1:checked').length){
            $('#desc').attr('readonly',false); //If checked - Read only
        }else{
            $('#desc').attr('readonly',true);//Not Checked - Normal
        }
    });


$('#s2').change(function(){
        if($('#s2:checked').length){
            $('#Precio').attr('readonly',false); //If checked - Read only
        }else{
            $('#Precio').attr('readonly',true);//Not Checked - Normal
        }
    });


$('#s3').change(function(){
        if($('#s3:checked').length){
            $('#A_paterno').attr('readonly',false); //If checked - Read only
        }else{
            $('#A_paterno').attr('readonly',true);//Not Checked - Normal
        }
    });


$('#s4').change(function(){
        if($('#s4:checked').length){
            $('#A_materno').attr('readonly',false); //If checked - Read only
        }else{
            $('#A_materno').attr('readonly',true);//Not Checked - Normal
        }
    });


});
