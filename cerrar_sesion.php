<?php
session_start(); 
session_unset();
session_destroy();
echo "Sesión cerrada con éxito";
header("location: login.php");
?>
