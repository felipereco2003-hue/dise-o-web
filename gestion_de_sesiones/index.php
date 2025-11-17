<?php
session_start();


if(!isset($_SESSION["usuario"])){
    header("Location: login.php");
    exit();
}

require_once "mysql/conexion.php";




$mensaje = "";

if(isset($_POST["guardar"])){

    
    $nombre = strtolower(trim($_POST["nombre"]));
    $correo = strtolower(trim($_POST["correo"]));

    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $contrasena);

    if($stmt->execute()){
        $mensaje = "Usuario registrado correctamente";
    } else {
        $mensaje = "Error: " . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediControl - Usuarios</title>
    <link rel="stylesheet" href="Css/decoracion.css">
</head>
<body>

<h1>Bienvenido, sesión activa</h1>
<a href="cerrar_sesion.php">Cerrar sesión</a>

<hr>

<?php if($mensaje != ""): ?>
    <p style="color: green;"><?php echo $mensaje; ?></p>
<?php endif; ?>

<h2>Registrar Usuario</h2>

<form method="post">

    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Correo:</label>
    <input type="email" name="correo" required>

    <label>Contraseña:</label>
    <input type="password" name="contrasena" required>

    <button type="submit" name="guardar">Registrar usuario</button>

</form>

</body>
</html>
