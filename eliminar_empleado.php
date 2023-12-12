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
if (!isset($_GET['id'])) {
    exit();
}

$codigo = $_GET['id'];
include 'conexion.php';

$sentencia_prestamo = $bd->prepare("DELETE FROM empleado WHERE ndocumento = ?;");
$resultado_prestamo = $sentencia_prestamo->execute([$codigo]);

if ($resultado_prestamo === TRUE) {
    
    $sentencia_usuario = $bd->prepare("DELETE FROM empleado WHERE ndocumento = ?;");
    $resultado_usuario = $sentencia_usuario->execute([$codigo]);

    if ($resultado_usuario === TRUE) {
        header('Location: lista_empleados.php');
    } else {
        echo "Error al eliminar el empleado";
    }
} else {
    echo "Error al eliminar los registros relacionados en empleado";
}
?>