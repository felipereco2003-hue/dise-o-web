<?php
$servidor = "localhost";
$usuariobd = "root";
$clave = "";
$basededatos = "hospital";

$conexion = new mysqli($servidor, $usuariobd, $clave, $basededatos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>