<?php
//print_r($_POST);
if (empty($_POST["txtMensaje"]) || empty($_POST["txtFecha"])) {
    header('Location: index.php');
    exit();
}

include_once 'model/conexion.php';
$mensaje = $_POST["txtMensaje"];
$fecha = $_POST["txtFecha"];
$codigo = $_POST["codigo"];


$sentencia = $bd->prepare("INSERT INTO mensajes(mensaje,fecha,id_usuario) VALUES (?,?,?);");
$resultado = $sentencia->execute([$mensaje,$fecha, $codigo ]);

if ($resultado === TRUE) {
    header('Location: agregarMensaje.php?codigo='.$codigo);
} 