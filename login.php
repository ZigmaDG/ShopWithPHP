<?php 
session_start();
if(isset($_SESSION['log-on'])){
  header("location:index.php");
}?>

<link rel="stylesheet" href="CSS/login.css" >


<div class="login">
  <form action="autentificar.php" method="post">
    <h1>Heart<span> </span>Gift</h1>
    <!-- <label for="username">Username:</label> -->
    <input type="text" id="username" name="username" placeholder="Correo" required>
    <!-- <label for="password">Password:</label> -->
    <input type="password" id="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Login</button>
    <div class="morestuff">
    <p><a href="recuperar_cuenta"> <b> olvidé mi contraseña</b></a></p>
    <p><a href="index"> <b>inicio</b> </a></p>
    <p><a href="Registro"> <b>crear cuenta</b> </a></p>
    <!-- <p><a href="#3">Create an account</a></p> -->
  </div>
  </form>
  
</div>
