

$(function () {
    $(document).on('click', '.cant', function (event) {
        var id_input=($(this).closest('tr').find('input').attr('id'))
        var name_input=($(this).closest('tr').find('input').attr('name'))
        
    var cantidad=document.getElementById(id_input).value;
    location.reload(true);
        var dataen ='cantidad='+cantidad+'&id='+name_input;
        $.ajax({
        type:'post',
        url:'actualizar_cantidad.php',
        data:dataen,
        success:function(resp){
            $("#total").html(resp);
        }
    });
    return false;
    });
    
    });

    