<?php
class Insumo {
    private $connect;
    private $table = "insumos";
    
    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $unidad_medida;

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
        $query = "INSERT INTO $this->table (nombre, descripcion, precio, unidad_medida) VALUES (:nombre, :descripcion, :precio, :unidad_medida)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':precio', $this->precio, PDO::PARAM_STR);
        $stmt->bindParam(':unidad_medida', $this->unidad_medida, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $this->connect->lastInsertId();
        } else {
            $error = $stmt->errorInfo();
            die("Error al crear insumo: " . $error[2]);
        }
    }

    public function update() {
        $query = "UPDATE $this->table SET nombre = :nombre, descripcion = :descripcion, precio = :precio, unidad_medida = :unidad_medida WHERE id = :id";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':precio', $this->precio, PDO::PARAM_STR);
        $stmt->bindParam(':unidad_medida', $this->unidad_medida, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            die("Error al actualizar insumo: " . $error[2]);
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
            die("Error al eliminar insumo: " . $error[2]);
        }
    }
}
?>