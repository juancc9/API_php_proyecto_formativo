<?php
require_once dirname(__DIR__, 3) . '/config/database.php';
require_once dirname(__DIR__, 3) . '/models/Trazabilidad/actividadModel.php';

$database = new Database();
$db = $database->getConnection();
$actividad = new Actividades($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $actividad->fk_cultivo = $_POST['fk_cultivo'];
    $actividad->fk_usuario = $_POST['fk_usuario'];
    $actividad->fk_insumo = $_POST['fk_insumo'];
    $actividad->fk_programacion = $_POST['fk_programacion'];
    $actividad->fk_tipo_actividad = $_POST['fk_tipo_actividad'];
    $actividad->titulo = $_POST['titulo'];
    $actividad->descripcion = $_POST['descripcion'];
    $actividad->fecha = $_POST['fecha'];
    $actividad->cantidad_producto = $_POST['cantidad_producto'];

    if ($actividad->create()) {
        header("Location: http://localhost/agrosoft_mvc/actividad");
        exit();
    } else {
        echo "Error al crear la actividad.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Actividad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Crear Nueva Actividad</h2>
    <form action="crear_actividad.php" method="POST">
        <div class="mb-3">
            <label for="fk_cultivo" class="form-label">Cultivo</label>
            <input type="text" class="form-control" name="fk_cultivo" required>
        </div>
        <div class="mb-3">
            <label for="fk_usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="fk_usuario" required>
        </div>
        <div class="mb-3">
            <label for="fk_insumo" class="form-label">Insumo</label>
            <input type="text" class="form-control" name="fk_insumo" required>
        </div>
        <div class="mb-3">
            <label for="fk_programacion" class="form-label">Programación</label>
            <input type="text" class="form-control" name="fk_programacion" required>
        </div>
        <div class="mb-3">
            <label for="fk_tipo_actividad" class="form-label">Tipo de Actividad</label>
            <input type="text" class="form-control" name="fk_tipo_actividad" required>
        </div>
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" required></textarea>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha" required>
        </div>
        <div class="mb-3">
            <label for="cantidad_producto" class="form-label">Cantidad</label>
            <input type="number" class="form-control" name="cantidad_producto" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Actividad</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
