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

    $sentencia = $bd->prepare("select * from tareas where id = ?;");
    $sentencia->execute([$codigo]);
    $tarea = $sentencia->fetch(PDO::FETCH_OBJ);
    //print_r($persona);
?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card m-10">
                <div class="card-header">
                    Editar tarea:
                </div>
                <form class="p-3" method="POST" action="editarProcesoTarea.php">
                    <!-- Formulario con acción para editar una tarea -->
                    <!-- Contiene campos para editar los detalles de la tarea -->
                    <div class="mb-1">
                        <label class="form-label">Titulo: </label>
                        <input type="text" class="form-control" name="txtTitulo" required 
                        value="<?php echo $tarea->titulo; ?>">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Descripción: </label>
                        <input type="text" class="form-control" name="txtDescripcion" autofocus required
                        value="<?php echo $tarea->descripcion; ?>">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Fecha de Creación: </label>
                        <input type="date" class="form-control" name="txtFechaCreacion" autofocus required
                        value="<?php echo $tarea->fecha_creacion; ?>">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Fecha de Vencimiento: </label>
                        <input type="date" class="form-control" name="txtFechaVencimiento" autofocus required
                        value="<?php echo $tarea->fecha_vencimiento; ?>">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Prioridad: </label>
                        <select class="form-select" name="txtPrioridad" required>
                            <option value="Alta" <?php if ($tarea->prioridad == 'Alta') echo 'selected'; ?>>Alta</option>
                            <option value="Media" <?php if ($tarea->prioridad == 'Media') echo 'selected'; ?>>Media</option>
                            <option value="Baja" <?php if ($tarea->prioridad == 'Baja') echo 'selected'; ?>>Baja</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Estado: </label>
                        <select class="form-select" name="txtEstado" required>
                            <option value="Pendiente" <?php if ($tarea->estado == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                            <option value="EnProgreso" <?php if ($tarea->estado == 'EnProgreso') echo 'selected'; ?>>En Progreso</option>
                            <option value="Completada" <?php if ($tarea->estado == 'Completada') echo 'selected'; ?>>Completada</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center"> 
                        <div class="d-inline mx-2">
                            <input type="hidden" name="codigo" value="<?php echo $tarea->id; ?>">
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

