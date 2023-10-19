<?php
// Se verifica si algún campo importante está vacío en el formulario
if (empty($_POST["oculto"]) || empty($_POST["txtNombres"]) || empty($_POST["txtApellidoPaterno"]) || empty($_POST["txtApellidoMaterno"]) || empty($_POST["txtCelular"])) {
    header('Location: index.php?mensaje=falta');
    exit();
    // Si alguno de los campos requeridos está vacío, se redirige a la página principal con un mensaje de error
}

include_once 'model/conexion.php';
// Inclusión del archivo de conexión a la base de datos
$nombres = $_POST['txtNombres'];
$apellido_paterno = $_POST['txtApellidoPaterno'];
$apellido_materno = $_POST['txtApellidoMaterno'];
$celular = $_POST['txtCelular'];


$sentencia = $bd->prepare("INSERT INTO usuarios(nombres, apellido_paterno, apellido_materno, celular) VALUES (?,?,?,?);");
$resultado = $sentencia->execute([$nombres, $apellido_paterno, $apellido_materno, $celular]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}