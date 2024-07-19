<?php
// controlador/registro_empleado.php
if (isset($_POST['btnguardar'])) {
    include "modelo/Empleado.php";
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha = $_POST['fecha'];

    $empleado = new Empleado($conexion);
    $empleado->crear($id, $nombre, $apellido, $fecha);

    // Redirigir para evitar el reenvío del formulario en el refresh
    header("Location: index.php");
    exit();
}
?>
