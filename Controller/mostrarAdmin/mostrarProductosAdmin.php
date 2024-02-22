<?php
    function mostrarProductos(){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarProductosAdmin();

        if (!isset($result)) {
            echo '<h2>No hay productos de gimnasio registrados en el sistema</h2>';
        }else {
            foreach ($result as $f) {
                echo '
                    <tr>
                        <td><img src="' . $f['foto_producto'] . '" width="100px" alt="Foto de Producto"></td>
                        <td>' . $f['codigo_producto'] . '</td>
                        <td>' . $f['nombre_producto'] . '</td>
                        <td>' . $f['descripcion_producto'] . '</td>
                        <td>' . $f['cantidad_productos_disponibles'] . '</td>
                        <td>' . $f['fecha_vencimiento_producto'] . '</td>
                        <td>' . $f['categoria_producto'] . '</td>
                        <td>' . $f['marca_producto'] . '</td>
                        <td>' . $f['estado_producto'] . '</td>
                        <td>' . $f['precio_inicial_producto'] . '</td>
                        <td>' . $f['porcentaje_ganancia_producto'] . '</td>
                        <td>' . $f['precio_final_producto'] . '</td>
                        <td><a href="modificarProductos.php?id_user=' . $f['codigo_producto'] . '" class="btn btn-success"> Ver/Editar</a></td>
                        <td><a href="../../Controller/eliminarAdmin/eliminarProductosAdmin.php?id_user=' . $f['codigo_producto'] . '" class="btn btn-danger btnEliminacionProducto"> Eliminar <i class="icofont-ui-delete"></i></a></td>
                    </tr>
                ';
            }
        }

    }
    // Funcion para mostrar la info del usuario a modificar en un formulario
    function cargarProductos(){
        $id_user = $_GET['id_user'];

        $objConsultas = new Consultas();
        $result = $objConsultas->buscarProductos($id_user);

        foreach ($result as $f) {
            echo '
                <form action="../../Controller/modificarAdmin/modificarProductosAdmin.php" method="POST" enctype="multipart/form-data" name="actualizarProductoForm">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label>FOTO</label>
                            <img src="' . $f['foto_producto'] . '" width="100px" alt="Foto de Producto">
                            <input type="file"  accept=".png, .jpg, .gif" name="foto_producto" class="form-control" >
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NUM.REFERENCIA PRODUCTO</label>
                            <input type="number" class="form-control" placeholder="Ingrese un codigo" name="codigo_producto" required="required" readonly value="' . $f['codigo_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>NOMBRE PRODUCTO</label>
                            <input type="text" class="form-control" placeholder="Ingrese un nombre" name="nombre_producto" value="' . $f['nombre_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>DESCRIPCION PRODUCTO</label>
                            <input type="textarea" class="form-control" placeholder="Ingrese una descripcion" name="descripcion_producto" value="' . $f['descripcion_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>CANTIDAD DE PRODUCTOS DISPONIBLES</label>
                            <input type="number" class="form-control" placeholder="Ingrese un valor" name="cantidad_productos_disponibles" value="' . $f['cantidad_productos_disponibles'] . '">
                        </div>
                        <div class="form-group  col-lg-4 col-md-6">
                            <label>FECHA VENCIMIENTO</label>
                            <input type="date" class="form-control" name="fecha_vencimiento_producto" value="' . $f['fecha_vencimiento_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>CATEGORIA</label>
                            <select name="categoria_producto" id="" class="form-control">
                                <option value="' . $f['categoria_producto'] . '"> ' . $f['categoria_producto'] . ' </option>
                                <option value="Nutricion Deportiva">Nutricion Deportiva</option>
                                <option value="Accesorios de Entrenamiento">Accesorios de Entrenamiento</option>
                                <option value="Ropa Deportiva">Ropa Deportiva</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>MARCA PRODUCTO</label>
                            <input type="text" class="form-control" placeholder="Ingrese la marca" name="marca_producto" value="' . $f['marca_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>ESTADO</label>
                            <select name="estado_producto" id="" class="form-control">
                                <option value="' . $f['estado_producto'] . '"> ' . $f['estado_producto'] . ' </option>
                                <option value="Disponible">Disponible</option>
                                <option value="Agotado">Agotado</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>PRECIO INICIAL</label>
                            <input type="number" class="form-control" placeholder="Ingrese el precio" name="precio_inicial_producto" value="' . $f['precio_inicial_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>PORCENTAJE GANANCIA</label>
                            <input type="number" class="form-control" placeholder="Ingrese un porcentaje" name="porcentaje_ganancia_producto" step="0.1" value="' . $f['porcentaje_ganancia_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label>PRECIO FINAL</label>
                            <input type="number" class="form-control" placeholder="Ingrese el precio" name="precio_final_producto" step="0.1" value="' . $f['precio_final_producto'] . '">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <button type="submit" class="btn btn-primary update btnActualizarProducto">Actualizar Producto</button>
                        </div>
                    </div> 
                </form>
            ';
        }

    }

?>