<?php

require_once   './config/database.php';
require_once './models/Trazabilidad/loteModel.php';

class cosechasController{
    private $db;
    private $cosecha;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->cosecha = new Cosecha($this->db);
    }

    public function getTodos(){
        $stmt = $this->cosecha->getAll();
        $cosechas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            'status' => 200,
            'data' => $cosechas
        ]);
    }

    public function getPorId($id){
        $cosechaData = $this->cosecha->getById($id);
        if ($cosechaData) {
            echo json_encode([
                'status' => 200,
                'data' => $cosechaData
            ]);
        } else {
            echo json_encode([
                'status' => 404,
                'data' => 'No se encontro la cosecha'
            ]);
        }
    }


    public function crear($data){
        $this->cosecha->fk_cultivo = isset($data['fk_cultivo']) ? $data['fk_cultivo'] : null;
        $this->cosecha->unidades_medida = isset($data['unidades_medida']) ? $data['unidades_medida'] : null;
        $this->cosecha->fecha = isset($data['fecha']) ? $data['fecha'] : null;
        if (!$this->cosecha->fk_cultivo) {
            echo json_encode([
                'status' => 404,
                'Message' => 'Faltan campos por completar'
            ]);
        }
        $newId = $this->cosecha->create();
        echo json_encode([
            'status' => 200,
            'Message'=> 'Cosecha registrada con exito',
            'id' => $newId
        ]);

    }

    public function actualizar($data, $id){
        $existeCosecha = $this->cosecha->getById($id);
        if (!$existeCosecha) {
            echo json_encode([
                'status' => 404,
                'Message' => "No se encontro la cosecha"
            ]);
        }
        $this->cosecha->fk_cultivo = isset($data['fk_cultivo']) ? $data['fk_cultivo'] : $existeCosecha['fk_cultivo'];
        $this->cosecha->unidades_medida = isset($data['unidades_medida']) ? $data['unidades_medida'] :  $existeCosecha['unidades_medida'];
        $this->cosecha->fecha = isset($data['fecha']) ? $data['fecha'] :  $existeCosecha['fecha'];

        if ($this->cosecha->update()) {
            echo json_encode([
                'status' => 200,
                'Message' => 'Se actualizo la cosecha correctamente'
            ]);
        }
    }

    public function eliminar($id){
        $existeCosecha = $this->cosecha->getById($id);
        if (!$existeCosecha) {
            echo json_encode([
                'status' => 404,
                'Message' => "No se encontro la cosecha"
            ]);
        }

        if ($this->cosecha->delete()) {
            echo json_encode([
                'status' => 200,
                'Message' => "Se elimino la cosecha correctamente"
            ]);
        }
    }
}