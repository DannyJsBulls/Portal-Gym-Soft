<?php
    function mostrarActividades(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarActividadesAdmin();

        if (!isset($result)) {
            echo '<h2>No hay actividades registradas en el sistema</h2>';
        }else {
            foreach ($result as $f) {
                echo '
                    <tr>
                        <td><img src="' . $f['foto_actividad'] . '" width="100px" alt="Foto de Actividad"></td>
                        <td>' . $f['codigo_actividad'] . '</td>
                        <td>' . $f['nombre_actividad'] . '</td>
                        <td>' . $f['descripcion_actividad'] . '</td>
                        <td>' . $f['tipo_actividad'] . '</td>
                        <td>' . $f['requisitos_actividad'] . '</td>
                        <td>' . $f['estado_actividad'] . '</td>
                        <td>' . $f['objetivos_actividad'] . '</td>
                        <td>' . $f['area_actividad'] . '</td>
                        <td><a href="modificarActividades.php?id_user=' . $f['codigo_actividad'] . '" class="btn btn-success">Editar <i class="icofont-ui-edit"></i></a></td>
                        <td><a href="../../Controller/eliminarAdmin/eliminarActividadesAdmin.php?id_user=' . $f['codigo_actividad'] . '" class="btn btn-danger btnEliminacionActividad">Eliminar <i class="icofont-ui-delete"></i></a></td>
                    </tr>
                ';
            }
        }

    }
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarActividades(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarActividades($id_user);

        foreach ($result as $f) {
            echo '
                <form action="../../Controller/modificarAdmin/modificarActividadesAdmin.php" method="POST" enctype="multipart/form-data" name="actualizarActividadForm">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FOTO</label>
                            <img src="' . $f['foto_actividad'] . '" width="100px" alt="Foto de Usuario">
                            <input type="file"  accept=".png, .jpg, .gif" name="foto_actividad" class="form-control" >
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUM.REFERENCIA ACTIVIDAD</label>
                            <input type="number" class="form-control" placeholder="Ingrese un numero" name="codigo_actividad" required="required" readonly value="' . $f['codigo_actividad'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NOMBRE ACTIVIDAD</label>
                            <input type="text" class="form-control" placeholder="Ingrese el nombre" name="nombre_actividad" value="' . $f['nombre_actividad'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>DESCRIPCION</label>
                            <input type="text" class="form-control" name="descripcion_actividad" value="' . $f['descripcion_actividad'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>TIPO ACTIVIDAD</label>
                            <select name="tipo_actividad" id="" class="form-control">
                                <option value="' . $f['tipo_actividad'] . '"> ' . $f['tipo_actividad'] . '</option>
                                <option value="Fuerza">Fuerza</option>
                                <option value="Aerobics">Aerobics</option>
                                <option value="Flexibilidad">Flexibilidad</option>
                                <option value="Resistencia">Resistencia</option>
                                <option value="Combate">Combate</option>
                            </select>
                        </div>
                        <div class="form-group  col-lg-4 col-md-6">
                            <label>REQUISITOS</label>
                            <input type="text" class="form-control" placeholder="Ingrese los requisitos" name="requisitos_actividad" value="' . $f['requisitos_actividad'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ESTADO ACTIVIDAD</label>
                            <select name="estado_actividad" id="" class="form-control">
                                <option value="' . $f['estado_actividad'] . '"> ' . $f['estado_actividad'] . '</option>
                                <option value="Disponible">Disponible</option>
                                <option value="Inactiva">Inactiva</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>OBJETIVOS ACTIVIDAD</label>
                            <input type="textarea" class="form-control" placeholder="Ingrese los objetivos de la actividad" name="objetivos_actividad" value="' . $f['objetivos_actividad'] . '">
                        </div>
                        <div class="form-group  col-lg-4 col-md-6">
                            <label>AREA ACTIVIDAD</label>
                            <input type="text" class="form-control" placeholder="Ingrese el area de la actividad" name="area_actividad" value="' . $f['area_actividad'] . '">
                        </div>
                        <div class="form-group  col-lg-4 col-md-6">
                            <button type="submit" class="btn btn-primary update btnActualizarActividad">Modificar Datos</button>
                        </div>
                    </div>
                </form>
            ';
        }

    }

?>