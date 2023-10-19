<?php
$contrasena = ""; 
$usuario = "root"; 
$nombre_bd = "gestiontareas"; 

try {
    // crea una instancia de conexión PDO
    $bd = new PDO(
        'mysql:host=localhost;
        dbname=' . $nombre_bd,
        $usuario,
        $contrasena,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
} catch (Exception $e) {
    // Maneja  excepciones de conexión
    echo "Problema con la conexión: " . $e->getMessage();
}
?>