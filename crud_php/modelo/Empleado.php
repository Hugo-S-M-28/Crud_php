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
        // Validación básica
        if (empty($nombre) || empty($apellido) || empty($fecha)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        if ($this->idExiste($id)) {
            throw new Exception('El ID de empleado ya está en uso.');
        }

        $sql = "INSERT INTO empleado (idempleado, nombre, apellido, fecharegistro) VALUES (?, ?, ?, ?)";
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
        // Validación básica
        if (empty($nombre) || empty($apellido) || empty($fecha)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        $sql = "UPDATE empleado SET nombre = ?, apellido = ?, fecharegistro = ? WHERE idempleado = ?";
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
        if (!is_numeric($id)) {
            throw new Exception("El ID del empleado no es válido.");
        }

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
        $sql = "SELECT * FROM empleado";
        $resultado = $this->conexion->query($sql);

        if ($resultado === false) {
            throw new Exception("Error al ejecutar la consulta: " . $this->conexion->error);
        }

        return $resultado;
    }
}
?>
