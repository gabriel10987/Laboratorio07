    <?php include 'template/header.php'; ?>
    <!-- Inclusión del encabezado (header) desde un archivo externo -->

    <?php
    include_once "model/conexion.php";
    // Inclusión del archivo de conexión a la base de datos
    $sentencia = $bd->query("select * from usuarios");
    $usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);

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
                        <strong>Usuario registrado!</strong> Se agregaron los datos.
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
                        <strong>Usuario editado!</strong> Los datos fueron actualizados.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>
                <!-- fin alerta -->

                <!-- Botón para abrir el modal de registro de tareas -->
                <!--data-bs-toggle: habilita la funcionalidad de modal a Bootstrap -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Registrar usuario
                </button>
                
                <!-- Modal de Registro de Tareas-->
                <!-- modal fade: transición suave-->
                <!-- tabindex = "-1": control de orden de tabulación en el modal-->
                <!-- aria-labelledby: asociar al modal con un elemento de encabeezado-->
                <!-- aria-hidden: modal oculto inicialmente-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog"> <!--estructura de modal-->
                        <div class="modal-content"> <!-- contenedor de modal-->
                            <div class="modal-header"> <!-- encabezado de modal-->
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar usuario</h1> <!--fs: tamaño fuente-->
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card"> <!-- tarjeta: estilos formato para el contenedor para que se vea como una tarjeta-->
                                    <!--p-4: padding-->
                                    <!--method="POST": enviar datos del formulario al servidor sin mostrarlos en la URL-->
                                    <!--mb-3: margen inferior-->
                                    <form class="p-4" method="POST" action="registrarUsuario.php">
                                        <div class="mb-3">
                                            <label class="form-label">Nombres:</label>
                                            <input type="text" class="form-control" name="txtNombres" autofocus required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellido Paterno:</label>
                                            <input type="text" class="form-control" name="txtApellidoPaterno" autofocus required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellido Materno: </label>
                                            <input type="text" class="form-control" name="txtApellidoMaterno" autofocus required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Celular: </label>
                                            <input type="text" class="form-control" name="txtCelular" autofocus required>
                                        </div>
                                        <!--d-grid: contenedor cuadrícula-->
                                        <div class="d-grid">
                                            <!--enviar datos al servidor cuando se formulario se envía-->
                                            <input type="hidden" name="oculto" value="1"> 
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
                        Registro de usuarios
                    </div>
                    <div class="card-body"> <!--contenido principal-->
                        <table class="table table-striped"> <!--table-striped: filas alternas fondo con color ligeramente diferente--->
                            <thead>
                                <tr>
                                    <th scope="col">N°</th> <!--scope="col": indica que una celda th representa una columna en la tabla -->
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Ap.Paterno</th>
                                    <th scope="col">Ap.Materno</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col" colspan="4">Opciones</th> <!--cuántas columnas adyacentes debe abarca una celda-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($usuario as $dato) { // recorre el array tarea. Para cada elemento se crea un tr en la tabla
                                ?>
                                    <tr>
                                        <!--scope="row": idica que el contenido de una celda td es una tabla -->
                                        <td scope="row"><?php echo $dato->id; ?></td>
                                        <!--insertar dinámicamente el título de la tarea en la celda-->
                                        <td><?php echo $dato->nombres; ?></td>
                                        <td><?php echo $dato->apellido_paterno; ?></td>
                                        <td><?php echo $dato->apellido_materno; ?></td>
                                        <td><?php echo $dato->celular; ?></td>

                                        <td><a class="btn btn-success btn-sm" href="editarUsuario.php?codigo=<?php echo $dato->id; ?>">Editar</a></td>
                                        <td><a class="btn btn-danger btn-sm" onclick="return confirm('Estás seguro de eliminar?');" href="eliminarUsuario.php?codigo=<?php echo $dato->id; ?>">Eliminar</a></td>
                                        <td><a class="btn btn-secondary btn-sm" href="agregarTarea.php?codigo=<?php echo $dato->id; ?>">Tareas</a></td>
                                        <td><a class="btn btn-secondary btn-sm" href="agregarMensaje.php?codigo=<?php echo $dato->id; ?>">Mensaje</a></td>
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