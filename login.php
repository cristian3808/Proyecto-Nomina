<?php
    include_once "conexion.php";

    session_start();
    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
            case 1:
                header('location: administrador.php');
            break;

            case 2:
                header('location: lector.php');
            break;

            default:
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Database();
        $query = $db->connect()->prepare('SELECT * FROM login_usua WHERE username = :username AND password = :password');
        $query->execute(['username' => $username, 'password' => $password]);

        $row = $query->fetch(PDO::FETCH_NUM);
        if($row == true){
            
            $rol = $row[3];
            $_SESSION['rol'] = $rol;

            switch($_SESSION['rol']){
                case 1:
                    header('location: administrador.php');
                break;
    
                case 2:
                    header('location: lector.php');
                break;
    
                default:
            }
        }else{
            
            echo "El usuario o password son incorrectos";
        }

    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <title>Document</title>
</head>
<body>
    <form action="#" method="POST">
    <div class="form">  
      <h1 class="titulo">Acceso al sistema</h1>
        <div class="form_c">
        <label>Usuario:</label>
        <input type="email" name="username" required autofocus><br>
        </div>

        <div class="form_c">
        <label>password:</label>
        <input type="password" name="password" required>
        </div>
        <div class="boton">
        <input type="submit" name="enviar" value="Ingresar">
        </div>
        </form>
    </form>
</body>
</html>