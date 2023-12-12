
<?php

function validarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function actualizarEmpleado($conn, $ndocumento, $nombre1, $nombre2, $apellido1, $apellido2, $tipo_documento, $estado_civil, $genero, $telefono, $fecha_nacimiento, $fecha_expedicion, $correo, $nomenclatura, $municipio, $barrio) {
    
    $sql = "UPDATE empleado SET 
        nombre1='$nombre1', 
        nombre2='$nombre2',
        apellido1='$apellido1',
        apellido2='$apellido2',
        tipo_documento='$tipo_documento',
        estado_civil='$estado_civil',
        genero='$genero',
        telefono='$telefono',
        fecha_nacimiento='$fecha_nacimiento',
        fecha_expedicion='$fecha_expedicion',
        correo='$correo',
        nomenclatura='$nomenclatura',
        municipio='$municipio',
        barrio='$barrio'
        WHERE ndocumento='$ndocumento'";


    if ($conn->query($sql) === TRUE) {
        return true;
            
    } else {
        echo "Error al actualizar el empleado: " . $conn->error;
        return false;
    }
}


?>

