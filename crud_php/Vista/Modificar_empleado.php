<?php
include "../modelo/conexion.php"; // Ruta correcta a conexion.php

// Verificar si 'id' está definido en $_GET y es un número entero
if (!isset($_GET["id"]) || !ctype_digit($_GET["id"])) {
    echo "<div class='alert alert-danger' role='alert'>ID no proporcionado o inválido.</div>";
    exit;
}

$id = intval($_GET["id"]);  // Convertir id a entero

// Preparar la consulta para obtener los datos del empleado
$stmt = $conexion->prepare("SELECT * FROM empleado WHERE idempleado = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$datos = $result->fetch_object();
$stmt->close();

if (!$datos) {
    echo "<div class='alert alert-danger' role='alert'>Empleado no encontrado.</div>";
    exit;
}

if (isset($_POST['btnguardar'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha = $_POST['fecha'];
    $fechaTexto = $_POST['fecha_texto'];  // Valor ingresado como texto (si existe)

    // Verificar si se proporcionó la fecha de registro como fecha o como texto
    $fechaFinal = !empty($fecha) ? $fecha : $fechaTexto;

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($apellido) || empty($fechaFinal)) {
        echo "<div class='alert alert-danger' role='alert'>Todos los campos son obligatorios.</div>";
    } else {
        // Preparar la consulta para actualizar los datos del empleado
        $stmt = $conexion->prepare("UPDATE empleado SET nombre = ?, apellido = ?, fecharegistro = ? WHERE idempleado = ?");
        $stmt->bind_param("sssi", $nombre, $apellido, $fechaFinal, $id);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success' role='alert'>Empleado modificado con éxito.</div>";
            // Redirigir para evitar reenvío del formulario
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error al modificar los datos del empleado.</div>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form class="col-4 p-3 m-auto" method="POST">
        <h3 class="text-center alert alert-secondary">Modificar Empleado</h3>
        <input type="hidden" name="id" value="<?= $id ?>">
        
        <div class="mb-3">
            <label for="idempleado" class="form-label">ID</label>
            <input type="text" class="form-control" name="idempleado" value="<?= htmlspecialchars($datos->idempleado) ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del empleado</label>
            <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($datos->nombre) ?>">
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido del empleado</label>
            <input type="text" class="form-control" name="apellido" value="<?= htmlspecialchars($datos->apellido) ?>">
        </div>
        
        <!-- Campo para la Fecha -->
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de registro del empleado</label>
            <input type="date" class="form-control" name="fecha" value="<?= htmlspecialchars($datos->fecharegistro) ?>">
        </div>

        <button type="submit" class="btn btn-primary" name="btnguardar" value="ok">Modificar Empleado</button>
        <a href="index.php" class="btn btn-secondary">Regresar</a> <!-- Botón para regresar -->
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
