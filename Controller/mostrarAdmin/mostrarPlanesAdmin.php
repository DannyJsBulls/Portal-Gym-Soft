<?php
    function mostrarPlanes(){
        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarPlanesAdmin();

        if (!isset($result)) {
            echo '<h2>No hay planes registrados en el sistema</h2>';
        }else {
            foreach ($result as $f) {
                echo '
                    <tr>
                        <td><i class="icofont-tags planes"></i></td>
                        <td>' . $f['codigo_plan'] . '</td>
                        <td>' . $f['nombre_plan'] . '</td>
                        <td>' . $f['descripcion_plan'] . '</td>
                        <td>' . $f['precio_plan'] . '</td>
                        <td>' . $f['porcentaje_ganancia_plan'] . '</td>
                        <td>' . $f['precio_final_plan'] . '</td>
                        <td>' . $f['duracion_plan'] . '</td>
                        <td>' . $f['acceso_servicios_plan'] . '</td>
                        <td>' . $f['restricciones_plan'] . '</td>
                        <td>' . $f['estado_plan'] . '</td>
                        <td>' . $f['descuentos_plan'] . '</td>
                        <td>' . $f['categoria_plan'] . '</td>
                        <td><a href="modificarPlanes.php?id_user=' . $f['codigo_plan'] . '" class="btn btn-success">Editar <i class="icofont-ui-edit"></i></a></td>
                        <td><a href="../../Controller/eliminarAdmin/eliminarPlanesAdmin.php?id_user=' . $f['codigo_plan'] . '" class="btn btn-danger btnEliminacionPlan">Eliminar <i class="icofont-ui-delete"></i></a></td>
                    </tr>
                ';
            }
        }
    }
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarPlanes(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarPlanes($id_user);

        foreach ($result as $f) {
            echo '
                <form action="../../Controller/modificarAdmin/modificarPlanesAdmin.php" method="POST" name="actualizarPlanForm">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUM.REFERENCIA PLAN</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo de pago de un plan" name="codigo_plan" required="required" readonly value="' . $f['codigo_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NOMBRE DEL PLAN</label>
                            <input type="text" class="form-control" placeholder="Ingrese un nombre de un plan" name="nombre_plan" value="' . $f['nombre_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>DESCRIPCION DEL PLAN</label>
                            <input type="text" class="form-control" placeholder="Ingrese una descripcion del plan" name="descripcion_plan" value="' . $f['descripcion_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>PRECIO PLAN</label>
                            <input type="number" class="form-control" placeholder="Ingrese un precio" name="precio_plan" value="' . $f['precio_plan'] . '" step = "0.1">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>PRECIO PLAN</label>
                            <input type="number" class="form-control" placeholder="Ingrese un precio" name="precio_plan" value="' . $f['precio_plan'] . '" step = "0.1">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>PORCENTAJE GANANCIA</label>
                            <input type="text" class="form-control" placeholder="Ingrese un porcentaje" name="porcentaje_ganancia_plan" value="' . $f['porcentaje_ganancia_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>PRECIO FINAL</label>
                            <input type="text" class="form-control" placeholder="Ingrese un precio" name="precio_final_plan" value="' . $f['precio_final_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>DURACION PLAN</label>
                            <input type="text" class="form-control" placeholder="Cuanto dura el plan" name="duracion_plan" value="' . $f['duracion_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ACCESO A SERVICIOS DEL PLAN</label>
                            <input type="text" class="form-control" placeholder="Ingrese que servicios ofrece el plan" name="acceso_servicios_plan" value="' . $f['acceso_servicios_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>RESTRICCIONES DEL PLAN</label>
                            <input type="text" class="form-control" placeholder="Ingrese las restricciones que tiene el plan" name="restricciones_plan" value="' . $f['restricciones_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ESTADO PLAN</label>
                            <select name="estado_plan" id="" class="form-control">
                                <option value="' . $f['estado_plan'] . '"> ' . $f['estado_plan'] . ' </option>
                                <option value="Disponible">DISPONIBLE</option>
                                <option value="Inactivo">INACTIVO</option>
                                <option value="Pausado">PAUSADO</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>DESCUENTOS DEL PLAN</label>
                            <input type="text" class="form-control" placeholder="Ingrese el descuento que ofrece el plan" name="descuentos_plan" value="' . $f['descuentos_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>CATEGORIA DEL PLAN</label>
                            <input type="text" class="form-control" placeholder="Ingrese una categora de actividades" name="categoria_plan" value="' . $f['categoria_plan'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <button type="submit" class="btn btn-primary update btnActualizarPlan">Modificar Datos</button>
                        </div>
                    </div>
                </form>
            ';
        }
    }
?>