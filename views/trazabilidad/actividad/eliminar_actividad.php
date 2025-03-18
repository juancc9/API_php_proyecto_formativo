<?php
require_once dirname(__DIR__, 3) . '/config/database.php';
require_once dirname(__DIR__, 3) . '/models/Trazabilidad/actividadModel.php';

$database = new Database();
$db = $database->getConnection();
$actividad = new Actividades($db);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $actividad->id = $_POST['id'];

    if ($actividad->delete()) {
        header("Location: http://localhost/agrosoft_mvc/actividad");
        exit();
    } else {
        echo "Error al eliminar la actividad.";
    }
}
?>
