<?php
// controlador/registro_empleado.php

// Incluir la conexión a la base de datos
include "../modelo/conexion.php";
include "../modelo/Empleado.php";

// Verificar que el formulario haya sido enviado
if (isset($_POST['btnguardar'])) {
    // Validar y sanear los datos del formulario
    $idempleado = isset($_POST['id']) ? intval($_POST['id']) : null;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : null;
    $fechadenac = isset($_POST['fecha']) ? $_POST['fecha'] : null;

    // Verificar que todos los campos necesarios estén presentes
    if ($idempleado !== null && !empty($nombre) && !empty($apellido) && !empty($fechadenac)) {
        try {
            // Crear una instancia de la clase Empleado
            $empleado = new Empleado($conexion);

            // Intentar crear el empleado
            $empleado->crear($idempleado, $nombre, $apellido, $fechadenac);
            echo '<div class="alert alert-success">Empleado registrado correctamente.</div>';
            
            // Redirigir para evitar el reenvío del formulario en el refresh
            header("Location: ../vista/index.php");
            exit();
        } catch (Exception $e) {
            // Mostrar error si el ID ya existe u otro problema
            echo '<div class="alert alert-danger">' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Por favor, completa todos los campos.</div>';
    }
}
?>
