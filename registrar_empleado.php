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
    <link rel="stylesheet" href="css/estilos0.css"> 
</head>

<body>
    <center>    
        <h1>SISTEMA DE NOMINA</h1>
        <table class="menu">
            <tr>
                <td><a href="registrar_empleado.php">Registrar Usuario</a></td>
                
                <td><a href="lista_empleados.php">Listar Empleados</a></td>
                <td><a href="cerrar_sesion.php">Cerrar sesión</a></td>
                
            </tr>
        </table>

<br>
        <h3>Registrar Empleado</h3>
        <form action="insertar_registros_empleados.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nº Documento</td>
                    <td><input type="text" name="txtNdocumento"></td>
                </tr>
                <tr>
                    <td>Nombre 1</td>
                    <td><input type="text" name="txtNombre1"></td>
                </tr>
                <tr>
                    <td>Nombre 2</td>
                    <td><input type="text" name="txtNombre2"></td>
                </tr>
                <tr>
                    <td>Apellido 1</td>
                    <td><input type="text" name="txtApellido1"></td>
                </tr>
                <tr>
                    <td>Apellido 2</td>
                    <td><input type="text" name="txtApellido2"></td>
                </tr>
                <tr>
                    <td>Tipo Documento</td>
                    <td>
                        <select class="form_row" name="txtTipodoc" value="<?php if (isset($tipodocumento)) echo $tipodocumento; ?>">
                            <option>Tarjeta de Identidad</option>
                            <option>Cedula de Ciudadania</option>
                            <option>Cedula de Extranjeria</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Estado Civil</td>
                    <td>
                        <select class="form_row" name="txtEstadoCivil" value="<?php if (isset($estadocivil)) echo $estadocivil; ?>">
                            <option>Soltero/a</option>
                            <option>Casado/a</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Genero</td>
                    <td>
                        <select class="form_row" name="txtGenero" value="<?php if (isset($genero)) echo $genero; ?>">
                            <option>Masculino</option>
                            <option>Femenino</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td><input type="text" name="txtTelefono"></td>
                </tr>
                <tr>
                    <td>Fecha Nacimiento</td>
                    <td><input type="text" name="txtFechaNacimiento"></td>
                </tr>
                <tr>
                    <td>Fecha Expedicion</td>
                    <td><input type="text" name="txtFechaExpedicion"></td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td><input type="text" name="txtCorreo"></td>
                </tr>
                <tr>
                    <td>Nomenclatura</td>
                    <td><input type="text" name="txtNomenclatura"></td>
                </tr>
                <tr>
                    <td>Municipio</td>
                    <td><input type="text" name="txtMunicipio"></td>
                </tr>
                <tr>
                    <td>Barrio</td>
                    <td><input type="text" name="txtBarrio"></td>
                </tr>
                <tr>
                    <td>Contraseña</td>
                    <td>
                        <input type="password" name="password" placeholder="Contraseña" id="myPassword" required>
                        <?php
                        if (isset($_POST["create"])) {
                            $error_encontrado = "";
                            if (validar_clave($_POST["password"], $error_encontrado)) {
                                echo "<p style='color: green;'>CONTRASEÑA SEGURA</p>";

                                // Si la contraseña es segura, procede con el envío del formulario
                                // Puedes agregar aquí el código para procesar el formulario
                            } else {
                                echo "<p style='color: red;'>SU CONTRASEÑA ES INSEGURA: " . $error_encontrado . "</p>";
                            }
                        }
                        ?>
                    </td>
                </tr>
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
                <tr>
                    <td><input type="reset" name=""></td>
                    <td><input type="submit" name="create"></td>                               
                </tr>
                
            </table>
        </form>
        
    </center>
    
</body>
</html>
