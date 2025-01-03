<?php
// controlador/registro_empleado.php
session_start(); // Iniciar sesión para manejar los mensajes

if (isset($_POST['btnguardar'])) {
    include "modelo/Empleado.php";
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha = $_POST['fecha'];

    // Validar que los campos no estén vacíos
    if (empty($id) || empty($nombre) || empty($apellido) || empty($fecha)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: index.php");
        exit();
    }

    // Crear objeto Empleado
    $empleado = new Empleado($conexion);

    try {
        // Intentar guardar el nuevo empleado
        $empleado->crear($id, $nombre, $apellido, $fecha);
        $_SESSION['success'] = "Empleado registrado con éxito.";
    } catch (Exception $e) {
        // Si hay un error, lo guardamos en la sesión
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }

    // Redirigir para evitar el reenvío del formulario en el refresh
    header("Location: index.php");
    exit();
}
?>
