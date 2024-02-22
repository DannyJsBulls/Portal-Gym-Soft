<?php 
    // Funcion para mostrar el id de usuario por nombre
    function mostrarProveedorId($usuarioSeleccionado = null) {
        $objConsultas = new Consultas();
        $proveedores = $objConsultas->mostrarProveedores();  // Obtener la lista de usuarios proveedores

        if (!empty($proveedores)) {
            foreach ($proveedores as $proveedor) {
                if ($proveedor['id_usuario'] == $usuarioSeleccionado) {
                    $nombre_proveedor = $proveedor['nombres_usuario'];
                    $apellido_proveedor = $proveedor['apellidos_usuario'];
                    break; // Terminamos el bucle una vez que encontramos la proveedor seleccionada
                }
            }

            echo '<input type="text" name="nombres_usuario" id="nombres_usuario_input" class="form-control" value="' . htmlspecialchars($nombre_proveedor . ' ' . $apellido_proveedor) . '" readonly>';
            echo '<input type="hidden" name="id_usuario" value="' . $usuarioSeleccionado . '">';  
        } else {
            echo '<h2>No hay proveedores disponibles</h2>';
        }
    }
    // Agrega un parámetro opcional para el código del producto seleccionado
    function mostrarProductoCoSelect($productoSeleccionado = null) {
        $objConsultas = new Consultas();
        $productos = $objConsultas->mostrarProductos();  // Obtener la lista de productos
        
        if (!empty($productos)) {
            echo '<select name="codigo_producto" id="codigo_producto_select" class="form-control">';  // Asegúrate de abrir el elemento select
    
            echo '<option value="" selected disabled>Seleccione un Producto</option>';
    
            foreach ($productos as $producto) {
                // Verifica si el producto actual es el seleccionado y establece el atributo selected
                $selected = ($producto['codigo_producto'] == $productoSeleccionado) ? 'selected' : '';
                echo '<option value="' . $producto['codigo_producto'] . '" ' . $selected . '>' . $producto['nombre_producto'] . '</option>';
            }
    
            echo '</select>';
        } else {
            echo '<h2>No hay productos disponibles</h2>';
        }
    }
    
?>