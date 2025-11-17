<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="stylesheet" href="Css/decoracion.css">
</head>
<body>
   <a class="boton1" href="registrarse.php">registrarse</a>
   
</body>
</html>
<?php
session_start();
require_once "mysql/conexion.php";

$error = "";

if(isset($_POST["iniciar"])){

    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT id, contrasena FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($resultado->num_rows > 0){

        $fila = $resultado->fetch_assoc();

        if(password_verify($contrasena, $fila["contrasena"])){

            $_SESSION["usuario"] = $fila["id"];
            header("Location: index.php");
            exit();

        } else {
            $error = "Contraseña incorrecta";
        }

    } else {
        $error = "Correo no encontrado";
    }
}
?>

<form method="post">
    <input type="email" name="correo" placeholder="Correo">
    <input type="password" name="contrasena" placeholder="Contraseña">
    <button type="submit" name="iniciar">Iniciar sesión</button>
</form>

<?php echo $error; ?>
