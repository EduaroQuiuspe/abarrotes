<?php
    require_once __DIR__ .'/../config/database.php';

    function obtenerTareas() {
        global $tasksCollection;
        return $tasksCollection->find();
    }

    function formatDate($date) {
        return $date->toDateTime()->format('Y-m-d');
    }
    function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }
    function crearTarea($productos, $categoria, $stock, $preciounidad, $fechavencimiento) {
        global $tasksCollection;
        $resultado = $tasksCollection->insertOne([
            'productos' => sanitizeInput($productos),
            'categoria' => sanitizeInput($categoria),
            'stock' => sanitizeInput($stock),
            'preciounidad' => sanitizeInput($preciounidad),
            'fechavencimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechavencimiento) * 1000),

        ]);
        return $resultado->getInsertedId();
    }
    function obtenerTareaPorId($id) {
        global $tasksCollection;
        return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
    function actualizarTarea($id, $productos, $categoria, $stock, $preciounidad, $fechavencimiento, $completada) {
        global $tasksCollection;
        $resultado = $tasksCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'productos' => sanitizeInput($productos),
                'categoria' => sanitizeInput($categoria),
                'stock' => sanitizeInput($stock),
                'preciounidad' => sanitizeInput($preciounidad),
                'fechavencimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechavencimiento) * 1000),
                'completada' => $completada
            ]]
        );
        return $resultado->getModifiedCount();
    }
    function eliminarTarea($id) {
        global $tasksCollection;
        $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    }
    
?>