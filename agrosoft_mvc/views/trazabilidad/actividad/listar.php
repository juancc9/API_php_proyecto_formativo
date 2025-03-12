<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Actividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Listado de Actividades</h2>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cultivo</th>
                <th>Usuario</th>
                <th>Insumo</th>
                <th>Programación</th>
                <th>Tipo de Actividad</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($actividades)): ?>
                <?php foreach ($actividades as $actividad): ?>
                    <tr>
                        <td><?= htmlspecialchars($actividad['id']) ?></td>
                        <td><?= htmlspecialchars($actividad['fk_cultivo']) ?></td>
                        <td><?= htmlspecialchars($actividad['fk_usuario']) ?></td>
                        <td><?= htmlspecialchars($actividad['fk_insumo']) ?></td>
                        <td><?= htmlspecialchars($actividad['fk_programacion']) ?></td>
                        <td><?= htmlspecialchars($actividad['fk_tipo_actividad']) ?></td>
                        <td><?= htmlspecialchars($actividad['titulo']) ?></td>
                        <td><?= htmlspecialchars($actividad['descripcion']) ?></td>
                        <td><?= htmlspecialchars($actividad['fecha']) ?></td>
                        <td><?= htmlspecialchars($actividad['cantidad_producto']) ?></td>
                        <td>
                        <a href="views/trazabilidad/actividad/crear_actividad.php" class="btn btn-success btn-sm">Crear</a>
<a href="views/trazabilidad/actividad/editar_actividad.php?id=<?= $actividad['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
<form action="views/trazabilidad/actividad/eliminar_actividad.php" method="POST" style="display:inline;">
    <input type="hidden" name="id" value="<?= $actividad['id'] ?>">
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta actividad?');">Eliminar</button>
</form>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11" class="text-center">No hay actividades registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="../index.php" class="btn btn-primary">Volver al Inicio</a>
</div>

</body>
</html>
