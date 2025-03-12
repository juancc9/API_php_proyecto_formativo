<?php
require_once './controllers/Trazabilidad/actividadController.php';

$controller = new ActividadController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'listar':
            $controller->getGeneral();
            break;
        case 'detalle':
            if (isset($_GET['id'])) {
                $controller->getBuscarId($_GET['id']);
            } else {
                echo "ID de actividad no proporcionado.";
            }
            break;
        default:
            echo "Acción no reconocida.";
            break;
    }
} else {
    echo "Bienvenido a la API de Actividades.";
}
?>
