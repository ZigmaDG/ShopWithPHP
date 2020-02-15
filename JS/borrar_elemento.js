$(function () {

    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
        var id=this.id;

        location.reload();
        var dataen ='id='+id;
        $.ajax({
        type:'post',
        url:'Eliminar_producto.php',
        data:dataen,
        success:function(resp){
            $("#total").html(resp);
        }

        
    });
    return false;

});
});
