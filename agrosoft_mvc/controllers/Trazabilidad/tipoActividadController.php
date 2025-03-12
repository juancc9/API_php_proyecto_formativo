<?php
require_once './config/database.php';
require_once './models/Trazabilidad/tipoActividadModel.php';

class TipoActividadController {
    private $db;
    private $tipoActividad;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->tipoActividad = new TipoActividad($this->db);
    }

    public function getGeneral(){
        $stmt = $this->tipoActividad->getAll();
        $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            'status' => 200,
            'data' => $tipos
        ]);
    }

    public function getBuscarId($id){
        $tipoData = $this->tipoActividad->getId($id);
        if ($tipoData) {
            echo json_encode([
                'status' => 200,
                'data' => $tipoData
            ]);
        } else {
            echo json_encode([
                'status' => 404,
                'message' => 'Tipo de actividad no encontrado'
            ]);
        }
    }

    public function crear($data){
        $this->tipoActividad->nombre = isset($data['nombre']) ? $data['nombre'] : null;
        $this->tipoActividad->descripcion = isset($data['descripcion']) ? $data['descripcion'] : null;
        $this->tipoActividad->duracion_estimada = isset($data['duracion_estimada']) ? $data['duracion_estimada'] : null;
        $this->tipoActividad->frecuencia = isset($data['frecuencia']) ? $data['frecuencia'] : null;

        if (!$this->tipoActividad->nombre) {
            echo json_encode([
                'status' => 400,
                'message' => 'Falta el nombre del tipo de actividad'
            ]);
            return;
        }

        $newId = $this->tipoActividad->create();
        echo json_encode([
            'status' => 201,
            'message' => 'Tipo de actividad creado exitosamente',
            'id' => $newId
        ]);
    }

    public function actualizar($id, $data){
        $existingTipo = $this->tipoActividad->getId($id);
        if (!$existingTipo) {
            echo json_encode([
                'status' => 404,
                'message' => 'Tipo de actividad no encontrado'
            ]);
            return;
        }

        $this->tipoActividad->id = $id;
        $this->tipoActividad->nombre = isset($data['nombre']) ? $data['nombre'] : $existingTipo['nombre'];
        $this->tipoActividad->descripcion = isset($data['descripcion']) ? $data['descripcion'] : $existingTipo['descripcion'];
        $this->tipoActividad->duracion_estimada = isset($data['duracion_estimada']) ? $data['duracion_estimada'] : $existingTipo['duracion_estimada'];
        $this->tipoActividad->frecuencia = isset($data['frecuencia']) ? $data['frecuencia'] : $existingTipo['frecuencia'];

        if ($this->tipoActividad->update()) {
            echo json_encode([
                'status' => 200,
                'message' => 'Tipo de actividad actualizado exitosamente'
            ]);
        }
    }

    public function eliminar($id){
        $existingTipo = $this->tipoActividad->getId($id);
        if (!$existingTipo) {
            echo json_encode([
                'status' => 404,
                'message' => 'Tipo de actividad no encontrado'
            ]);
            return;
        }

        $this->tipoActividad->id = $id;
        if ($this->tipoActividad->delete()) {
            echo json_encode([
                'status' => 200,
                'message' => 'Tipo de actividad eliminado exitosamente'
            ]);
        }
    }
}
?>
