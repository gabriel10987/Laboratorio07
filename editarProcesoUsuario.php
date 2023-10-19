<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    // Inclusión del archivo de conexión a la base de datos
    $codigo = $_POST['codigo'];
    $nombres = $_POST['txtNombres'];
    $apellido_paterno = $_POST['txtApellidoPaterno'];
    $apellido_materno = $_POST['txtApellidoMaterno'];
    $celular = $_POST['txtCelular'];

    $sentencia = $bd->prepare("UPDATE usuarios SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, celular = ? where id = ?;");
    $resultado = $sentencia->execute([$nombres, $apellido_paterno, $apellido_materno, $celular, $codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }