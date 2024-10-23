<?php
    require_once __DIR__ .'/includes/functions.php';
    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        $count = eliminarTarea($_GET['id']);
        $mensaje = $count > 0 ? "Tarea eliminada con éxito." : "No se pudo eliminar la tarea.";
    }
    $tareas = obtenerTareas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas de Cursos</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de Productos de Abarrotes</h1>

        <?php if (isset($mensaje)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <a href="agregar_producto.php" class="button">Agregar Nuevo Producto</a>

        <h2>Lista de Productos</h2>
        <table>
            <tr>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Precio por unidad</th>
                <th>fecha de Vencimiento</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($tareas as $tarea): ?>
            <tr>
                <td><?php echo htmlspecialchars($tarea['productos']); ?></td>
                <td><?php echo htmlspecialchars($tarea['categoria']); ?></td>
                <td><?php echo htmlspecialchars($tarea['stock']) ?></td>
                <td><?php echo htmlspecialchars($tarea['preciounidad']) ?></td>
                <td><?php echo formatDate($tarea['fechavencimiento']); ?></td>
                <td class="actions">
                    <a href="editar_producto.php?id=<?php echo $tarea['_id']; ?>" class="button">Editar</a>
                    <a href="index.php?accion=eliminar&id=<?php echo $tarea['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>