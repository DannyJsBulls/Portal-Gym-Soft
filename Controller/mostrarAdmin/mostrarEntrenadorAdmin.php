<?php
    function mostrarEntrenadorAdmin(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarEntrenadorAdmin();

        if (!isset($result)) {
            echo '<h2>No hay entrenadores registrados en el sistema</h2>';
        }else {
            foreach ($result as $f) {
                echo '
                    <div class="training"">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <img src="' . $f['foto_usuario'] . '" class="card-img-top imagen-entrenador" alt="...">
                                </div>
                                <div class="col-lg-7 lista">
                                    <div class="row">
                                        <div class="col-lg-6 info">
                                            <p class="card-text profile mt-3">' . $f['nombres_usuario'] . ' ' . $f['apellidos_usuario'] . '</p>
                                            <p class="card-text mt-3 admin-rol">' . $f['rol_usuario'] . '</p>
                                            <p class="card-text propio mt-3"> Numero de Identificacion: ' . $f['id_usuario'] . '</p>
                                            <p class="card-text propio mt-3"> Correo Electronico: ' . $f['email_usuario'] . '</p>
                                            <p class="card-text propio mt-3"> Numero de Telefono: ' . $f['telefono_usuario'] . '</p>
                                            <p class="card-text propio mt-3"> Estado: ' . $f['estado_usuario'] . '</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="stars">
                                                <span>8.9</span>
                                                <i class="icofont-star"></i>
                                                <i class="icofont-star"></i>
                                                <i class="icofont-star"></i>
                                                <i class="icofont-star"></i>
                                                <i class="icofont-star-shape"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <a href="verDetalleEntrenadorAdmin.php?id_user=' . $f['id_usuario'] . '" class="btn btn-primary ver-user">Ver Perfil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        }
    }
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarEntrenadorAdmin(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarEntrenadorAdmin($id_user);

        foreach ($result as $f) {
            echo '
                <div class="card-user card-centered">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="' . $f['foto_usuario'] . '" class="card-img-top imagen-ancho-completo" alt="Foto Usuario">
                        </div>
                        <div class="col-lg-8">
                            <div class="card-body">
                                <p class="card-text propio">Saluda a nuestros apasionados entrenadores listos para guiarte en tu viaje de fitness. Desde sesiones personalizadas hasta clases grupales, están aquí para impulsarte hacia tus metas. ¡Bienvenido al camino de la superación con nuestro dedicado equipo!</p>
                                <h5 class="card-title mt-3">' . $f['nombres_usuario'] . '</h5>
                                <h5 class="card-title mt-3">' . $f['apellidos_usuario'] . '</h5>
                                <p class="card-text mt-3 admin-rol">' . $f['rol_usuario'] . '</p>
                                <p class="card-text propio mt-3"> CALIFICACIONES</p>
                                <div class="stars">
                                    <span>8.9</span>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star-shape"></i>
                                </div>
                                <div class="message">
                                    <button class="btn btn-primary btn-addon" type="button"><i class="icofont-ui-message"></i> Enviar Mensaje</button>
                                </div>
                                <p class="card-text mt-3 title-admin"> INFORMACION DE CONTACTO</p>
                                <p class="card-text mt-3 propio"> Num.Identificacion: ' . $f['id_usuario'] . '</p>
                                <p class="card-text mt-3 propio"> Tipo Documento: ' . $f['tipo_documento_usuario'] . '</p>
                                <p class="card-text mt-3 propio"> Fecha de Nacimiento: ' . $f['fecha_nacimiento_usuario'] . '</p>
                                <p class="card-text mt-3 propio"> Email: ' . $f['email_usuario'] . '</p>
                                <p class="card-text mt-3 propio"> Telefono: ' . $f['telefono_usuario'] . '</p>
                                <p class="card-text mt-3 propio"> Estado: ' . $f['estado_usuario'] . '</p>
                                <h2 class="cta-title">Estimado administrador,</h2>
                                <p class="card-text propio">Asigne actividades personalizadas ahora. Ofrecemos oportunidades únicas y emocionantes. Asegure lugares disponibles hoy.</p>
                                <button class="btn btn-success venta-but w-100 btnInscripcionPerso" data-inscripcion="' . $f['id_usuario'] . '">Inscribir Actividad Personalizada</button>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

    }

?>