<?php
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearTarea($_POST['producto'], $_POST['categoria'], $_POST['stock'], $_POST['preciounidad'], $_POST['fechavencimiento']);
    if ($id) {
        header("Location: index.php?mensaje=Tarea creada con éxito");
        exit;
    } else {
        $error = "No se pudo crear la tarea.";
    }
}
?>
<?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Producto</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Nuevo Producto</h1>
        <form method="POST">
            <label>Producto: <input type="text" name="producto" required></label>
            <label>Categoria: <input type="text" name="categoria" required></label>
            <label>stock: <input type="number" name="stock" required></label><br>
            <label>Precio X Unidad: <input type="number" name="preciounidad" required></label><br>
            <label>Fecha de Vencimiento: <input type="date" name="fechavencimiento" required></label>
            <input type="submit" value="Agregar Producto">
        </form>
        <a href="index.php" class="button">Volver a la lista de tareas</a>
    </div>
</body>

</html>