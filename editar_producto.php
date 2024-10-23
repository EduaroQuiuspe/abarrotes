<?php
require_once __DIR__ . '/includes/functions.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$tarea = obtenerTareaPorId($_GET['id']);

if (!$tarea) {
    header("Location: index.php?mensaje=Tarea no encontrada");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarTarea($_GET['id'], $_POST['productos'], $_POST['categoria'], $_POST['stock'], $_POST['preciounidad'], $_POST['fechavencimiento'], isset($_POST['completada']));
    if ($count > 0) {
        header("Location: index.php?mensaje=Tarea actualizada con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar la tarea.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Producto</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Producto: <input type="text" name="productos" value="<?php echo htmlspecialchars($tarea['productos']); ?>" required></label>
            <label>Categoria: <input type="text" name="categoria" value="<?php echo htmlspecialchars($tarea['categoria']); ?>" required></label>
            <label>Stock: <input type="number" name="stock" value="<?php echo htmlspecialchars($tarea['stock']); ?>" required></label>
            <label>Precio por Unidad: <input type="number" name="preciounidad" value="<?php echo htmlspecialchars($tarea['preciounidad']); ?>" required></label>
            <label>Fecha de Vencimiento: <input type="date" name="fechavencimiento" value="<?php echo formatDate($tarea['fechavencimiento']); ?>" required></label>
            <input type="submit" value="Actualizar Producto">
        </form>
        <a href="index.php" class="button">Volver a la lista de Productos</a>
    </div>
</body>

</html>