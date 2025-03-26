<?php
class Cosecha {
    private $connect;
    private $table = "Cosechas";
    
    public $id;
    public $fk_cultivo;
    public $unidades_medida;
    public $fecha;

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
        $query = "INSERT INTO $this->table (fk_cultivo, unidades_medida, fecha) 
                  VALUES (:fk_cultivo, :unidades_medida, :fecha)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':fk_cultivo', $this->fk_cultivo, PDO::PARAM_INT);
        $stmt->bindParam(':unidades_medida', $this->unidades_medida, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $this->fecha);

        if ($stmt->execute()) {
            return $this->connect->lastInsertId();
        } else {
            $error = $stmt->errorInfo();
            die("Error al registrar cosecha: " . $error[2]);
        }
    }

    public function update() {
        $query = "UPDATE $this->table 
                  SET fk_cultivo = :fk_cultivo, unidades_medida = :unidades_medida, fecha = :fecha 
                  WHERE id = :id";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':fk_cultivo', $this->fk_cultivo, PDO::PARAM_INT);
        $stmt->bindParam(':unidades_medida', $this->unidades_medida, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            die("Error al actualizar cosecha: " . $error[2]);
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
            die("Error al eliminar cosecha: " . $error[2]);
        }
    }
}
?>
