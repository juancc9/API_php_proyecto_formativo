<?php
class TipoActividad {
    private $connect;
    private $table = "Tipo_actividad";
    
    public $id;
    public $nombre;
    public $descripcion;
    public $duracion_estimada;
    public $frecuencia;

    public function __construct($connect) {
        $this->connect = $connect; 
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->connect->prepare($query); 
        if ($stmt->execute()) {
            return $stmt;
        } else {
            $error = $stmt->errorInfo(); 
            die("Error en la consulta: " . $error[2]); 
        }
    }

    public function getById($id) {
        $query = "SELECT * FROM $this->table WHERE id = :id LIMIT 1";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $error = $stmt->errorInfo();
            die("Error en la consulta: " . $error[2]);
        }
    }

    public function create() {
        $query = "INSERT INTO $this->table (nombre, descripcion, duracion_estimada, frecuencia) VALUES (:nombre, :descripcion, :duracion_estimada, :frecuencia)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':duracion_estimada', $this->duracion_estimada, PDO::PARAM_INT);
        $stmt->bindParam(':frecuencia', $this->frecuencia);

        if ($stmt->execute()) {
            return $this->connect->lastInsertId();
        } else {
            $error = $stmt->errorInfo();
            die("Error al crear tipo de actividad: " . $error[2]);
        }
    }

    public function update() {
        $query = "UPDATE $this->table SET nombre = :nombre, descripcion = :descripcion, duracion_estimada = :duracion_estimada, frecuencia = :frecuencia WHERE id = :id";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':duracion_estimada', $this->duracion_estimada, PDO::PARAM_INT);
        $stmt->bindParam(':frecuencia', $this->frecuencia);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            die("Error al actualizar tipo de actividad: " . $error[2]);
        }
    }

    public function delete() {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            die("Error al eliminar tipo de actividad: " . $error[2]);
        }
    }
}
?>
