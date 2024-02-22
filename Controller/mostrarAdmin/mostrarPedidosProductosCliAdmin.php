<?php
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarPedidosProductoCli(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarPedidosProductoCliAdmin($id_user);

        foreach ($result as $f) {
            echo '
                <div class="card-entrenador">
                    <div class="row">
                        <div class="col-lg-6 tarjeta">
                            <img src="../../Views/Extras/Logos/logo-trnasparente.png" class="image-logo" alt="Logo Gym">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body">
                                <h5 class="card-title mt-3"><i class="icofont-fast-delivery icon-si"></i> Numero Pedido: ' . $f['codigo_venta_producto'] . '</h5>
                                <h5 class="card-title mt-3">Identificacion Cliente: ' . $f['id_usuario'] . '</h5>
                                <p class="card-text mt-3 propio"> Fecha Entrega: ' . $f['fecha_entrega_cliente'] . '</p>
                                <p class="card-text mt-3 propio"> Hora Entrega: ' . $f['hora_entrega_cliente'] . '</p>
                                <p class="card-text mt-3 propio"> Total: $' . $f['precio_pedido_cliente'] . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
    }
    // Funcion para cargar el metodo de pago del pedido
    function cargarMetodoPagoProductoCli(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarMetodoPagoProductoCliAdmin($id_user);

        foreach ($result as $f) {
            echo '
                <div class="card-entrenador">
                    <h1 class="cash-pago">Metodo De Pago</h1>
                    <p class="card-text mt-3 propio">' .$f['metodo_pago_cliente'] .' Pago contra entrega</p>
                </div>
            ';
        }
    }
    // funcion para el detalle del pedido
    function cargarPedidosDetaProductoCli(){
        if (isset($_GET['id_user'])) {
            $id_user = $_GET['id_user'];
        
            $objConsultas = new Consultas();
            $result = $objConsultas->buscarPedidosDetaProductoCliAdmin($id_user);
        
            if ($result === null) {
                echo '<p>No se encontraron pedidos para el usuario con ID ' . $id_user . '</p>';
            } else {
                foreach ($result as $pedido) {
                    echo '
                        <div class="card-entrenador">
                            <div class="row">
                                <div class="col-lg-6 tarjeta">
                                    <img src="' . $pedido['foto_producto'] . '" class="card-img" alt="Foto de Producto">
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <p class="card-text mt-3 propio"> Producto ' . $pedido['nombre_producto'] . '</p>
                                        <p class="card-text mt-3 propio"> Descripcion: ' . $pedido['descripcion_producto'] . '</p>
                                        <p class="card-text mt-3 propio"> Categoria: ' . $pedido['categoria_producto'] . '</p>
                                        <p class="card-text mt-3 propio"> Marca: ' . $pedido['marca_producto'] . '</p>
                                        <p class="card-text mt-3 propio">$ ' . $pedido['precio_final_producto'] . '</p>
                                        <p class="card-text mt-3 propio"> Estado: ' . $pedido['estado_pedido_cliente'] . '</p>
                                        <div class="row columna">
                                            <div class="estado-pedido">
                                                <div class="paso-comprado">
                                                    <div class="icono">
                                                        <i class="icofont-verification-check"></i>
                                                    </div>
                                                    <div class="texto">Comprado</div>
                                                </div>
                                                <div class="flecha"></div>
                                                <div class="paso-enviado">
                                                    <div class="icono">
                                                        <i class="icofont-fast-delivery"></i>
                                                    </div>
                                                    <div class="texto">Enviado</div>
                                                </div>
                                                <div class="flecha"></div>
                                                <div class="paso-entregado">
                                                    <div class="icono">
                                                        <i class="icofont-home"></i>
                                                    </div>
                                                    <div class="texto">Entregado</div>
                                                </div>
                                                <div class="flecha"></div>
                                                <div class="paso-devuelto">
                                                    <div class="icono">
                                                        <i class="icofont-delivery-time"></i>
                                                    </div>
                                                    <div class="texto">Devuelto</div>
                                                </div>
                                                <div class="flecha"></div>
                                                <div class="paso-cancelado">
                                                    <div class="icono">
                                                        <i class="icofont-error"></i>
                                                    </div>
                                                    <div class="texto">Cancelado</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }
            }
        } else {
            echo '<p>No se proporcionó un ID de usuario válido en la URL.</p>';
        }
    }
    // Funcion para cargar la direccion de entrega
    function cargarDireccionProductoCli(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarDireccionProductoCliAdmin($id_user);

        foreach ($result as $f) {
            echo '
                <div class="card-entrenador">
                    <h1 class="cash-pago">Direccion de entrega</h1>
                    <p class="card-text mt-3 propio">' .$f['direccion_residencia'] .'</p>
                </div>
            ';
        }
    }
?>