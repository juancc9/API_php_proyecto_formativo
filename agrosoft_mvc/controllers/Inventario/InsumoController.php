<?php
require_once   './config/database.php';
require_once './models/Inventario/InsumoModel.php';

class InsumoController {
    private $db;
    private $insumo;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->insumo = new Insumo($this->db);
    }

    public function getTodos(){
        $stmt = $this->insumo->getAll();
        $insumos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            'status' => 200,
            'data' => $insumos
        ]);
    }

    public function getPorId($id){
        $insumoData = $this->insumo->getById($id);
        if ($insumoData) {
            echo json_encode([
                'status' => 200,
                'data' => $insumoData
            ]);
        } else {
            echo json_encode([
                'status' => 404,
                'message' => 'Insumo no encontrado'
            ]);
        }
    }

    public function crear($data){
        $this->insumo->nombre = isset($data['nombre']) ? $data['nombre'] : null;
        $this->insumo->descripcion = isset($data['descripcion']) ? $data['descripcion'] : null;
        $this->insumo->precio = isset($data['precio']) ? $data['precio'] : null;
        $this->insumo->unidad_medida = isset($data['unidad_medida']) ? $data['unidad_medida'] : null;

        if (!$this->insumo->nombre || !$this->insumo->precio || !$this->insumo->unidad_medida) {
            echo json_encode([
                'status' => 400,
                'message' => 'Faltan datos requeridos'
            ]);
            return;
        }

        $newId = $this->insumo->create();
        echo json_encode([
            'status' => 201,
            'message' => 'Insumo creado exitosamente',
            'id' => $newId
        ]);
    }

    public function actualizar($id, $data){
        $existingInsumo = $this->insumo->getById($id);
        if (!$existingInsumo) {
            echo json_encode([
                'status' => 404,
                'message' => 'Insumo no encontrado'
            ]);
            return;
        }

        $this->insumo->id = $id;
        $this->insumo->nombre = isset($data['nombre']) ? $data['nombre'] : $existingInsumo['nombre'];
        $this->insumo->descripcion = isset($data['descripcion']) ? $data['descripcion'] : $existingInsumo['descripcion'];
        $this->insumo->precio = isset($data['precio']) ? $data['precio'] : $existingInsumo['precio'];
        $this->insumo->unidad_medida = isset($data['unidad_medida']) ? $data['unidad_medida'] : $existingInsumo['unidad_medida'];

        if ($this->insumo->update()) {
            echo json_encode([
                'status' => 200,
                'message' => 'Insumo actualizado exitosamente'
            ]);
        }
    }

    public function eliminar($id){
        $existingInsumo = $this->insumo->getById($id);
        if (!$existingInsumo) {
            echo json_encode([
                'status' => 404,
                'message' => 'Insumo no encontrado'
            ]);
            return;
        }

        $this->insumo->id = $id;
        if ($this->insumo->delete()) {
            echo json_encode([
                'status' => 200,
                'message' => 'Insumo eliminado exitosamente'
            ]);
        }
    }
}
?>
