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
    <link rel="stylesheet" href="css/estilo1.css">
    <title>Validacion de la Contraseña</title>
</head>

<body>
    <div class="loggin-box">
        <h1>Registrate Aqui</h1>
        <hr>
        <form id="myform" class="form-register" role="form" action="validacion_contraseña.php" method="POST" autocomplete="off">
            <div id="signupalert" style="display:none" class="alert alert-danger">
                <p>Error:</p>
                <span></span>
            </div>
            <div class="cont1">
                <div class="cont2">
                    <div class="divicion1">
                        <!-- NOMBRE -->
                        <div class="form-row">
                            <label for="FirstName">Nombre</label>
                            <input type="text" name="nombre" placeholder="Nombres" required>
                        </div>
                        <!-- APELLIDO -->
                        <div class="form-row">
                            <label for="Apellido">Apellido</label>
                            <input type="text" name="apellido" placeholder="Apellidos..." required>
                        </div>
                        <!-- TIPO DOCUMENTO -->
                        <div class="form-row">
                            <label id="tpDoc" for="tpDocumento">Tipo de Documento</label>
                            <select class="form_row" name="tpDocumento" value="<?php if (isset($tpDocumento)) echo $tpDocumento; ?>">
                                <option>Tarjeta de Identidad</option>
                                <option>Cedula de Ciudadania</option>
                                <option>Cedula de Extranjeria</option>
                                <option>Pasaporte</option>
                            </select>
                        </div>
                        <!-- # DOCUMENTO -->
                        <div class="form-row">
                            <label for="cedula">N. cedula</label>
                            <input type="text" name="cedula" placeholder="Numero de Cedula" required>
                        </div>
                        <!-- CORREO -->
                        <div class="form-row">
                            <label for="email">Correo</label>
                            <input type="email" name="email" placeholder="Correo Electronico" required>
                        </div>
                        <!-- CONTRASEÑA -->
                        <div class="form-row">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" placeholder="Contraseña" id="myPassword" required>
                        </div>
                        <!-- Mostrar mensaje de seguridad de contraseña -->
                        <?php
                        if (isset($_POST["registrar"])) {
                            $error_encontrado = "";
                            if (validar_clave($_POST["password"], $error_encontrado)) {
                                echo "<p style='color: green;'>CONTRASEÑA SEGURA</p>";
                            } else {
                                echo "<p style='color: red;'>SU CONTRASEÑA ES INSEGURA: " . $error_encontrado . "</p>";
                            }
                        }
                        ?>
                    </div>
                    <!-- # BOTON -->
                    <div class="form-row">
                        <input class="button" type="submit" name="registrar" value="Registrar">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function ($) {
            $('#myPassword').strength({
                strengthClass: 'strength',
                strengthMeterClass: 'strength_meter',
                strengthButtonClass: 'button_strength',
                strengthButtonText: 'Mostrar Contraseña',
                strengthButtonTextToggle: 'Ocultar Contraseña'
            });
        });
    </script>
</body>

</html>

<?php
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
    if (!preg_match('"[a-z]"', $clave)) {
        $error_clave = "La contraseña debe tener al menos una letra minúscula";
        return false;
    }
    if (!preg_match('"[A-Z]"', $clave)) {
        $error_clave = "La contraseña debe tener al menos una letra mayúscula";
        return false;
    }
    if (!preg_match('"[0-9]"', $clave)) {
        $error_clave = "La contraseña debe tener al menos un carácter numérico";
        return false;
    }

    $error_clave = "";
    return true;
}
?>