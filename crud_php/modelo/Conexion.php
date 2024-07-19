<?php
// Modelo/conexion.php

// Configuración de la base de datos
$host = "localhost";
$user = "root";
$password = "Hugo";
$database = "crudphp";
$port = 3306; // Puerto opcional, MySQL usa 3306 por defecto

// Crear una conexión a la base de datos
$conexion = new mysqli($host, $user, $password, $database, $port);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configurar el conjunto de caracteres
$conexion->set_charset("utf8");
?>
