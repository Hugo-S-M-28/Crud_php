<?php
// controlador/eliminar_empleado.php

// Incluir la conexión a la base de datos
include "../modelo/conexion.php";

// Verificar que se haya enviado el ID y que sea un número entero válido
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir el ID a entero para evitar inyecciones

    // Preparar la consulta para eliminar el empleado
    $stmt = $conexion->prepare("DELETE FROM empleado WHERE idempleado = ?");
    
    if ($stmt) {
        $stmt->bind_param("i", $id); // Asociar el parámetro
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo '<div class="alert alert-success">Empleado eliminado correctamente.</div>';
        } else {
            echo '<div class="alert alert-warning">El empleado no fue encontrado o no se realizaron cambios.</div>';
        }

        $stmt->close();
    } else {
        echo '<div class="alert alert-danger">Error al preparar la consulta: ' . $conexion->error . '</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID no válido o no proporcionado.</div>';
}
?>
