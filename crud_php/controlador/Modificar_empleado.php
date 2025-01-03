<?php
// controlador/modificar_empleado.php

// Incluir el archivo de conexión con una ruta relativa correcta
include "../modelo/conexion.php"; // Ajusta la ruta si es necesario

if (isset($_POST['btnguardar'])) {
    // Validar y sanear las entradas
    $id = intval($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $fecha = $_POST['fecha'];

    // Verificar que todos los campos necesarios estén presentes
    if (!empty($id) && !empty($nombre) && !empty($apellido) && !empty($fecha)) {
        // Preparar la consulta para actualizar los datos del empleado
        if ($stmt = $conexion->prepare("UPDATE empleado SET nombre = ?, apellido = ?, fecharegistro = ? WHERE idempleado = ?")) {
            $stmt->bind_param("sssi", $nombre, $apellido, $fecha, $id);
            $stmt->execute();
            
            // Verificar si la consulta afectó filas
            if ($stmt->affected_rows > 0) {
                // Redirigir a la página principal con mensaje de éxito
                header("Location: ../vista/index.php?mensaje=Empleado modificado correctamente.");
                exit(); // Asegurar que el código no continúe después de la redirección
            } else {
                echo "<div class='alert alert-warning'>No se realizaron cambios. Verifica que los datos sean correctos.</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Error al preparar la consulta: " . $conexion->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Por favor, completa todos los campos correctamente.</div>";
    }
}

// Cerrar la conexión
$conexion->close();
?>
