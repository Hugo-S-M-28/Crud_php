<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD en PHP y MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1b11f5a77a.js" crossorigin="anonymous"></script>
</head>
<body>
    <script>
        function eliminar() {
            var respuesta = confirm("¿Estás seguro que deseas eliminar?");
            return respuesta;
        }
    </script>

    <h1 class="text-center p-3">Registro de Empleados del GYM</h1>
    
    <?php
    include "../modelo/conexion.php";
    include "../controlador/eliminar_empleado.php";
    include "../controlador/registro_empleado.php";
    ?>

    <div class="container-fluid row">
        <form class="col-4 p-3" method="POST">
            <h3 class="text-center text-secondary">Registro de Empleado</h3>
            <div class="mb-3">
                <label for="id" class="form-label">ID del empleado</label>
                <input type="number" class="form-control" name="id" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del empleado</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido del empleado</label>
                <input type="text" class="form-control" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de nacimiento del empleado</label>
                <input type="date" class="form-control" name="fecha" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btnguardar" value="ok">Guardar</button>
        </form>

        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../modelo/conexion.php";
                    $sql = $conexion->query("SELECT * FROM empleado");
                    while ($datos = $sql->fetch_object()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($datos->idempleado); ?></td>
                        <td><?php echo htmlspecialchars($datos->nombre); ?></td>
                        <td><?php echo htmlspecialchars($datos->apellido); ?></td>
                        <td><?php echo htmlspecialchars($datos->fechadenac); ?></td>
                        <td>
                            <a href="modificar_empleado.php?id=<?php echo $datos->idempleado; ?>" class="btn btn-small btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a onclick="return eliminar()" href="index.php?id=<?php echo $datos->idempleado; ?>" class="btn btn-small btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
