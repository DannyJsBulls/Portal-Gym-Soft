<?php
    function mostrarInscripcionesLibres(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarInscripcionesLibresAdmin();

        if (!isset($result)) {
            echo '<h2>No hay inscripciones registradas en el sistema</h2>';
        }else {
            foreach ($result as $f) {
                $nombreActividad = $objConsultas->obtenerNombreActividadPorCodigo($f['codigo_actividad']);
                $nombreUsuario = $objConsultas->obtenerNombreUsuario($f['id_usuario']);
                $apellidoUsuario = $objConsultas->obtenerApellidoUsuario($f['id_usuario']);
                echo '
                    <tr>
                        <td><i class="icofont-file-alt planes"></i></td>
                        <td>' . $f['codigo_inscripcion_libre'] . '</td>
                        <td>' . $f['fecha_inicio_actividad'] . '</td>
                        <td>' . $f['hora_inicio_actividad'] . '</td>
                        <td>' . $f['estado_inscripcion_libre'] . '</td>
                        <td>' . $f['comentarios_inscripcion_libre'] . '</td>
                        <td>' . $nombreActividad . '</td>
                        <td>' . $f['codigo_venta_plan'] . '</td>
                        <td>' . $nombreUsuario . ' ' . $apellidoUsuario . '</td>
                        <td><a href="verComprobanteInscripLi.php?id_user=' . $f['codigo_inscripcion_libre'] . '" class="btn btn-info">Comprobante <i class="icofont-ui-file"></i></a></td>
                        <td><a href="modificarInscripcionesLibres.php?id_user=' . $f['codigo_inscripcion_libre'] . '" class="btn btn-success">Editar <i class="icofont-ui-edit"></i></a></td>
                        <td><a href="../../Controller/eliminarAdmin/eliminarInscripcionesLibresAdmin.php?id_user=' . $f['codigo_inscripcion_libre'] . '" class="btn btn-danger btnEliminacionInscripLibre">Eliminar <i class="icofont-ui-delete"></i></a></td>
                    </tr>
                ';
            }
        }

    }
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarInscripcionesLibres(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarInscripcionesLibres($id_user);

        foreach ($result as $f) {
            echo '
                <form action="../../Controller/modificarAdmin/modificarInscripcionLiAdmin.php" method="POST" name="actualizarInscripcionLiForm">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUMERO INSCRIPCION</label>
                            <input type="number" class="form-control" placeholder="Ingrese la fecha" name="codigo_inscripcion_libre" required="required" readonly value="' . $f['codigo_inscripcion_libre'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FECHA INICIO ACTIVIDAD</label>
                            <input type="date" class="form-control" placeholder="Ingrese la fecha" name="fecha_inicio_actividad" value="' . $f['fecha_inicio_actividad'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>HORA INICIO ACTIVIDAD</label>
                            <input type="time" class="form-control" placeholder="Ingrese la hora" name="hora_inicio_actividad" value="' . $f['hora_inicio_actividad'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ESTADO INSCRIPCION</label>
                            <select name="estado_inscripcion_libre" id="" class="form-control">
                                <option value="' . $f['estado_inscripcion_libre'] . '"> ' . $f['estado_inscripcion_libre'] . '</option>
                                <option value="Programada">Programada</option>
                                <option value="Finalizada">Finalizada</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>COMENTARIOS</label>
                            <input type="textarea" class="form-control" placeholder="Ingrese un comentario" name="comentarios_inscripcion_libre" value="' . $f['comentarios_inscripcion_libre'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ACTIVIDAD</label>
                            <input type="number" class="form-control" placeholder="Ingrese un comentario" name="codigo_actividad" required="required" readonly value="' . $f['codigo_actividad'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUMERO PLAN</label>
                            <input type="number" class="form-control" placeholder="Ingrese el numero del plan" name="codigo_venta_plan" required="required" readonly value="' . $f['codigo_venta_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUMERO IDENTIFICACION CLIENTE</label>
                            <input type="number" class="form-control" placeholder="Ingrese un numero de identificacion" name="id_usuario" required="required" readonly value="' . $f['id_usuario'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <button type="submit" class="btn btn-primary update btnActualizarInscripcionLi">Actualizar Inscripcion</button>
                        </div>
                    </div>
                </form>
            ';
        }

    }
    // Esta funcion muestra el comprobante de la inscripcion
    function cargarInscripcionLiAdmin(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarInscripcionLiAdmin($id_user);

        foreach ($result as $f) {
            $nombreActividad = $objConsultas->obtenerNombreActividadPorCodigo($f['codigo_actividad']);
            $rolUsuario = $objConsultas->obtenerRolUsuario($f['id_usuario']);
            $nombreUsuario = $objConsultas->obtenerNombreUsuario($f['id_usuario']);
            $apellidoUsuario = $objConsultas->obtenerApellidoUsuario($f['id_usuario']);
            $telefonoUsuario = $objConsultas->obtenerTelefonoUsuario($f['id_usuario']);
            echo '
                <article class="body-recibo">
                    <h2 class="recibo-centro">Apreciado(a): ' . $rolUsuario . '</h2>
                    <h3 class="parrafo-centro">Te informamos que tu inscripcion:</h3>
                    <div class="article-info">
                        <section id="uno">
                            <h4>Con Numero De Referencia: ' . $f['codigo_inscripcion_libre'] . '</h4>
                        </section>
                        <section id="dos">
                            <h5>Fue ' . $f['estado_inscripcion_libre'] . '</h5>
                        </section>
                        <section id="tres">
                            <p class="arriba-recibo">Inscripcion ' . $nombreActividad . '</p>
                            <p class="medio-recibo">Fecha Programada: ' . $f['fecha_inicio_actividad'] . ' Hora De Ingreso: ' . $f['hora_inicio_actividad'] . '</p>
                        </section>
                    </div>
                    <div class="table-article">
                        <h4 class="info-pa">Los siguientes datos corresponden al la inscripcion:</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="parrafo-lista sombra-abajo">Numero Id.Cliente</p>
                                <p class="parrafo-lista sombra-abajo">Nombre Cliente</p>
                                <p class="parrafo-lista sombra-abajo">Numero Telefono</p>
                                <p class="parrafo-lista sombra-abajo">Fecha de Programacion</p>
                                <p class="parrafo-lista sombra-abajo">Hora de Ingreso</p>
                                <p class="parrafo-lista sombra-abajo">Codigo Actividad Inscrita</p>
                                <p class="parrafo-lista sombra-abajo">Empresa</p>
                                <p class="parrafo-lista sombra-abajo">Numero Inscripcion</p>
                                <p class="parrafo-lista sombra-abajo">Numero Plan Aquirido</p>
                                <p class="parrafo-lista sombra-abajo">Estado Inscripcion</p>
                                <p class="parrafo-lista sombra-abajo mb-5">Comentarios Inscripcion</p>
                            </div>
                            <div class="col-lg-6">
                                <p class="parrafo-valor sombra-abajo">' . $f['id_usuario'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $nombreUsuario . ' ' . $apellidoUsuario . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $telefonoUsuario . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['fecha_inicio_actividad'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['hora_inicio_actividad'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['codigo_actividad'] . '</p>
                                <p class="parrafo-valor sombra-abajo">Gimnasio Moderno</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['codigo_inscripcion_libre'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['codigo_venta_plan'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['estado_inscripcion_libre'] . '</p>
                                <p class="parrafo-valor sombra-abajo mb-5">' . $f['comentarios_inscripcion_libre'] . '</p>
                            </div>
                        </div> 
                        <p class="parrafo-valor mb-5 text-center">Copyright © 2023 Gimnasio Moderno. Todos los derechos reservados.</p>  
                    </div>
                </article>                
            ';
        }

    }

?>