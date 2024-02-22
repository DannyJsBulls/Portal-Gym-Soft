<?php
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarPedidosCli(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarPedidosCliAdmin($id_user);

        foreach ($result as $f) {
            echo '
                <div class="card-entrenador">
                    <div class="row">
                        <div class="col-lg-6 tarjeta">
                            <img src="../../Views/Extras/Logos/logo-trnasparente.png" class="image-logo" alt="Logo Gym">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body">
                                <h5 class="card-title mt-3"><i class="icofont-fast-delivery icon-si"></i> Pedido Numero: ' . $f['codigo_venta_plan'] . '</h5>
                                <h5 class="card-title mt-3">Identificacion Cliente: ' . $f['id_usuario'] . '</h5>
                                <p class="card-text mt-3 propio"> Fecha Entrega: ' . $f['fecha_entrega_plan'] . '</p>
                                <p class="card-text mt-3 propio"> Hora Entrega: ' . $f['hora_entrega_plan'] . '</p>
                                <p class="card-text mt-3 propio"> Total: $' . $f['precio_venta_plan'] . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
    }
    // Funcion para cargar el metodo de pago del pedido
    function cargarMetodoPago(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarMetodoPagoAdmin($id_user);

        foreach ($result as $f) {
            echo '
                <div class="card-entrenador">
                    <h1 class="cash-pago">Metodo De Pago</h1>
                    <p class="card-text mt-3 propio">' .$f['metodo_pago_plan'] .' Pago contra entrega</p>
                </div>
            ';
        }
    }
    // funcion para el detalle del pedido
    function cargarPedidosDetalleCli(){
        if (isset($_GET['id_user'])) {
            $id_user = $_GET['id_user'];
        
            $objConsultas = new Consultas();
            $result = $objConsultas->buscarPedidosDetalleCliAdmin($id_user);
        
            if ($result === null) {
                echo '<p>No se encontraron pedidos para el usuario con ID ' . $id_user . '</p>';
            } else {
                foreach ($result as $pedido) {
                    echo '
                        <div class="card-entrenador">
                            <div class="row">
                                <div class="col-lg-6 tarjeta">
                                    <i class="icofont-tags plan-tag"></i>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <p class="card-text mt-3 propio"> Plan Membresia ' . $pedido['nombre_plan'] . '</p>
                                        <p class="card-text mt-3 propio"> ' . $pedido['descripcion_plan'] . '</p>
                                        <p class="card-text mt-3 propio"> Categoria: ' . $pedido['categoria_plan'] . '</p>
                                        <p class="card-text mt-3 propio"> Restriccion Plan: ' . $pedido['restricciones_plan'] . '</p>
                                        <p class="card-text mt-3 propio">$ ' . $pedido['precio_final_plan'] . '</p>
                                        <p class="card-text mt-3 propio"> Estado: ' . $pedido['estado_venta_plan'] . '</p>
                                        <div class="row columna">
                                            <div class="estado-pedido">
                                                <div class="paso paso-comprado">
                                                    <div class="icono">
                                                        <i class="icofont-verification-check"></i>
                                                    </div>
                                                    <div class="texto">Comprado</div>
                                                </div>
                                                <div class="flecha"></div>
                                                <div class="paso paso-enviado" onclick="actualizarProgreso(1)">
                                                    <div class="icono">
                                                        <i class="icofont-fast-delivery"></i>
                                                    </div>
                                                    <div class="texto">Enviado</div>
                                                </div>
                                                <div class="flecha"></div>
                                                <div class="paso paso-entregado" onclick="actualizarProgreso(2)">
                                                    <div class="icono">
                                                        <i class="icofont-home"></i>
                                                    </div>
                                                    <div class="texto">Entregado</div>
                                                </div>
                                                <div class="flecha"></div>
                                                <div class="paso paso-devuelto" onclick="actualizarProgreso(3)">
                                                    <div class="icono">
                                                        <i class="icofont-delivery-time"></i>
                                                    </div>
                                                    <div class="texto">Devuelto</div>
                                                </div>
                                                <div class="flecha"></div>
                                                <div class="paso paso-vencido" onclick="actualizarProgreso(4)">
                                                    <div class="icono">
                                                        <i class="icofont-error"></i>
                                                    </div>
                                                    <div class="texto">Vencido</div>
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
    function cargarDireccionEntrega(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarDireccionEntregaAdmin($id_user);

        foreach ($result as $f) {
            echo '
                <div class="card-entrenador">
                    <h1 class="cash-pago">Direccion de entrega</h1>
                    <p class="card-text mt-3 propio">' .$f['direccion_entrega'] .'</p>
                </div>
            ';
        }
    }
?>