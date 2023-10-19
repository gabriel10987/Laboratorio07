<?php include 'template/header.php'; ?>
<!-- Inclusión del encabezado (header) desde un archivo externo -->

<?php
include_once "model/conexion.php";
$sentencia = $bd->query("SELECT * FROM tareas WHERE eliminada = 1");
$tareasEliminadas = $sentencia->fetchAll(PDO::FETCH_OBJ);
// Obtención de todas las tareas marcadas como eliminadas en la base de datos y almacenamiento en un objeto
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- inicio alerta -->
            <?php
            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'eliminadoPapelera') {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Tarea eliminada!</strong> Los datos fueron eliminados de manera permanente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>
            <!-- fin alerta -->

            <!-- Botón para regresar a la página principal -->
            <a class="btn btn-secondary" href="index.php">Regresar</a>

            <!-- Registro de tareas eliminadas -->
            <div class="card mt-4">
                <div class="card-header">
                    Tareas eliminadas
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">F.Creacion</th>
                                <th scope="col">F.Vencimiento</th>
                                <th scope="col">Prioridad</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="w-5" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tareasEliminadas as $dato) { ?>
                                <tr>
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <td><?php echo $dato->titulo; ?></td>
                                    <td><?php echo $dato->descripcion; ?></td>
                                    <td><?php echo $dato->fecha_creacion; ?></td>
                                    <td><?php echo $dato->fecha_vencimiento; ?></td>
                                    <td><?php echo $dato->prioridad; ?></td>
                                    <td><?php echo $dato->estado; ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="restaurar.php?codigo=<?php echo $dato->id; ?>">Restaurar</a>
                                    <td><a class="btn btn-danger btn-sm" onclick="return confirm('Estás seguro de eliminar?');" href="eliminarPapelera.php?codigo=<?php echo $dato->id; ?>">Eliminar def.</a></td>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php'; ?>
<!-- Inclusión del pie de página (footer) desde un archivo externo -->