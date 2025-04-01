<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$database = "cotemag";

$conexion = mysqli_connect($servidor, $usuario, $password, $database);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>