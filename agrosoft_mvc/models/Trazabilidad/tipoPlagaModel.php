<?php
class TipoPlaga {
    private $connect;
    private $table = "tipo_plaga";

    public $id;
    public $nombre;
    public $descripcion;
    public $img;

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
        $query = "INSERT INTO $this->table (nombre, descripcion, img) VALUES (:nombre, :descripcion, :img)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':img', $this->img);

        if ($stmt->execute()) {
            return $this->connect->lastInsertId();
        } else {
            $error = $stmt->errorInfo();
            die("Error al crear tipo de plaga: " . $error[2]);
        }
    }

    public function update() {
        $query = "UPDATE $this->table SET nombre = :nombre, descripcion = :descripcion, img = :img WHERE id = :id";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':img', $this->img);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            die("Error al actualizar tipo de plaga: " . $error[2]);
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
            die("Error al eliminar tipo de plaga: " . $error[2]);
        }
    }
}
?>
