<?php 
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include 'model/conexion.php';
    // Inclusión del archivo de conexión a la base de datos
    $codigo = $_GET['codigo'];
    // Obtención del ID de la tarea a marcar como eliminada desde la URL

    // Actualiza la columna eliminada en lugar de eliminar la tarea
    $actualizarQuery = $bd->prepare("UPDATE tareas SET eliminada = 1 WHERE id = ?");
    $actualizarQuery->execute([$codigo]);

    // Redirecciona a la página principal con un mensaje de éxito
    header("Location: index.php?mensaje=eliminado");
    exit();
?>