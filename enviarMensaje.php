<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.mensaje, pro.fecha , pro.id_usuario, per.nombres , per.apellido_paterno ,per.apellido_materno,per.celular
  FROM mensajes pro 
  INNER JOIN usuarios per ON per.id = pro.id_usuario
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$usuario = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance7103868126/SendMessage/6de6409073ec497bb9372f0d33ad55cecb2561e0ca3f45978d';
    $data = [
        "chatId" => "51".$usuario->celular."@c.us",
        "message" =>  'Estimado(a) *'.strtoupper($usuario->nombres).' '.strtoupper($usuario->apellido_paterno).' '.strtoupper($usuario->apellido_materno).'* se creo una nueva tarea: *'.strtoupper($usuario->mensaje).'* | fecha: *'.$usuario->fecha.'*'
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    header('Location: agregarMensaje.php?codigo='.$usuario->id_usuario);
?> 