<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrarse</title>
    <link rel="stylesheet" href="Css/decoracion.css">
</head>
<body>
    <a class="boton1" href="login.php">iniciar sesión</a>
    
</body>
</html>
<?php
require_once "mysql/conexion.php";

if(isset($_POST["registrar"])){

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $contrasena);

    if($stmt->execute()){
        echo "Registro exitoso. ";
    } else {
        echo "Error al registrar: " . $conexion->error;
    }
}
?>

<form method="post">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <button type="submit" name="registrar">Registrar</button>
</form>
