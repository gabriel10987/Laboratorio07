<?php 
    if(!isset($_GET['codigo'])){
        header('Location: papelera.php?mensaje=error');
        exit();
    }

    include 'model/conexion.php';
    // Inclusión del archivo de conexión a la base de datos
    $codigo = $_GET['codigo'];
    // Obtención del ID de la tarea a eliminar desde la URL
    
    $sentencia = $bd->prepare("DELETE FROM tareas where id = ?;");
    $resultado = $sentencia->execute([$codigo]);

    if ($resultado === TRUE){
        header('Location: papelera.php?mensaje=eliminadoPapelera');
    } else {
        header('Location: papelera.php?mensaje=error');
    }
?>
