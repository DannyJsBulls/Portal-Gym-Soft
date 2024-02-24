<?php
    function mostrarCompras(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarComprasAdmin();

        if (!isset($result)) {
            echo '<h2>No hay pedidos de productos a proveedores registrados en el sistema</h2>';
        }else {
            foreach ($result as $f) {
                $nombreProducto = $objConsultas->obtenerNombreProductoPorCodigo($f['codigo_producto']);
                $nombreUsuario = $objConsultas->obtenerNombreUsuario($f['id_usuario']);
                $apellidoUsuario = $objConsultas->obtenerApellidoUsuario($f['id_usuario']);
                echo '
                    <tr>
                        <td><i class="icofont-fast-delivery planes"></i></td>
                        <td>' . $f['codigo_compra_proveedor'] . '</td>
                        <td>' . $nombreProducto . '</td>
                        <td>' . $nombreUsuario . ' ' . $apellidoUsuario . '</td>
                        <td>' . $f['forma_entrega_proveedor'] . '</td>
                        <td>' . $f['fecha_entrega_proveedor'] . '</td>
                        <td>' . $f['hora_entrega_proveedor'] . '</td>
                        <td>' . $f['direccion_gimnasio'] . '</td>
                        <td>' . $f['metodo_pago_proveedor'] . '</td>
                        <td>' . $f['cantidad_pedido_proveedor'] . '</td>
                        <td>' . $f['precio_pedido_proveedor'] . '</td>
                        <td>' . $f['estado_pedido_proveedor'] . '</td>
                        <td><a href="verDetallePagoProductosProvee.php?id_user=' . $f['codigo_compra_proveedor'] . '" class="btn btn-info">Remision <i class="icofont-law-document"></i></a></td>
                        <td><a href="verPedidoProductoProvee.php?id_user=' . $f['codigo_compra_proveedor'] . '" class="btn btn-warning">Pedido <i class="icofont-fast-delivery"></i></a></td>
                        <td><a href="modificarPagosProvee.php?id_user=' . $f['codigo_compra_proveedor'] . '" class="btn btn-success">Editar <i class="icofont-ui-edit"></i></a></td>
                        <td><a href="../../Controller/eliminarAdmin/eliminarPagosProductosProveeAdmin.php?id_user=' . $f['codigo_compra_proveedor'] . '" class="btn btn-danger btnEliminacionPagoProductoProvee"> Eliminar <i class="icofont-ui-delete"></i></a></td>
                    </tr>
                ';
            }
        }

    }
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarCompras(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarCompras($id_user);

        foreach ($result as $f) {
            echo '
                <form action="../../Controller/modificarAdmin/modificarComprasAdmin.php" method="POST" name="actualizarPagoProductoProveeForm">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUMERO PEDIDO</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo" name="codigo_compra_proveedor" required="required" readonly value="' . $f['codigo_compra_proveedor'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FECHA PEDIDO</label>
                            <input type="date" class="form-control" name="fecha_entrega_proveedor" value="' . $f['fecha_entrega_proveedor'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>HORA PEDIDO</label>
                            <input type="time" class="form-control" name="hora_entrega_proveedor" value="' . $f['hora_entrega_proveedor'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>METODO PAGO</label>
                            <select name="metodo_pago_proveedor" id="" class="form-control">
                                <option value="' . $f['metodo_pago_proveedor'] . '"> ' . $f['metodo_pago_proveedor'] . ' </option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ESTADO PEDIDO</label>
                            <select name="estado_pedido_proveedor" id="" class="form-control">
                                <option value="' . $f['estado_pedido_proveedor'] . '"> ' . $f['estado_pedido_proveedor'] . ' </option>
                                <option value="Comprado">Comprado</option>
                                <option value="Enviado">Enviado</option>
                                <option value="Entregado">Entregado</option>
                                <option value="Devuelto">Devuelto</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>PRECIO COMPRA</label>
                            <input type="number" class="form-control" placeholder="Ingrese el precio" name="precio_pedido_proveedor" value="' . $f['precio_pedido_proveedor'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUM.REFERENCIA PRODUCTO</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo" name="codigo_producto" required="required" readonly value="' . $f['codigo_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>IDENTIFICACION PROVEEDOR</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo" name="id_usuario" required="required" readonly value="' . $f['id_usuario'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FORMA DE ENTREGA</label>
                            <select name="forma_entrega_proveedor" id="" class="form-control">
                                <option value="' . $f['forma_entrega_proveedor'] . '"> ' . $f['forma_entrega_proveedor'] . ' </option>
                                <option value="Enviar a domicilio">Enviar a domicilio</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>DIRECCION DEL GIMNASIO</label>
                            <input type="text" class="form-control" name="direccion_gimnasio" value="' . $f['direccion_gimnasio'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>CANTIDAD DE PRODUCTOS</label>
                            <input type="number" class="form-control" name="cantidad_pedido_proveedor" value="' . $f['cantidad_pedido_proveedor'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <button type="submit" class="btn btn-primary update btnActualizarPagoProductoProvee">Modificar Pedido Proveedor</button>
                        </div>
                    </div>
                </form>
            ';
        }

    }
    function cargarPagosProductosProveedores(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarPagosProductosProveedores($id_user);

        // Variable para almacenar el contenido
        $contenidoHTML = '';

        foreach ($result as $f) {
            $nombreProducto = $objConsultas->obtenerNombreProductoPorCodigo($f['codigo_producto']);
            $rolUsuario = $objConsultas->obtenerRolProveedor($f['id_usuario']);
            $nombreProveedor = $objConsultas->obtenerNombreProveedor($f['id_usuario']);
            $apellidoProveedor = $objConsultas->obtenerApellidoProveedor($f['id_usuario']);
            $telefonoProveedor = $objConsultas->obtenerTelefonoProveedor($f['id_usuario']);
            echo '
                <article class="body-recibo">
                    <h2 class="recibo-centro">Apreciado(a): ' . $rolUsuario . '</h2>
                    <h3 class="parrafo-centro">Te informamos que tu pedido:</h3>
                    <div class="article-info">
                        <section id="uno">
                            <h4>Con Numero De Referencia: ' . $f['codigo_compra_proveedor'] . '</h4>
                        </section>
                        <section id="dos">
                            <h5>Fue ' . $f['estado_pedido_proveedor'] . '</h5>
                        </section>
                        <section id="tres">
                            <p class="arriba-recibo">Pedido Producto ' . $nombreProducto . '</p>
                            <p class="medio-recibo">Fecha De Entrega: ' . $f['fecha_entrega_proveedor'] . ' Hora De Entrega: ' . $f['hora_entrega_proveedor'] . '</p>
                            <p class="abajo-recibo">$ '. $f['precio_pedido_proveedor'] . '</p>
                        </section>
                    </div>
                    <div class="table-article">
                        <h4 class="info-pa">Los siguientes datos corresponden al pedido:</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="parrafo-lista sombra-abajo">Numero Id.Proveedor</p>
                                <p class="parrafo-lista sombra-abajo">Nombre Proveedor</p>
                                <p class="parrafo-lista sombra-abajo">Numero Telefono</p>
                                <p class="parrafo-lista sombra-abajo">Fecha de Entrega</p>
                                <p class="parrafo-lista sombra-abajo">Hora de Entrega</p>
                                <p class="parrafo-lista sombra-abajo">Codigo Producto Solicitado</p>
                                <p class="parrafo-lista sombra-abajo">Cantidad de Productos</p>
                                <p class="parrafo-lista sombra-abajo">Empresa</p>
                                <p class="parrafo-lista sombra-abajo">Precio Compra</p>
                                <p class="parrafo-lista sombra-abajo">Medio de Pago</p>
                                <p class="parrafo-lista sombra-abajo">Numero Referencia Pedido</p>
                                <p class="parrafo-lista sombra-abajo">Estado Pedido</p>
                                <p class="parrafo-lista sombra-abajo">Forma de Entrega</p>
                                <p class="parrafo-lista sombra-abajo mb-5">Direccion de Entrega</p>
                            </div>
                            <div class="col-lg-6">
                                <p class="parrafo-valor sombra-abajo">' . $f['id_usuario'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $nombreProveedor . ' ' . $apellidoProveedor . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $telefonoProveedor . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['fecha_entrega_proveedor'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['hora_entrega_proveedor'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['codigo_producto'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['cantidad_pedido_proveedor'] . '</p>
                                <p class="parrafo-valor sombra-abajo">Gimnasio Moderno</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['precio_pedido_proveedor'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['metodo_pago_proveedor'] . ' Pago contra entrega</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['codigo_compra_proveedor'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['estado_pedido_proveedor'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['forma_entrega_proveedor'] . '</p>
                                <p class="parrafo-valor sombra-abajo mb-5">' . $f['direccion_gimnasio'] . '</p>
                            </div>
                        </div> 
                        <p class="parrafo-valor mb-5 text-center">Copyright © 2023 Gimnasio Moderno. Todos los derechos reservados.</p>  
                    </div>
                </article>                
            ';
        }

    }

?>