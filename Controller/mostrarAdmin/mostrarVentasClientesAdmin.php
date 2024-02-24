<?php
    function mostrarVentasClientes(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarVentasClientesAdmin();

        if (!isset($result)) {
            echo '<h2>No hay pedidos de productos a clientes registrados en el sistema</h2>';
        }else {
            foreach ($result as $f) {
                $nombreProducto = $objConsultas->obtenerNombreProductoPorCodigo($f['codigo_producto']);
                $nombreUsuario = $objConsultas->obtenerNombreUsuario($f['id_usuario']);
                $apellidoUsuario = $objConsultas->obtenerApellidoUsuario($f['id_usuario']);
                echo '
                    <tr>
                        <td><i class="icofont-fast-delivery planes"></i></td>
                        <td>' . $f['codigo_venta_producto'] . '</td>
                        <td>' . $nombreProducto . '</td>
                        <td>' . $nombreUsuario . ' ' . $apellidoUsuario . '</td>
                        <td>' . $f['forma_entrega_cliente'] . '</td>
                        <td>' . $f['fecha_entrega_cliente'] . '</td>
                        <td>' . $f['hora_entrega_cliente'] . '</td>
                        <td>' . $f['direccion_residencia'] . '</td>
                        <td>' . $f['metodo_pago_cliente'] . '</td>
                        <td>' . $f['precio_pedido_cliente'] . '</td>
                        <td>' . $f['estado_pedido_cliente'] . '</td>
                        <td><a href="verDetalleVentaProductosCliente.php?id_user=' . $f['codigo_venta_producto'] . '" class="btn btn-info">Remision <i class="icofont-law-document"></i></a></td>
                        <td><a href="verPedidoProductoCliente.php?id_user=' . $f['codigo_venta_producto'] . '" class="btn btn-warning">Pedido <i class="icofont-fast-delivery"></i></a></td>
                        <td><a href="modificarVentasCliente.php?id_user=' . $f['codigo_venta_producto'] . '" class="btn btn-success">Editar <i class="icofont-ui-edit"></i></a></td>
                        <td><a href="../../Controller/eliminarAdmin/eliminarVentasProductosClienteAdmin.php?id_user=' . $f['codigo_venta_producto'] . '" class="btn btn-danger btnEliminacionPagoProductoCliente"> Eliminar <i class="icofont-ui-delete"></i></a></td>
                    </tr>
                ';
            }
        }

    }
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarVentasClientes(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarVentasClientes($id_user);

        foreach ($result as $f) {
            echo '
                <form action="../../Controller/modificarAdmin/modificarVentasClientesAdmin.php" method="POST" name="actualizarPagoProductoClienteForm">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUMERO PEDIDO</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo" name="codigo_venta_producto" required="required" readonly value="' . $f['codigo_venta_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FECHA PEDIDO</label>
                            <input type="date" class="form-control" name="fecha_entrega_cliente" value="' . $f['fecha_entrega_cliente'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>HORA PEDIDO</label>
                            <input type="time" class="form-control" name="hora_entrega_cliente" value="' . $f['hora_entrega_cliente'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>METODO PAGO</label>
                            <select name="metodo_pago_cliente" id="" class="form-control">
                                <option value="' . $f['metodo_pago_cliente'] . '"> ' . $f['metodo_pago_cliente'] . ' </option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ESTADO PEDIDO</label>
                            <select name="estado_pedido_cliente" id="" class="form-control">
                                <option value="' . $f['estado_pedido_cliente'] . '"> ' . $f['estado_pedido_cliente'] . ' </option>
                                <option value="Comprado">Comprado</option>
                                <option value="Enviado">Enviado</option>
                                <option value="Entregado">Entregado</option>
                                <option value="Devuelto">Devuelto</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>PRECIO PEDIDO PRODUCTO</label>
                            <input type="number" class="form-control" placeholder="Ingrese el precio" name="precio_pedido_cliente" value="' . $f['precio_pedido_cliente'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUM.REFERENCIA PRODUCTO</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo" name="codigo_producto" required="required" readonly value="' . $f['codigo_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>IDENTIFICACION CLIENTE</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo" name="id_usuario" required="required" readonly value="' . $f['id_usuario'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FORMA DE ENTREGA</label>
                            <select name="forma_entrega_cliente" id="" class="form-control">
                                <option value="' . $f['forma_entrega_cliente'] . '"> ' . $f['forma_entrega_cliente'] . ' </option>
                                <option value="Enviar a domicilio">Enviar a domicilio</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>DIRECCION DEL ENTREGA</label>
                            <input type="text" class="form-control" name="direccion_residencia" value="' . $f['direccion_residencia'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <button type="submit" class="btn btn-primary update btnActualizarPagoProductoCliente">Modificar Pedido Cliente</button>
                        </div>
                    </div>
                </form>
            ';
        }

    }
    function cargarPagosProductosClientes(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarPagosProductosClientes($id_user);

        // Variable para almacenar el contenido
        $contenidoHTML = '';

        foreach ($result as $f) {
            $nombreProducto = $objConsultas->obtenerNombreProductoPorCodigo($f['codigo_producto']);
            $rolUsuario = $objConsultas->obtenerRolCliente($f['id_usuario']);
            $nombreUsuario = $objConsultas->obtenerNombreUsuario($f['id_usuario']);
            $apellidoUsuario = $objConsultas->obtenerApellidoUsuario($f['id_usuario']);
            $telefonoUsuario = $objConsultas->obtenerTelefonoUsuario($f['id_usuario']);
            echo '
                <article class="body-recibo">
                    <h2 class="recibo-centro">Apreciado(a): ' . $rolUsuario . '</h2>
                    <h3 class="parrafo-centro">Te informamos que tu pedido:</h3>
                    <div class="article-info">
                        <section id="uno">
                            <h4>Con Numero De Referencia: ' . $f['codigo_venta_producto'] . '</h4>
                        </section>
                        <section id="dos">
                            <h5>Fue ' . $f['estado_pedido_cliente'] . '</h5>
                        </section>
                        <section id="tres">
                            <p class="arriba-recibo">Pedido Producto ' . $nombreProducto . '</p>
                            <p class="medio-recibo">Fecha De Entrega: ' . $f['fecha_entrega_cliente'] . ' Hora De Entrega: ' . $f['hora_entrega_cliente'] . '</p>
                            <p class="abajo-recibo">$ '. $f['precio_pedido_cliente'] . '</p>
                        </section>
                    </div>
                    <div class="table-article">
                        <h4 class="info-pa">Los siguientes datos corresponden al pedido:</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="parrafo-lista sombra-abajo">Numero Id.Proveedor</p>
                                <p class="parrafo-lista sombra-abajo">Nombre Cliente</p>
                                <p class="parrafo-lista sombra-abajo">Numero Telefono</p>
                                <p class="parrafo-lista sombra-abajo">Fecha de Entrega</p>
                                <p class="parrafo-lista sombra-abajo">Hora de Entrega</p>
                                <p class="parrafo-lista sombra-abajo">Codigo Producto Solicitado</p>
                                <p class="parrafo-lista sombra-abajo">Empresa</p>
                                <p class="parrafo-lista sombra-abajo">Precio Venta</p>
                                <p class="parrafo-lista sombra-abajo">Medio de Pago</p>
                                <p class="parrafo-lista sombra-abajo">Numero Referencia Pedido</p>
                                <p class="parrafo-lista sombra-abajo">Estado Pedido</p>
                                <p class="parrafo-lista sombra-abajo">Forma de Entrega</p>
                                <p class="parrafo-lista sombra-abajo mb-5">Direccion de Entrega</p>
                            </div>
                            <div class="col-lg-6">
                                <p class="parrafo-valor sombra-abajo">' . $f['id_usuario'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $nombreUsuario . ' ' . $apellidoUsuario . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $telefonoUsuario . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['fecha_entrega_cliente'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['hora_entrega_cliente'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['codigo_producto'] . '</p>
                                <p class="parrafo-valor sombra-abajo">Gimnasio Moderno</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['precio_pedido_cliente'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['metodo_pago_cliente'] . ' Pago contra entrega</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['codigo_venta_producto'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['estado_pedido_cliente'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['forma_entrega_cliente'] . '</p>
                                <p class="parrafo-valor sombra-abajo mb-5">' . $f['direccion_residencia'] . '</p>
                            </div>
                        </div> 
                        <p class="parrafo-valor mb-5 text-center">Copyright © 2023 Gimnasio Moderno. Todos los derechos reservados.</p>  
                    </div>
                </article>                
            ';
        }

    }

?>