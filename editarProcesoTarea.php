<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: agregarTarea.php?mensaje=error');
    }

    include 'model/conexion.php';
    // Inclusión del archivo de conexión a la base de datos
    $codigo = $_POST['codigo'];
    $titulo = $_POST['txtTitulo'];
    $descripcion = $_POST['txtDescripcion'];
    $fecha_creacion = $_POST['txtFechaCreacion'];
    $fecha_vencimiento = $_POST['txtFechaVencimiento'];
    $prioridad = $_POST['txtPrioridad'];
    $estado = $_POST['txtEstado'];

    $sentencia = $bd->prepare("UPDATE tareas SET titulo = ?, descripcion = ?, fecha_creacion = ?, fecha_vencimiento = ?, prioridad = ?, estado = ? where id = ?;");
    $resultado = $sentencia->execute([$titulo, $descripcion, $fecha_creacion, $fecha_vencimiento, $prioridad, $estado, $codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }