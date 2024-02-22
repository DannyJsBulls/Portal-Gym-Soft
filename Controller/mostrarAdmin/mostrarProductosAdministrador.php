<?php
    function mostrarProductosAdministrador(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarProductosAdministrador();

        if (!isset($result)) {
            echo '<h2>No hay productos registrados en el gimnasio</h2>';
        }else {
            foreach ($result as $f) {
                echo '
                    <div class="training">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6 tarjeta">
                                    <img src="' . $f['foto_producto'] . '" class="card-img" alt="...">
                                </div>
                                <div class="col-lg-6 target">
                                    <div class="row">
                                        <div class="col-lg-6 info">
                                            <p class="card-text profile mt-3">' . $f['nombre_producto'] . '</p>
                                            <p class="card-text mt-3 admin-rol">' . $f['categoria_producto'] . '</p>
                                            <p class="card-text propio mt-3"> Descripcion: ' . $f['descripcion_producto'] . '</p>
                                            <p class="card-text propio mt-3"> Cantidad Disponible: ' . $f['cantidad_productos_disponibles'] . '</p>
                                            <p class="card-text propio mt-3"> Estado: ' . $f['estado_producto'] . '</p>
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
                                        <a href="verDetalleProductosAdmin.php?id_user=' . $f['codigo_producto'] . '" class="btn btn-primary ver-user">Ver Informacion</a>
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
    function cargarProductosAdministrador(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarProductosAdministrador($id_user);

        foreach ($result as $f) {
            echo '
                <div class="card-entrenador">
                    <div class="row">
                        <div class="col-lg-6 tarjeta">
                            <img src="' . $f['foto_producto'] . '" class="card-img" alt="Foto de usuario">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body">
                                <h5 class="card-title mt-3">' . $f['nombre_producto'] . '</h5>
                                <p class="card-text propio mt-3"> CALIFICACIONES</p>
                                <div class="stars activity">
                                    <span>8.9</span>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star-shape"></i>
                                </div>
                                <p class="card-text mt-3 title-admin"> INFORMACION DEL PRODUCTO</p>
                                <p class="card-text mt-3 propio"> Descripcion: ' . $f['descripcion_producto'] . '</p>
                                <p class="card-text mt-3 propio"> Cantidad Disponible: ' . $f['cantidad_productos_disponibles'] . '</p>
                                <p class="card-text mt-3 propio"> Categoria: ' . $f['categoria_producto'] . '</p>
                                <p class="card-text mt-3 propio"> Fecha de Vencimiento: ' . $f['fecha_vencimiento_producto'] . '</p>
                                <p class="card-text mt-3 propio"> Marca: ' . $f['marca_producto'] . '</p>
                                <p class="card-text mt-3 propio"> Estado: ' . $f['estado_producto'] . '</p>
                                <p class="card-text mt-3 propio"> Precio: ' . $f['precio_final_producto'] . '</p>
                                <h4 class="moto mt-3">Estimado usuario</h4>
                                <p class="card-text mt-3 propio">Tienes la opción de vender productos a los clientes del gimnasio o adquirirlos de proveedores asociados, mejorando así los ingresos y la experiencia del cliente.</p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button class="btn btn-danger venta-but w-100 btnVenderProductoCli" data-producto-cli="' . $f['codigo_producto'] . '">Vender Producto</button>
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