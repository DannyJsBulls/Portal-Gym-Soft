<?php
    function mostrarPagosPlanes(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarPagosPlanesAdmin();

        if (!isset($result)) {
            echo '<h2>No hay pedidos de planes registrados en el sistema</h2>';
        }else {
            foreach ($result as $f) {
                $nombrePlan = $objConsultas->obtenerNombrePlanPorCodigo($f['codigo_plan']);
                $nombreUsuario = $objConsultas->obtenerNombreUsuario($f['id_usuario']);
                $apellidoUsuario = $objConsultas->obtenerApellidoUsuario($f['id_usuario']);
                echo '
                    <tr>
                        <td><i class="icofont-fast-delivery planes"></i></td>
                        <td>' . $f['codigo_venta_plan'] . '</td>
                        <td>' . $nombrePlan . '</td>
                        <td>' . $nombreUsuario . ' ' . $apellidoUsuario . '</td>
                        <td>' . $f['forma_entrega'] . '</td>
                        <td>' . $f['fecha_entrega_plan'] . '</td>
                        <td>' . $f['hora_entrega_plan'] . '</td>
                        <td>' . $f['direccion_entrega'] . '</td>
                        <td>' . $f['metodo_pago_plan'] . '</td>
                        <td>' . $f['precio_venta_plan'] . '</td>
                        <td>' . $f['estado_venta_plan'] . '</td>
                        <td><a href="verDetallePagoPlanes.php?id_user=' . $f['codigo_venta_plan'] . '" class="btn btn-info">Remision <i class="icofont-law-document"></i></a></td>
                        <td><a href="verDetallePedidoCliente.php?id_user=' . $f['codigo_venta_plan'] . '" class="btn btn-warning">Pedido <i class="icofont-fast-delivery"></i></a></td>
                        <td><a href="modificarPagos.php?id_user=' . $f['codigo_venta_plan'] . '" class="btn btn-success">Editar <i class="icofont-ui-edit"></i></a></td>
                        <td><a href="../../Controller/eliminarAdmin/eliminarPagosPlanesAdmin.php?id_user=' . $f['codigo_venta_plan'] . '" class="btn btn-danger btnEliminacionPagoPlan">Eliminar <i class="icofont-ui-delete"></i></a></td>
                    </tr>
                ';
            }
        }

    }
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarPagosPlanes(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarPagosPlanes($id_user);

        foreach ($result as $f) {
            echo '
                <form action="../../Controller/modificarAdmin/modificarPagosPlanesAdmin.php" method="POST" name="actualizarPagoPlanForm">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUMERO ASIGNADO PLAN</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo" name="codigo_venta_plan" required="required" readonly value="' . $f['codigo_venta_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FECHA PEDIDO</label>
                            <input type="date" class="form-control" name="fecha_entrega_plan" value="' . $f['fecha_entrega_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>HORA PEDIDO</label>
                            <input type="time" class="form-control" name="hora_entrega_plan" value="' . $f['hora_entrega_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>METODO PAGO</label>
                            <select name="metodo_pago_plan" id="" class="form-control">
                                <option value="' . $f['metodo_pago_plan'] . '"> ' . $f['metodo_pago_plan'] . ' </option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ESTADO PEDIDO</label>
                            <select name="estado_venta_plan" id="" class="form-control">
                                <option value="' . $f['estado_venta_plan'] . '"> ' . $f['estado_venta_plan'] . ' </option>
                                <option value="Comprado">Comprado</option>
                                <option value="Enviado">Enviado</option>
                                <option value="Entregado">Entregado</option>
                                <option value="Devuelto">Devuelto</option>
                                <option value="Vencido">Vencido</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>PRECIO PEDIDO PLAN</label>
                            <input type="number" class="form-control" placeholder="Ingrese el precio" name="precio_venta_plan" value="' . $f['precio_venta_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUM.REFERENCIA PLAN</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo" name="codigo_plan" required="required" readonly value="' . $f['codigo_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>IDENTIFICACION USUARIO</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo" name="id_usuario" required="required" readonly value="' . $f['id_usuario'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FORMA DE ENTREGA</label>
                            <select name="forma_entrega" id="" class="form-control">
                                <option value="' . $f['forma_entrega'] . '"> ' . $f['forma_entrega'] . ' </option>
                                <option value="Enviar a domicilio">Enviar a domicilio</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>DIRECCION DE ENTREGA</label>
                            <input type="text" class="form-control" name="direccion_entrega" value="' . $f['direccion_entrega'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <button type="submit" class="btn btn-primary update btnActualizarPagoPlan">Modificar Pedido</button>
                        </div>
                    </div>
                </form>
            ';
        }

    }
    function cargarPagosPlanesAdmin(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarPagosPlanesAdmin($id_user);

        foreach ($result as $f) {
            $nombrePlan = $objConsultas->obtenerNombrePlanPorCodigo($f['codigo_plan']);
            $rolUsuario = $objConsultas->obtenerRolUsuario($f['id_usuario']);
            $nombreUsuario = $objConsultas->obtenerNombreUsuario($f['id_usuario']);
            $apellidoUsuario = $objConsultas->obtenerApellidoUsuario($f['id_usuario']);
            $telefonoUsuario = $objConsultas->obtenerTelefonoUsuario($f['id_usuario']);
            echo '
                <article class="body-recibo">
                    <h2 class="recibo-centro">Apreciado(a): ' . $rolUsuario . '</h2>
                    <h3 class="parrafo-centro">Te informamos que tu pedido:</h3>
                    <div class="article-info">
                        <section id="uno">
                            <h4>Con Numero De Plan: ' . $f['codigo_venta_plan'] . '</h4>
                        </section>
                        <section id="dos">
                            <h5>Fue ' . $f['estado_venta_plan'] . '</h5>
                        </section>
                        <section id="tres">
                            <p class="arriba-recibo">Pedido Plan Membresia ' . $nombrePlan . '</p>
                            <p class="medio-recibo">Fecha De Entrega: ' . $f['fecha_entrega_plan'] . ' Hora De Entrega: ' . $f['hora_entrega_plan'] . '</p>
                            <p class="abajo-recibo">$ '. $f['precio_venta_plan'] . '</p>
                        </section>
                    </div>
                    <div class="table-article">
                        <h4 class="info-pa">Los siguientes datos corresponden al pedido:</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="parrafo-lista sombra-abajo">Numero Id.Cliente</p>
                                <p class="parrafo-lista sombra-abajo">Nombre Cliente</p>
                                <p class="parrafo-lista sombra-abajo">Numero Telefono</p>
                                <p class="parrafo-lista sombra-abajo">Fecha de Entrega</p>
                                <p class="parrafo-lista sombra-abajo">Hora de Entrega</p>
                                <p class="parrafo-lista sombra-abajo">Empresa</p>
                                <p class="parrafo-lista sombra-abajo">Precio Compra</p>
                                <p class="parrafo-lista sombra-abajo">Medio de Pago</p>
                                <p class="parrafo-lista sombra-abajo">Numero Plan</p>
                                <p class="parrafo-lista sombra-abajo">Estado Pedido</p>
                                <p class="parrafo-lista sombra-abajo">Forma de Entrega</p>
                                <p class="parrafo-lista sombra-abajo mb-5">Direccion de Entrega</p>
                            </div>
                            <div class="col-lg-6">
                                <p class="parrafo-valor sombra-abajo">' . $f['id_usuario'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $nombreUsuario . ' ' . $apellidoUsuario . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $telefonoUsuario . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['fecha_entrega_plan'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['hora_entrega_plan'] . '</p>
                                <p class="parrafo-valor sombra-abajo">Gimnasio Moderno</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['precio_venta_plan'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['metodo_pago_plan'] . ' Pago contra entrega</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['codigo_venta_plan'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['estado_venta_plan'] . '</p>
                                <p class="parrafo-valor sombra-abajo">' . $f['forma_entrega'] . '</p>
                                <p class="parrafo-valor sombra-abajo mb-5">' . $f['direccion_entrega'] . '</p>
                            </div>
                        </div> 
                        <p class="parrafo-valor mb-5 text-center">Copyright © 2023 Gimnasio Moderno. Todos los derechos reservados.</p>  
                    </div>
                </article>                
            ';
        }

    }

?>