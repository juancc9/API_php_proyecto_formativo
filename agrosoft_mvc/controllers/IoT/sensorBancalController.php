<?php
require_once   './config/database.php';
require_once './models/IoT/sensorBancal.php';

class SensorBancalController {
    private $db;
    private $sensorBancal;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sensorBancal = new SensoresBancal($this->db);
    }

    public function getGeneral(){
        $stmt = $this->sensorBancal->getAll();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function getBuscarId($id){
        $data = $this->sensorBancal->getId($id);
        if ($data) {
            echo json_encode([
                'status' => 200,
                'data' => $data
            ]);
        } else {
            echo json_encode([
                'status' => 404,
                'message' => 'Registro no encontrado'
            ]);
        }
    }

    public function crear($data){
        $this->sensorBancal->fk_sensor = isset($data['fk_sensor']) ? $data['fk_sensor'] : null;
        $this->sensorBancal->fk_bancal = isset($data['fk_bancal']) ? $data['fk_bancal'] : null;

        if (!$this->sensorBancal->fk_sensor || !$this->sensorBancal->fk_bancal) {
            echo json_encode([
                'status' => 400,
                'message' => 'Faltan datos requeridos'
            ]);
            return;
        }

        $newId = $this->sensorBancal->create();
        echo json_encode([
            'status' => 201,
            'message' => 'Registro creado exitosamente',
            'id' => $newId
        ]);
    }

    public function actualizar($id, $data){
        $existing = $this->sensorBancal->getId($id);
        if (!$existing) {
            echo json_encode([
                'status' => 404,
                'message' => 'Registro no encontrado'
            ]);
            return;
        }

        $this->sensorBancal->id = $id;
        $this->sensorBancal->fk_sensor = isset($data['fk_sensor']) ? $data['fk_sensor'] : $existing['fk_sensor'];
        $this->sensorBancal->fk_bancal = isset($data['fk_bancal']) ? $data['fk_bancal'] : $existing['fk_bancal'];

        if ($this->sensorBancal->update()) {
            echo json_encode([
                'status' => 200,
                'message' => 'Registro actualizado exitosamente'
            ]);
        }
    }

    public function eliminar($id){
        $existing = $this->sensorBancal->getId($id);
        if (!$existing) {
            echo json_encode([
                'status' => 404,
                'message' => 'Registro no encontrado'
            ]);
            return;
        }

        $this->sensorBancal->id = $id;
        if ($this->sensorBancal->delete()) {
            echo json_encode([
                'status' => 200,
                'message' => 'Registro eliminado exitosamente'
            ]);
        }
    }
}
?>
