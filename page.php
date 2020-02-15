

<script src="JS/jquery.min.js"></script>
<div id="yourPopup" style="padding:0; margin:0; display:none;">

</div>

<script>
function showyourPopup() {
    $("#yourPopup").dialog({
        autoOpen: true,
        resizable: false,
        height: 'auto',
        width: 'auto',
        modal: true,
        //show: { effect: "puff", duration: 300 }, 
        draggable: true
    });

    $(".ui-widget-header").css({"display":"none"}); 
}

function closeyourPopup() { $("#yourPopup").dialog('close'); }

/* Submit Resources Popup */

function submitResources(id){   

    $("#yourPopup").dialog('open');

    $.ajax({
        url:'your_page.php',
        data:'act=loadResourcesFrm&id='+id,
        type:'POST',
        error:function(){},
        success:function(data){ 
            $('#yourPopup').html(data); 
            showyourPopup();
        }
    });
}
</script>
