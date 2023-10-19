<?php include 'template/header.php'?>
<!-- Inclusión de un encabezado (header) desde un archivo externo -->

<?php
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once 'model/conexion.php';
    // Inclusión de un archivo que contiene la conexión a la base de datos
    $codigo = $_GET['codigo'];
    // Obtención del código de la tarea a editar

    $sentencia = $bd->prepare("select * from usuarios where id = ?;");
    $sentencia->execute([$codigo]);
    $usuario = $sentencia->fetch(PDO::FETCH_OBJ);
    //print_r($persona);
?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card m-10">
                <div class="card-header">
                    Editar usuario:
                </div>
                <form class="p-3" method="POST" action="editarProcesoUsuario.php">
                    <!-- Formulario con acción para editar una tarea -->
                    <!-- Contiene campos para editar los detalles de la tarea -->
                    <div class="mb-3">
                        <label class="form-label">Nombres: </label>
                        <input type="text" class="form-control" name="txtNombres" required 
                        value="<?php echo $usuario->nombres; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellido Paterno: </label>
                        <input type="text" class="form-control" name="txtApellidoPaterno" autofocus required
                        value="<?php echo $usuario->apellido_paterno; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellido Materno: </label>
                        <input type="text" class="form-control" name="txtApellidoMaterno" autofocus required
                        value="<?php echo $usuario->apellido_materno; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Celular: </label>
                        <input type="text" class="form-control" name="txtCelular" autofocus required
                        value="<?php echo $usuario->celular; ?>">
                    </div>
                    <div class="d-flex justify-content-center"> 
                        <div class="d-inline mx-2">
                            <input type="hidden" name="codigo" value="<?php echo $usuario->id; ?>">
                            <input type="submit" class="btn btn-success" value="Editar">
                        </div>
                        <div class="d-inline mx-2">
                            <a href="index.php" class="btn btn-danger">Cancelar</a>    
                        </div>
                    </div>
                </form>
                <!-- fin del formulario -->
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>
<!-- Inclusión de un pie de página (footer) desde un archivo externo -->
