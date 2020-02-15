<?php 

session_start();

include 'header.php';
include 'header2.php';
require_once 'conexion.php';

$Editar=$_GET['edit'];
if($_SESSION['rol']!=1)
{
    echo 'NO ESTAS AUTORIZADO';
    die();
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>EDITAR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="CSS/tabla.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  
  <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
  <br>
  <table class="table table-bordered table-striped" id="indextable">
    <thead>
    <?php 
      if($Editar==1){
        


        $sentencia=$pdo->prepare(" SELECT *FROM PRODUCTO INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.CATEGORIA=CATEGORIA_PRODUCTO.ID_CATEGORIA;");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <tr>
        <th><a href="javascript:SortTable(0, 'T');">NOMBRE</a></th>
        <th><a href="javascript:SortTable(1, 'T');">CATEGORÍA</a></th>
        <th><a href="javascript:SortTable(2, 'N');">PRECIO</a></th>
        <th>ACCIONES</th>
         </tr>
        </thead>
        <tbody id="myTable">
        <?php
        foreach($listaProductos as $producto){?>
          <tr style="<?php if($producto['ESTADO_PRODUCTO']==2){ echo 'background-color: #F67A7A'; }?>">
          <td><form name="formListado-fila-<?php echo $producto['ID_PRODUCTO']?>" action="Edit_producto.php" method="POST" style="display:none;"><input name="ID_PRODUCTO" type="hidden" value="<?php echo $producto['ID_PRODUCTO']?>" />
          </form><form name="formListado2-fila-<?php echo $producto['ID_PRODUCTO']?>" action="eliminar_producto_db.php" method="POST" style="display:none;"><input name="ID_PRODUCTO" type="hidden" value="<?php echo $producto['ID_PRODUCTO']?>" />
          </form><form name="formListado3-fila-<?php echo $producto['ID_PRODUCTO']?>" action="habilitar_producto.php" method="POST" style="display:none;"><input name="ID_PRODUCTO" type="hidden" value="<?php echo $producto['ID_PRODUCTO']?>" />
          </form><?php echo $producto['NOMBRE_PRODUCTO']?></td>
       
        <td><?php echo $producto['NOMBRE_CATEGORIA']?></td>
        <td><?php echo $producto['PRECIO_UNIDAD']?></td>
        <td><button style="background-color: #F28705; color:white; margin-right: 4px;"  onclick="enviar2(<?php echo $producto['ID_PRODUCTO']?>)">EDITAR</button>  
        <?php if($producto['ESTADO_PRODUCTO']==1){ echo '<button style="background-color: #F28705; color:white; margin-right: 4px;"  onclick="enviar3('.$producto['ID_PRODUCTO'].')">Eliminar</button>'; }
        else{   echo '<button style="background-color: #F28705; color:white; margin-right: 4px;"  onclick="enviar4('.$producto['ID_PRODUCTO'].')">Habilitar</button>';}?> </td>

      </tr>
        <?php }

      }
    
      if($Editar==2){
        
        $sentencia=$pdo->prepare(" SELECT *FROM CATEGORIA_PRODUCTO;");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <tr>
        <th><a href="javascript:SortTable(0, 'T');">NOMBRE</a></th>
        <th>ACCIONES</th>
         </tr>
        </thead>
        <tbody id="myTable">
       <?php
        foreach($listaProductos as $producto){?>
          <tr style="<?php if($producto['ESTADO_CAT']==2){ echo 'background-color: #F67A7A'; }?>">
        <td><form name="formListado-fila-<?php echo $producto['ID_CATEGORIA']?>" action="Edit_categoria.php" method="POST" style="display:none;"><input name="ID_CATEGORIA" type="hidden" value="<?php echo $producto['ID_CATEGORIA']?>" />
          </form><form name="formListado2-fila-<?php echo $producto['ID_CATEGORIA']?>" action="Eliminar_cat.php" method="POST" style="display:none;"><input name="ID_CATEGORIA" type="hidden" value="<?php echo $producto['ID_CATEGORIA']?>" />
          </form><form name="formListado3-fila-<?php echo $producto['ID_CATEGORIA']?>" action="habilitar_cat.php" method="POST" style="display:none;"><input name="ID_CATEGORIA" type="hidden" value="<?php echo $producto['ID_CATEGORIA']?>" />
          </form><?php echo $producto['NOMBRE_CATEGORIA']?></td>
        <td><button style="background-color: #F28705; color:white; margin-right: 4px;"  onclick="enviar2(<?php echo $producto['ID_CATEGORIA']?>)">EDITAR</button>  
        <?php if($producto['ESTADO_CAT']==1){ echo '<button style="background-color: #F28705; color:white; margin-right: 4px;"  onclick="enviar3('.$producto['ID_CATEGORIA'].')">Eliminar</button>'; }
        else{   echo '<button style="background-color: #F28705; color:white; margin-right: 4px;"  onclick="enviar4('.$producto['ID_CATEGORIA'].')">Habilitar</button>';}?> </td>
      </tr>
        <?php }
      }
    
   
    
    
    ?>
    
    </tbody>
  </table>
  
 
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
<script>
  function enviar3(id) {
    elForm= document.getElementsByName('formListado2-fila-'+id)[0];
    elForm.submit();
  }
  function enviar4(id) {
    elForm= document.getElementsByName('formListado3-fila-'+id)[0];
    elForm.submit();
  }
</script>


<script>
var TableIDvalue = "indextable";

//
//////////////////////////////////////
var TableLastSortedColumn = -1;
function SortTable() {
var sortColumn = parseInt(arguments[0]);
var type = arguments.length > 1 ? arguments[1] : 'T';
var dateformat = arguments.length > 2 ? arguments[2] : '';
var table = document.getElementById(TableIDvalue);
var tbody = table.getElementsByTagName("tbody")[0];
var rows = tbody.getElementsByTagName("tr");
var arrayOfRows = new Array();
type = type.toUpperCase();
dateformat = dateformat.toLowerCase();
for(var i=0, len=rows.length; i<len; i++) {
	arrayOfRows[i] = new Object;
	arrayOfRows[i].oldIndex = i;
	var celltext = rows[i].getElementsByTagName("td")[sortColumn].innerHTML.replace(/<[^>]*>/g,"");
	if( type=='D' ) { arrayOfRows[i].value = GetDateSortingKey(dateformat,celltext); }
	else {
		var re = type=="N" ? /[^\.\-\+\d]/g : /[^a-zA-Z0-9]/g;
		arrayOfRows[i].value = celltext.replace(re,"").substr(0,25).toLowerCase();
		}
	}
if (sortColumn == TableLastSortedColumn) { arrayOfRows.reverse(); }
else {
	TableLastSortedColumn = sortColumn;
	switch(type) {
		case "N" : arrayOfRows.sort(CompareRowOfNumbers); break;
		case "D" : arrayOfRows.sort(CompareRowOfNumbers); break;
		default  : arrayOfRows.sort(CompareRowOfText);
		}
	}
var newTableBody = document.createElement("tbody");
for(var i=0, len=arrayOfRows.length; i<len; i++) {
	newTableBody.appendChild(rows[arrayOfRows[i].oldIndex].cloneNode(true));
	}
table.replaceChild(newTableBody,tbody);
} // function SortTable()

function CompareRowOfText(a,b) {
var aval = a.value;
var bval = b.value;
return( aval == bval ? 0 : (aval > bval ? 1 : -1) );
} // function CompareRowOfText()

function CompareRowOfNumbers(a,b) {
var aval = /\d/.test(a.value) ? parseFloat(a.value) : 0;
var bval = /\d/.test(b.value) ? parseFloat(b.value) : 0;
return( aval == bval ? 0 : (aval > bval ? 1 : -1) );
} // function CompareRowOfNumbers()

function GetDateSortingKey(format,text) {
if( format.length < 1 ) { return ""; }
format = format.toLowerCase();
text = text.toLowerCase();
text = text.replace(/^[^a-z0-9]*/,"");
text = text.replace(/[^a-z0-9]*$/,"");
if( text.length < 1 ) { return ""; }
text = text.replace(/[^a-z0-9]+/g,",");
var date = text.split(",");
if( date.length < 3 ) { return ""; }
var d=0, m=0, y=0;
for( var i=0; i<3; i++ ) {
	var ts = format.substr(i,1);
	if( ts == "d" ) { d = date[i]; }
	else if( ts == "m" ) { m = date[i]; }
	else if( ts == "y" ) { y = date[i]; }
	}
d = d.replace(/^0/,"");
if( d < 10 ) { d = "0" + d; }
if( /[a-z]/.test(m) ) {
	m = m.substr(0,3);
	switch(m) {
		case "jan" : m = String(1); break;
		case "feb" : m = String(2); break;
		case "mar" : m = String(3); break;
		case "apr" : m = String(4); break;
		case "may" : m = String(5); break;
		case "jun" : m = String(6); break;
		case "jul" : m = String(7); break;
		case "aug" : m = String(8); break;
		case "sep" : m = String(9); break;
		case "oct" : m = String(10); break;
		case "nov" : m = String(11); break;
		case "dec" : m = String(12); break;
		default    : m = String(0);
		}
	}
m = m.replace(/^0/,"");
if( m < 10 ) { m = "0" + m; }
y = parseInt(y);
if( y < 100 ) { y = parseInt(y) + 2000; }
return "" + String(y) + "" + String(m) + "" + String(d) + "";
} // function GetDateSortingKey()
</script>
</body>
</html>