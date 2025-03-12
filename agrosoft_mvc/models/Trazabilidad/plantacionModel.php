<?php
class Plantacion {
    private $connect;
    private $table = "plantaciones";
    
    public $id;
    public $fk_cultivo;
    public $fk_bancal;

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

    public function getId($id) {
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
        $query = "INSERT INTO $this->table (fk_cultivo, fk_bancal) VALUES (:fk_cultivo, :fk_bancal)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':fk_cultivo', $this->fk_cultivo);
        $stmt->bindParam(':fk_bancal', $this->fk_bancal);

        if ($stmt->execute()) {
            return $this->connect->lastInsertId();
        } else {
            $error = $stmt->errorInfo();
            die("Error al crear plantación: " . $error[2]);
        }
    }

    public function update() {
        $query = "UPDATE $this->table SET fk_cultivo = :fk_cultivo, fk_bancal = :fk_bancal WHERE id = :id";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':fk_cultivo', $this->fk_cultivo);
        $stmt->bindParam(':fk_bancal', $this->fk_bancal);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            die("Error al actualizar plantación: " . $error[2]);
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
            die("Error al eliminar plantación: " . $error[2]);
        }
    }
}
?>
