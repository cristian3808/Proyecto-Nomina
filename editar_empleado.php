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
include 'funciones.php';

$conn = new mysqli("localhost", "root", "", "bdnn");

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los datos antes de actualizar
    $ndocumento = validarDatos($_POST["ndocumento"]);
    $nombre1 = validarDatos($_POST["nombre1"]);
    $nombre2 = validarDatos($_POST["nombre2"]);
    $apellido1 = validarDatos($_POST["apellido1"]);
    $apellido2 = validarDatos($_POST["apellido2"]);
    $tipo_documento = validarDatos($_POST["tipo_documento"]);
    $estado_civil = validarDatos($_POST["estado_civil"]);
    $genero = validarDatos($_POST["genero"]);
    $telefono = validarDatos($_POST["telefono"]);
    $fecha_nacimiento = validarDatos($_POST["fecha_nacimiento"]);
    $fecha_expedicion = validarDatos($_POST["fecha_expedicion"]);
    $correo = validarDatos($_POST["correo"]);
    $nomenclatura = validarDatos($_POST["nomenclatura"]);
    $municipio = validarDatos($_POST["municipio"]);
    $barrio = validarDatos($_POST["barrio"]);


    // Actualizar la información del empleado en la base de datos
    if (actualizarEmpleado($conn, $ndocumento, $nombre1, $nombre2, $apellido1, $apellido2, $tipo_documento, $estado_civil, $genero, $telefono, $fecha_nacimiento, $fecha_expedicion, $correo, $nomenclatura, $municipio, $barrio)) {
        echo "Empleado actualizado correctamente.";
                echo '<script>alert("Los datos del empleado fueron editados correctamente");</script>';
                echo '<script>window.location.href="lista_empleados.php";</script>';
        
    } else {
        echo "Error al actualizar el empleado.";
    }
}

// Obtener el ID del empleado de la URL
$id = $_GET['id'];

// Consulta para obtener los datos del empleado a editar
$sql = "SELECT * FROM empleado WHERE ndocumento = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Empleado no encontrado.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
    <center>
        <h1>Editar Empleado</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Número de Documento:</label>
            <input type="text" name="ndocumento" value="<?php echo $row["ndocumento"]; ?>" readonly>
            <br>
            <label>Nombre 1:</label>
            <input type="text" name="nombre1" value="<?php echo $row["nombre1"]; ?>">
            <br>
            <label>Nombre 2:</label>
            <input type="text" name="nombre2" value="<?php echo $row["nombre2"]; ?>">
            <br>
            <label>Apellido 1:</label>
            <input type="text" name="apellido1" value="<?php echo $row["apellido1"]; ?>">
            <br>
            <label>Apellido 2:</label>
            <input type="text" name="apellido2" value="<?php echo $row["apellido2"]; ?>">
            <br>
            <label>Tipo Documento:</label>
            <input type="text" name="tipo_documento" value="<?php echo $row["tipo_documento"]; ?>" >
            <br>
            <label>Estado civil:</label>
            <input type="text" name="estado_civil" value="<?php echo $row["estado_civil"]; ?>">
            <br>
            <label>genero:</label>
            <input type="text" name="genero" value="<?php echo $row["genero"]; ?>">
            <br>
            <label>telefono:</label>
            <input type="text" name="telefono" value="<?php echo $row["telefono"]; ?>">
            <br>
            <label>fecha_nacimiento:</label>
            <input type="text" name="fecha_nacimiento" value="<?php echo $row["fecha_nacimiento"]; ?>">
            <br>
            <label>fecha_expedicion:</label>
            <input type="text" name="fecha_expedicion" value="<?php echo $row["fecha_expedicion"]; ?>">
            <br>
            <label>correo:</label>
            <input type="email" name="correo" value="<?php echo $row["correo"]; ?>">
            <br>
            <label>nomenclatura:</label>
            <input type="text" name="nomenclatura" value="<?php echo $row["nomenclatura"]; ?>">
            <br>
            <label>municipio:</label>
            <input type="text" name="municipio" value="<?php echo $row["municipio"]; ?>">
            <br>
            <label>barrio:</label>
            <input type="text" name="barrio" value="<?php echo $row["barrio"]; ?>">
            <br>
            <br>
        
            <a href="lista_empleados.php" class="btn">Cancelar</a>
            <input type="submit" value="Actualizar">
            
        </form>

        <br><br>
       
    </center>
</body>
</html>