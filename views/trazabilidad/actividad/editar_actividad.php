<?php
require_once dirname(__DIR__, 3) . '/config/database.php';
require_once dirname(__DIR__, 3) . '/models/Trazabilidad/actividadModel.php';

$database = new Database();
$db = $database->getConnection();
$actividad = new Actividades($db);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $actividadData = $actividad->getId($_GET['id']);

    if (!$actividadData) {
        echo json_encode([
            'status' => 404,
            'message' => 'Actividad no encontrada'
        ]);
        return;
    }

    // Si la petición NO es JSON, cargamos la vista en HTML
    if (!isset($_SERVER['HTTP_ACCEPT']) || strpos($_SERVER['HTTP_ACCEPT'], 'application/json') === false) {
        $_GET['actividad'] = $actividadData;
    } 
} else {
    die("ID de actividad no especificado o inválido.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $actividad->id = $_POST['id'];
    $actividad->fk_cultivo = $_POST['fk_cultivo'];
    $actividad->fk_usuario = $_POST['fk_usuario'];
    $actividad->fk_insumo = $_POST['fk_insumo'];
    $actividad->fk_programacion = $_POST['fk_programacion'];
    $actividad->fk_tipo_actividad = $_POST['fk_tipo_actividad'];
    $actividad->titulo = $_POST['titulo'];
    $actividad->descripcion = $_POST['descripcion'];
    $actividad->fecha = $_POST['fecha'];
    $actividad->cantidad_producto = $_POST['cantidad_producto'];

    if ($actividad->update()) {
        header("Location: http://localhost/agrosoft_mvc/actividad");
        exit();
    } else {
        echo "Error al actualizar la actividad.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Actividad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Editar Actividad</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= htmlspecialchars($actividadData['id']) ?>">
        
        <div class="mb-3">
            <label class="form-label">Cultivo</label>
            <input type="text" class="form-control" name="fk_cultivo" value="<?= htmlspecialchars($actividadData['fk_cultivo']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" class="form-control" name="fk_usuario" value="<?= htmlspecialchars($actividadData['fk_usuario']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Insumo</label>
            <input type="text" class="form-control" name="fk_insumo" value="<?= htmlspecialchars($actividadData['fk_insumo']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Programación</label>
            <input type="text" class="form-control" name="fk_programacion" value="<?= htmlspecialchars($actividadData['fk_programacion']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de Actividad</label>
            <input type="text" class="form-control" name="fk_tipo_actividad" value="<?= htmlspecialchars($actividadData['fk_tipo_actividad']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" value="<?= htmlspecialchars($actividadData['titulo']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" required><?= htmlspecialchars($actividadData['descripcion']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha" value="<?= htmlspecialchars($actividadData['fecha']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cantidad de Producto</label>
            <input type="number" class="form-control" name="cantidad_producto" value="<?= htmlspecialchars($actividadData['cantidad_producto']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
