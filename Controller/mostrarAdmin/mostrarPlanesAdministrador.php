<?php
    function mostrarPlanesAdministrador(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarPlanesAdministrador();

        if (!isset($result)) {
            echo '<h2>No Hay Planes Registrados en el Sistema</h2>';
        }else {
            echo '<div class="row">';
            foreach ($result as $f) {
                echo '
                    <div class="col-lg-3 col-md-12 col-sm-12 member">
                        <div class="card-planes">
                            <div class="card plan-bg">
                                <h1 class="titulo-plan"> ' . $f['nombre_plan'] . '</h1>
                                <h3 class="subtitulo-plan"> $ ' . $f['precio_final_plan'] . ' / ' . $f['duracion_plan'] . '</h3>
                                <p class="card-text-planes">Descripcion Plan: ' . $f['descripcion_plan'] . '</p>
                                <p class="card-text-planes sombra"><i class="icofont-check-alt"></i>' . $f['descuentos_plan'] . '</p>
                                <p class="card-text-planes sombra"><i class="icofont-check-alt"></i> Categoria: ' . $f['categoria_plan'] . '</p>
                                <p class="card-text-planes separacion"><i class="icofont-check-alt"></i> Estado: ' . $f['estado_plan'] . '</p>
                                <a href="verDetallePlanesAdmin.php?id_user=' . $f['codigo_plan'] . '" class="btn btn-primary w-100 story">Ver Plan</a>
                            </div>
                        </div>
                    </div>
                ';
            }
            echo '</div>';
        }
    }
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarPlanesAdministrador(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarPlanesAdministrador($id_user);

        foreach ($result as $f) {
            echo '
                <div class="card-entrenador">
                    <div class="row">
                        <div class="col-lg-6 tarjeta">
                            <img src="../../Views/Extras/Logos/logo-trnasparente.png" class="image-logo" alt="Logo Gym">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body">
                                <h5 class="card-title mt-3"><i class="icofont-tags planes"></i>' . $f['nombre_plan'] . '</h5>
                                <p class="card-text propio mt-3"> CALIFICACIONES</p>
                                <div class="stars activity">
                                    <span>8.9</span>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star-shape"></i>
                                </div>
                                <p class="card-text mt-3 title-admin"> INFORMACION DEL PLAN</p>
                                <p class="card-text mt-3 propio"> Descripcion: ' . $f['descripcion_plan'] . '</p>
                                <p class="card-text mt-3 propio"> Precio: ' . $f['precio_final_plan'] . '</p>
                                <p class="card-text mt-3 propio"> Duracion: ' . $f['duracion_plan'] . '</p>
                                <p class="card-text mt-3 propio"> Acceso Servicios: ' . $f['acceso_servicios_plan'] . '</p>
                                <p class="card-text mt-3 propio"> Restricciones del Plan: ' . $f['restricciones_plan'] . '</p>
                                <p class="card-text mt-3 propio"> Estado: ' . $f['estado_plan'] . '</p>
                                <p class="card-text mt-3 propio"> Descuentos del Plan: ' . $f['descuentos_plan'] . '</p>
                                <p class="card-text mt-3 propio"> Categoria del Plan: ' . $f['categoria_plan'] . '</p>
                                <h4 class="moto mt-3">Estimado usuario</h4>
                                <p class="card-text mt-3 propio">Puedes vender membresías de actividades del gimnasio a tus clientes.</p>
                                <button class="btn btn-danger w-100 btnVenderPlanDos" data-plan-dos="' . $f['codigo_plan'] . '">Vender Plan</button>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

    }

?>


