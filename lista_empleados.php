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
<?php
include 'conexion.php';

// Establecer la conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "bdnn");

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consulta para seleccionar todos los registros de empleado con detalles
$sql = "SELECT a.ndocumento, a.nombre1, a.nombre2, a.apellido1, a.apellido2, a.tipo_documento,
        a.estado_civil, a.genero, a.telefono, a.fecha_nacimiento, a.fecha_expedicion, a.correo,
        a.nomenclatura, a.municipio, a.barrio FROM empleado a";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos3.css?ver=1.0">
</head>
<body>
    <center>
        <h1>SISTEMA DE NOMINA</h1>
        <table class="menu">
            <tr>
                <td><a href="registrar_empleado.php">Registrar Usuario</a></td>
                
            </tr>
        </table>
          
        <h3>Empleados Registrados</h3>
        
        <!-- Tabla para mostrar los usuarios -->
        <table>
            <tr>
                <td>N° Documento</td>
                <td>Primer Nombre</td>
                <td>Segundo Nombre</td>
                <td>Primer Apellido</td>
                <td>Segundo Apellido</td>
                <td>Tipo Documento</td>
                <td>Estado Civil</td>
                <td>Genero</td>
                <td>Telefono</td>
                <td>Fecha Nacimiento</td>
                <td>Fecha Expedicion</td>
                <td>Correo</td>
                <td>Nomenclatura</td>
                <td>Municipio</td>
                <td>Acciones</td> 
            </tr>
            
            <?php
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ndocumento"] . "</td>";
                        echo "<td>" . $row["nombre1"] . "</td>";
                        echo "<td>" . $row["nombre2"] . "</td>";
                        echo "<td>" . $row["apellido1"] . "</td>";
                        echo "<td>" . $row["apellido2"] . "</td>";
                        echo "<td>" . $row["tipo_documento"] . "</td>";
                        echo "<td>" . $row["estado_civil"] . "</td>";
                        echo "<td>" . $row["genero"] . "</td>";
                        echo "<td>" . $row["telefono"] . "</td>";
                        echo "<td>" . $row["fecha_nacimiento"] . "</td>";
                        echo "<td>" . $row["fecha_expedicion"] . "</td>";
                        echo "<td>" . $row["correo"] . "</td>";
                        echo "<td>" . $row["nomenclatura"] . "</td>";
                        echo "<td>" . $row["municipio"] . "</td>";
                        echo "<td>" . $row["barrio"] . "</td>";
                        
                        echo "<td><a href='editar_empleado.php?id=" . $row['ndocumento'] . "'>Editar</a>  ";
                        echo "<br><a href='eliminar_empleado.php?id=" . $row['ndocumento'] . "'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='24'>No se encontraron registros</td></tr>";
                }
            } else {
                echo "Error en la consulta: " . $conn->error;
            }

            // Cerrar la conexión a la base de datos
            $conn->close();
            ?>
        </table>
        
        <form action="editar_empleado.php" method="POST" enctype="multipart/form-data">
        </form>
    </center>
    <br><br><br><br><br><br><br>
    <footer>
            <a href="cerrar_sesion.php">Cerrar sesión</a>
    </footer>
</body>
</html>

