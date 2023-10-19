<?php 
    if(!isset($_GET['codigo'])){
        header('Location: agregarTarea.php?mensaje=error');
        exit();
    }
    // Comprueba si el parámetro 'codigo' está presente en la URL; redirige a la página principal con un mensaje de error si no está presente

    include 'model/conexion.php';
    // Inclusión del archivo de conexión a la base de datos
    $codigo = $_GET['codigo'];
    // Recupera el ID de la tarea a eliminar desde la URL

    // Actualiza la columna eliminada en lugar de eliminar la tarea
    $actualizarQuery = $bd->prepare("UPDATE tareas SET eliminada = 0 WHERE id = ?");
    $actualizarQuery->execute([$codigo]);

    // Redirecciona a la página principal con un mensaje de éxito
    header("Location: index.php?mensaje=restaurado");
    exit();
?>