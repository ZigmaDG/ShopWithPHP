<?php 
session_start();
if(isset($_SESSION['log-on'])){
  header("location:index.php");
}?>

<link rel="stylesheet" href="CSS/login.css" >


<div class="login">
  <form action="recuperar.php" method="post">
    <h1>Tienda<span>.</span>En <span>Linea</span></h1>
    <!-- <label for="username">Username:</label> -->
    <input type="text" id="username" name="username" placeholder="correo" required>
    <!-- <label for="password">Password:</label> -->
    <button type="submit">Recuperar</button>
  </form>
  
</div>
