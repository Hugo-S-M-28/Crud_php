<?php
// modelo/Empleado.php
class Empleado {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Verifica si un empleado con el mismo ID ya existe
    private function idExiste($id) {
        $sql = "SELECT 1 FROM empleado WHERE idempleado = ?";
        $stmt = $this->conexion->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();

        return $exists;
    }

    // Crea un nuevo empleado si el ID no existe
    public function crear($id, $nombre, $apellido, $fecha) {
        if ($this->idExiste($id)) {
            throw new Exception('El ID de empleado ya está en uso.');
        }

        $sql = "INSERT INTO empleado (idempleado, nombre, apellido, fechadenac) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
        }

        $stmt->bind_param("isss", $id, $nombre, $apellido, $fecha);
        $stmt->execute();
        $stmt->close();
    }

    // Actualiza la información de un empleado
    public function actualizar($id, $nombre, $apellido, $fecha) {
        $sql = "UPDATE empleado SET nombre = ?, apellido = ?, fechadenac = ? WHERE idempleado = ?";
        $stmt = $this->conexion->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
        }

        $stmt->bind_param("sssi", $nombre, $apellido, $fecha, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Elimina un empleado por ID
    public function eliminar($id) {
        $sql = "DELETE FROM empleado WHERE idempleado = ?";
        $stmt = $this->conexion->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    // Obtiene todos los empleados
    public function obtenerTodos() {
        return $this->conexion->query("SELECT * FROM empleado");
    }
}
?>
