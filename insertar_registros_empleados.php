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

// Función para validar la contraseña
function validar_clave($clave, &$error_clave)
{
    if (strlen($clave) < 6) {
        $error_clave = "La contraseña debe tener al menos 6 caracteres";
        return false;
    }
    if (strlen($clave) > 16) {
        $error_clave = "La contraseña no puede tener más de 16 caracteres";
        return false;
    }
    if (!preg_match('/[a-z]/', $clave)) {
        $error_clave = "La contraseña debe tener al menos una letra minúscula";
        return false;
    }
    if (!preg_match('/[A-Z]/', $clave)) {
        $error_clave = "La contraseña debe tener al menos una letra mayúscula";
        return false;
    }
    if (!preg_match('/[0-9]/', $clave)) {
        $error_clave = "La contraseña debe tener al menos un carácter numérico";
        return false;
    }

    $error_clave = "";
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    try {
        // Validar la contraseña antes de procesar el formulario
        $password = $_POST['password'];
        $error_encontrado = "";
        if (!validar_clave($password, $error_encontrado)) {
            echo "<p style='color: red;'>SU CONTRASEÑA ES INSEGURA: " . $error_encontrado . "</p>";
            // Puedes agregar aquí cualquier manejo adicional cuando la contraseña no cumple con los requisitos
        } else {
            // Continuar con el procesamiento del formulario si la contraseña es segura
            $ndocumento = $_POST['txtNdocumento'];
            $nombre1 = $_POST['txtNombre1'];
            $nombre2 = $_POST['txtNombre2'];
            $apellido1 = $_POST['txtApellido1'];
            $apellido2 = $_POST['txtApellido2'];
            $tipodocumento = $_POST['txtTipodoc'];
            $estadocivil = $_POST['txtEstadoCivil'];
            $genero = $_POST['txtGenero'];
            $telefono = $_POST['txtTelefono'];
            $fechanacimiento = $_POST['txtFechaNacimiento'];
            $fechaexpedicion = $_POST['txtFechaExpedicion'];
            $correo = $_POST['txtCorreo'];
            $nomenclatura = $_POST['txtNomenclatura'];
            $municipio = $_POST['txtMunicipio'];
            $barrio = $_POST['txtBarrio'];
            

            $sentencia = $bd->prepare("INSERT INTO empleado(ndocumento, nombre1, nombre2, apellido1, apellido2, 
                tipo_documento, estado_civil, genero, telefono, fecha_nacimiento, fecha_expedicion, correo, nomenclatura,
                municipio, barrio) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

            $resultado = $sentencia->execute([$ndocumento, $nombre1, $nombre2, $apellido1, $apellido2, $tipodocumento,
                $estadocivil, $genero, $telefono, $fechanacimiento, $fechaexpedicion, $correo, $nomenclatura, $municipio,
                $barrio]);

            if ($resultado) {
                header("Location: lista_empleados.php");
                exit();
            } else {
                echo "Hubo un error al insertar en la base de datos.";
            }
        }
    } catch (PDOException $e) {
        echo "Error de PDO: " . $e->getMessage();
    }
}
?>

