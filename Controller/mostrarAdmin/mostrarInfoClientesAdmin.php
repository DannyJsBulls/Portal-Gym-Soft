<?php
    function mostrarInfoClientesAdmin(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarInfoClientesAdmin();

        if (!isset($result)) {
            echo '<h2>No hay clientes registrados en el sistema</h2>';
        }else {
            foreach ($result as $f) {
                echo '
                    <tr>
                        <td><img src="' . $f['foto_usuario'] . '" width="100px" alt="Foto de Usuario"></td>
                        <td>' . $f['id_usuario'] . '</td>
                        <td>' . $f['tipo_documento_usuario'] . '</td>
                        <td>' . $f['nombres_usuario'] . '</td>
                        <td>' . $f['apellidos_usuario'] . '</td>
                        <td>' . $f['fecha_nacimiento_usuario'] . '</td>
                        <td>' . $f['email_usuario'] . '</td>
                        <td>' . $f['telefono_usuario'] . '</td>
                        <td>' . $f['estado_usuario'] . '</td>
                        <td>' . $f['rol_usuario'] . '</td>
                        <td>' . $f['clavemd'] . '</td>
                        <td><a href="modificarCliente.php?id_user=' . $f['id_usuario'] . '" class="btn btn-success"> Ver/Editar</a></td>
                        <td><a href="../../Controller/eliminarAdmin/eliminarClienteAdmin.php?id_user=' . $f['id_usuario'] . '" class="btn btn-danger btnEliminacionCliente"> Eliminar <i class="icofont-ui-delete"></i></a></td>
                    </tr>
                ';
            }
        }

    }
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarCliente(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarCliente($id_user);

        foreach ($result as $f) {
            echo '
                <form action="../../Controller/modificarAdmin/modificarClienteAdmin.php" method="POST" enctype="multipart/form-data" name="actualizarClienteForm">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FOTO</label>
                            <img src="' . $f['foto_usuario'] . '" width="100px" alt="Foto de Usuario">
                            <input type="file"  accept=".png, .jpg, .gif" name="foto_usuario" class="form-control" >
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUMERO IDENTIFICACION</label>
                            <input type="number" class="form-control" placeholder="Ingrese el numero" name="id_usuario" required="required" readonly value="' . $f['id_usuario'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>TIPO DE DOCUMENTO</label>
                            <select name="tipo_documento_usuario" id="" class="form-control">
                                <option value="' . $f['tipo_documento_usuario'] . '"> ' . $f['tipo_documento_usuario'] . ' </option>
                                <option value="CC">CC</option>
                                <option value="CE">CE</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NOMBRES</label>
                            <input type="text" class="form-control" placeholder="Ingrese los nombres" name="nombres_usuario" value="' . $f['nombres_usuario'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>APELLIDOS</label>
                            <input type="text" class="form-control" placeholder="Ingrese los apellidos" name="apellidos_usuario" value="' . $f['apellidos_usuario'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FECHA DE NACIMIENTO</label>
                            <input type="date" class="form-control" name="fecha_nacimiento_usuario" value="' . $f['fecha_nacimiento_usuario'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>EMAIL</label>
                            <input type="email" class="form-control" placeholder="Ingrese un email" name="email_usuario" value="' . $f['email_usuario'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>TELEFONO</label>
                            <input type="number" class="form-control" placeholder="Ingrese un numero de telefono" name="telefono_usuario" value="' . $f['telefono_usuario'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ESTADO</label>
                            <select name="estado_usuario" id="" class="form-control">
                                <option value="' . $f['estado_usuario'] . '"> ' . $f['estado_usuario'] . ' </option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ROL</label>
                            <select name="rol_usuario" id="" class="form-control">
                                <option value="' . $f['rol_usuario'] . '"> ' . $f['rol_usuario'] . ' </option>
                                <option value="Cliente">Cliente</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>CONTRASEÑA</label>
                            <input type="password" class="form-control" placeholder="Ingrese una Contraseña" name="clavemd" value="' . $f['clavemd'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <button type="submit" class="btn btn-primary update btnActualizarCliente">Modificar Datos</button>
                        </div>
                    </div>
                </form>
            ';
        }

    }

?>