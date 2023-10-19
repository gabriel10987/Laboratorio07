<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("select * from usuarios where id = ?;");
$sentencia->execute([$codigo]);
$usuario = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia_tarea = $bd->prepare("select * from tareas where id_usuario = ? and eliminada = 0;");
$sentencia_tarea->execute([$codigo]);
$tarea = $sentencia_tarea->fetchAll(PDO::FETCH_OBJ);
//print_r($persona);
?>

<div class="container mt-5"> <!--mt-5: margin-top-->
    <div class="row justify-content-center">
        <div class="col-md-12"> <!--ancho disponible en dispositivos medianos: md-->
            <!-- inicio alertas -->
            <?php
            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'falta') {
            ?>
                <!--alert-dismissible: X en la esquina para cerrar-->
                <!--fade: transición suave-->
                <!--show: visible de inmediato-->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Rellena todos los campos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>


            <?php
            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'registrado') {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Tarea registrada!</strong> Se agregaron los datos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>

            <?php
            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Vuelve a intentar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>

            <?php
            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'editado') {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Tarea editada!</strong> Los datos fueron actualizados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>

            <?php
            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'eliminado') {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Tarea eliminada!</strong> Los datos fueron enviados a la papelera.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>

            <?php
            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'restaurado') {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Tarea restaurada!</strong> Los datos fueron restaurados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>
            <!-- fin alerta -->

            <!-- Botón para abrir el modal de registro de tareas -->
            <!--data-bs-toggle: habilita la funcionalidad de modal a Bootstrap -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Registrar tarea
            </button>

            <!-- Botón para abrir la página de papelera -->
            <a class="btn btn-secondary" href="papelera.php">Ir a la Papelera</a>

            <a class="btn btn-secondary" href="index.php">Regresar</a>

            <!-- Modal de Registro de Tareas-->
            <!-- modal fade: transición suave-->
            <!-- tabindex = "-1": control de orden de tabulación en el modal-->
            <!-- aria-labelledby: asociar al modal con un elemento de encabeezado-->
            <!-- aria-hidden: modal oculto inicialmente-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog"> <!--estructura de modal-->
                    <div class="modal-content"> <!-- contenedor de modal-->
                        <div class="modal-header"> <!-- encabezado de modal-->
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar Tarea</h1> <!--fs: tamaño fuente-->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card"> <!-- tarjeta: estilos formato para el contenedor para que se vea como una tarjeta-->
                                <!--p-4: padding-->
                                <!--method="POST": enviar datos del formulario al servidor sin mostrarlos en la URL-->
                                <!--mb-3: margen inferior-->
                                <form class="p-4" method="POST" action="registrarTarea.php">
                                    <div class="mb-2">
                                        <label class="form-label">Titulo:</label>
                                        <input type="text" class="form-control" name="txtTitulo" autofocus required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Descripción:</label>
                                        <input type="text" class="form-control" name="txtDescripcion" autofocus required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Fecha de Creación: </label>
                                        <input type="date" class="form-control" name="txtFechaCreacion" autofocus required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Fecha de Vencimiento: </label>
                                        <input type="date" class="form-control" name="txtFechaVencimiento" autofocus required>
                                    </div>
                                    <!--form-label: estilo a las etiquetas de formulario-->
                                    <!--form-select: apariencia de menú desplegable-->
                                    <div class="mb-2">
                                        <label class="form-label">Prioridad: </label>
                                        <select class="form-select" name="txtPrioridad" required>
                                            <option value="Alta">Alta</option>
                                            <option value="Media">Media</option>
                                            <option value="Baja">Baja</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Estado: </label>
                                        <select class="form-select" name="txtEstado" required>
                                            <option value="Pendiente">Pendiente</option>
                                            <option value="EnProgreso">En Progreso</option>
                                            <option value="Completada">Completada</option>
                                        </select>
                                    </div>
                                    <!--d-grid: contenedor cuadrícula-->
                                    <div class="d-grid">
                                        <!--enviar datos al servidor cuando se formulario se envía-->
                                        <input type="hidden" name="codigo" value="<?php echo $usuario->id; ?>"><P></P>
                                        <!--enviar el formulario al servidor-->
                                        <input type="submit" class="btn btn-secondary" value="Registrar">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registro de tareas -->
            <div class="card mt-4">
                <div class="card-header">
                    Registro de tareas
                </div>
                <div class="card-body"> <!--contenido principal-->
                    <table class="table table-striped"> <!--table-striped: filas alternas fondo con color ligeramente diferente--->
                        <thead>
                            <tr>
                                <th scope="col">N°</th> <!--scope="col": indica que una celda th representa una columna en la tabla -->
                                <th scope="col">Titulo</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">F.Creacion</th>
                                <th scope="col">F.Vencimiento</th>
                                <th scope="col">Prioridad</th>
                                <th scope="col">Estado</th>
                                <th scope="col" colspan="3">Opciones</th> <!--cuántas columnas adyacentes debe abarca una celda-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($tarea as $dato) { // recorre el array tarea. Para cada elemento se crea un tr en la tabla
                            ?>
                                <tr>
                                    <!--scope="row": idica que el contenido de una celda td es una tabla -->
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <!--insertar dinámicamente el título de la tarea en la celda-->
                                    <td><?php echo $dato->titulo; ?></td>
                                    <td><?php echo $dato->descripcion; ?></td>
                                    <td><?php echo $dato->fecha_creacion; ?></td>
                                    <td><?php echo $dato->fecha_vencimiento; ?></td>
                                    <td><?php echo $dato->prioridad; ?></td>
                                    <td><?php echo $dato->estado; ?></td>

                                    <td><a class="btn btn-success btn-sm" href="editarTarea.php?codigo=<?php echo $dato->id; ?>">Editar</a></td>
                                    <td><a class="btn btn-danger btn-sm" onclick="return confirm('Estás seguro de eliminar?');" href="eliminarTarea.php?codigo=<?php echo $dato->id; ?>">Eliminar</a></td>
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

<?php include 'template/footer.php'; ?>
<!-- Inclusión del pie de página (footer) desde un archivo externo -->