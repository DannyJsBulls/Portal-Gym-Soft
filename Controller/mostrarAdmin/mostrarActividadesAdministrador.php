<?php
    function mostrarActividadesAdministrador(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarActividadesAdministrador();

        if (!isset($result)) {
            echo '<h2>No hay actividades registrados en el gimnasio</h2>';
        }else {
            foreach ($result as $f) {
                echo '
                    <div class="training">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6 tarjeta">
                                    <img src="' . $f['foto_actividad'] . '" class="card-img" alt="...">
                                </div>
                                <div class="col-lg-6 target">
                                    <div class="row">
                                        <div class="col-lg-6 info">
                                            <p class="card-text profile mt-3">' . $f['nombre_actividad'] . '</p>
                                            <p class="card-text mt-3 admin-rol"> Actividad Tipo ' . $f['tipo_actividad'] . '</p>
                                            <p class="card-text propio mt-3"> Numero de Referencia: ' . $f['codigo_actividad'] . '</p>
                                            <p class="card-text propio mt-3"> Descripcion: ' . $f['descripcion_actividad'] . '</p>
                                            <p class="card-text propio mt-3"> Estado: ' . $f['estado_actividad'] . '</p>
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
                                        <a href="verDetalleActividadesAdmin.php?id_user=' . $f['codigo_actividad'] . '" class="btn btn-primary ver-user">Ver Informacion</a>
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
    function cargarActividadesAdministrador(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarActividadesAdministrador($id_user);

        foreach ($result as $f) {
            echo '
                <div class="card-entrenador">
                    <div class="row">
                        <div class="col-lg-6 tarjeta">
                            <img src="' . $f['foto_actividad'] . '" class="card-img" alt="Foto de usuario">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body">
                                <h5 class="card-title mt-3">' . $f['nombre_actividad'] . '</h5>
                                <p class="card-text propio mt-3"> CALIFICACIONES</p>
                                <div class="stars activity">
                                    <span>8.9</span>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star-shape"></i>
                                </div>
                                <p class="card-text mt-3 title-admin"> INFORMACION DE LA ACTIVIDAD</p>
                                <p class="card-text mt-3 propio"> Descripcion Actividad: ' . $f['descripcion_actividad'] . '</p>
                                <p class="card-text mt-3 propio"> Tipo de Actividad: ' . $f['tipo_actividad'] . '</p>
                                <p class="card-text mt-3 propio"> Requisitos: ' . $f['requisitos_actividad'] . '</p>
                                <p class="card-text mt-3 propio"> Estado: ' . $f['estado_actividad'] . '</p>
                                <p class="card-text mt-3 propio"> Objetivo: ' . $f['objetivos_actividad'] . '</p>
                                <p class="card-text mt-3 propio"> Area Actividad: ' . $f['area_actividad'] . '</p>
                                <h4 class="moto mt-3">Estimado usuario</h2>
                                <p class="card-text mt-3 propio">Registre actividades libres ahora. Ofrecemos oportunidades únicas y emocionantes. Asegure lugares disponibles hoy.</p>
                                <div class="row columna">
                                    <div class="col-lg-12">
                                        <button class="btn btn-success w-100 btnInscribirLibre" data-actividad="' . $f['codigo_actividad'] . '">Inscribir Actividad Libre</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

    }

?>