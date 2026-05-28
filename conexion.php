<?php
$conexion = new mysqli("localhost", "root", "", "minimercado");

if ($conexion->connect_error) {
    die("Error de conexión");
}
?>