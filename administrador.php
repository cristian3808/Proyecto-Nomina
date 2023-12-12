<?php
session_start();

if (!isset($_SESSION['rol'])) {
    header('location: login.php');
} else {
    if ($_SESSION['rol'] != 1) {
        header('location: login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos2.css"  
</head>
<body>
    <center>
    
    <h1>SISTEMA DE NOMINA</h1>  
        <table class="menu">
            <tr>
                <td><a href="registrar_empleado.php">Registrar Usuario</a></td>
                
                <td><a href="lista_empleados.php">Listar Empleados</a></td>
                

            </tr>
        </table>
        <br><br><br><br><br><br>
        <h1>BUEN DÍA ADMINISTRADOR</h1>
        
</body>
</html>