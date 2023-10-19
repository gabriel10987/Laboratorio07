<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("select * from usuarios where id = ?;");
$sentencia->execute([$codigo]);
$usuario = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia_mensaje = $bd->prepare("select * from mensajes where id_usuario = ?;");
$sentencia_mensaje->execute([$codigo]);
$mensaje = $sentencia_mensaje->fetchAll(PDO::FETCH_OBJ); 
//print_r($persona);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-4">
            <?php
            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'eliminadoMensaje') {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Mensaje eliminado!</strong> El mensaje se eliminó correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>

            <a class="mb-4 btn btn-secondary" href="index.php">Regresar</a>

            <div class="card">
                <div class="card-header">
                    Ingresar mensaje para : <br><?php echo $usuario->nombres.' '.$usuario->apellido_paterno.' '.$usuario->apellido_materno; ?>
                </div>
                <form class="p-4" method="POST" action="registrarMensaje.php">
                    <div class="mb-3">
                        <label class="form-label">Mensaje: </label>
                        <input type="text" class="form-control" name="txtMensaje" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha: </label>
                        <input type="date" class="form-control" name="txtFecha" autofocus required>
                    </div>
                    <div class="d-grid">
                    <input type="hidden" name="codigo" value="<?php echo $usuario->id; ?>"><P></P>
                        <input type="submit" class="btn btn-secondary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Lista de Mensajes
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mensaje</th>
                                <th scope="col">Fecha</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($mensaje as $dato) {
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <td><?php echo $dato->mensaje; ?></td>
                                    <td><?php echo $dato->fecha; ?></td>
                                    <td><a class="btn btn-success btn-sm" href="enviarMensaje.php?codigo=<?php echo $dato->id; ?>">Enviar</a></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>