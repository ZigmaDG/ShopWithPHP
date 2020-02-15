<?php 
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';




?>

<style>

.warn {
    
    color: red;
    font-size:13px;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/Estilo_registro.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


  
  <title>Document</title>
</head>
<body>

<div class="form_registro">

<form class="form" method="post" action="registrar.php">
      <h1>Registro</h1>
      <div class="form-group">
        <input type="text" placeholder=" "  name="name" id="name" required>
        <label for="name">Nombre de usuario</label>
        <div class="error">
          <i class="fas fa-exclamation-circle"></i>
          ¡Error!
        </div>
      </div>

      


      <div class="form-group">
        <input type="text" placeholder=" "  name="N_tel" id="N_tel" required>
        <label for="N_tel">Número Telefónico</label>
        <div class="error">
          <i class="fas fa-exclamation-circle"></i>
          ¡Error!
        </div>
      </div>

      <div class="form-group">
        <input type="email" placeholder=" " name="email" id="email" required>
        <label for="email">Email</label>
        <div class="error">
          <i class="fas fa-exclamation-circle"></i>
        </div>
      </div>
      <div class="form-group">
      <span id="verifynote" class="warn hidden">Las contraseñas no coinciden</span>
        <input type="password" placeholder=" " name="password" id="password" required>
        <label for="password">Contraseña</label>
        <div class="error">
          <i class="fas fa-exclamation-circle"></i>
        </div>
      </div>
      <div class="form-group">
        <input type="password" placeholder=" " name="confirm" id="confirm" required>
        <label for="confirm">Confirmar</label>
        <div class="error">
          <i class="fas fa-exclamation-circle"></i>
        </div>
      </div>
      <label class="custom-control custom-checkbox">
        <a href="terminos_y_condiciones">  acepto los terminos y condiciones</a>
        <input type="checkbox" name="terminos" id="terminos"  class="custom-control-input">

      </label>
      <input type="submit" id="accept" class="hidden" value="Registrarme">
      
    </form>

</div>
</body>
<script type="text/javascript">

$(document).ready(function()    {
    $('#confirm').keyup(function()   {
        if( $(this).val() == $('#password').val()){
            $('#verifynote').addClass('hidden');
        } else{
                $('#verifynote').removeClass('hidden');
        }
                    });
    });
</script>

<script>
$('#terminos').change(function(){
    if($(this).is(":checked")) {
        $('#accept').removeClass('hidden');
    } else {
        $('#accept').addClass('hidden');
    }
});
</script>

</html>