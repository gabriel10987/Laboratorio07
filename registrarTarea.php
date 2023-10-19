<?php
// Se verifica si algún campo importante está vacío en el formulario
if (empty($_POST["txtTitulo"]) || empty($_POST["txtDescripcion"]) || empty($_POST["txtFechaCreacion"]) || empty($_POST["txtFechaVencimiento"]) || empty($_POST["txtPrioridad"]) || empty($_POST["txtEstado"])) {
    header('Location: index.php');
    exit();
    // Si alguno de los campos requeridos está vacío, se redirige a la página principal con un mensaje de error
}

include_once 'model/conexion.php';
// Inclusión del archivo de conexión a la base de datos
$titulo = $_POST['txtTitulo'];
$descripcion = $_POST['txtDescripcion'];
$fecha_creacion = $_POST['txtFechaCreacion'];
$fecha_vencimiento = $_POST['txtFechaVencimiento'];
$prioridad = $_POST['txtPrioridad'];
$estado = $_POST['txtEstado'];
$codigo = $_POST["codigo"];


$sentencia = $bd->prepare("INSERT INTO tareas(titulo, descripcion, fecha_creacion, fecha_vencimiento, prioridad, estado, id_usuario) VALUES (?,?,?,?,?,?,?);");
$resultado = $sentencia->execute([$titulo, $descripcion, $fecha_creacion, $fecha_vencimiento, $prioridad, $estado, $codigo]);


if ($resultado === TRUE) {
    header('Location: agregarTarea.php?codigo='.$codigo);
}