<?php
    require_once __DIR__.'/../vendor/autoload.php';
    $mongoClient = new MongoDB\Client('mongodb+srv://carlos:bperI0Sbcj5vt4qB@cluster0.fy4pp.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0');
    $database = $mongoClient->selectDataBase('Gestion_abarrotes');
    $tasksCollection = $database->tareas;
?>