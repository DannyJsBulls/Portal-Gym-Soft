<?php 
    // Agrega un parámetro opcional para el código del producto seleccionado
    function mostrarProductoCodigo($productoSeleccionado = null) {
        $objConsultas = new Consultas();
        $productos = $objConsultas->mostrarProductos();  // Obtener la lista de productos

        if (!empty($productos)) {
            foreach ($productos as $producto) {
                if ($producto['codigo_producto'] == $productoSeleccionado) {
                    $nombre_producto = $producto['nombre_producto'];
                    break;
                }
            }

            echo '<input type="text" name="nombre_producto" id="nombre_producto_input" class="form-control" value="' . htmlspecialchars($nombre_producto) . '" readonly>';
            echo '<input type="hidden" name="codigo_producto" value="' . $productoSeleccionado . '">';  

        } else {
            echo '<h2>No hay productos disponibles</h2>';
        }
    }
        
    function mostrarProductoSeleccion($productoSeleccionado = null) {
        $objConsultas = new Consultas();
        $productos = $objConsultas->mostrarProductos();  // Obtener la lista de productos
        
        if (!empty($productos)) {
            foreach ($productos as $producto) {
                // Verifica si el plan actual es el seleccionado y establece el atributo selected
                $selected = ($producto['codigo_producto'] == $productoSeleccionado) ? true : false;
                if ($selected) {
                    return $producto; // Devuelve la información completa del plan seleccionado
                }
            }
        }
    
        return null; // Retorna null si no se encontró el plan
    }

    function mostrarProductoImagen($productoSeleccionado = null) {
        $objConsultas = new Consultas();
        $productos = $objConsultas->mostrarProductosImg();  // Obtener la imagen del producto seleccionado
        
        if (!empty($productos)) {
            foreach ($productos as $producto) {
                // Verifica si el plan actual es el seleccionado y establece el atributo selected
                $selected = ($producto['codigo_producto'] == $productoSeleccionado) ? true : false;
                if ($selected) {
                    return $producto; // Devuelve la información completa del plan seleccionado
                }
            }
        }
    
        return null; // Retorna null si no se encontró el plan
    }

    function mostrarPrecioProducto($productoSeleccionado = null) {
        $objConsultas = new Consultas();
        $productos = $objConsultas->mostrarPrecioProducto();  // Obtener el precio del producto
        
        if (!empty($productos)) {
            foreach ($productos as $producto) {
                // Verifica si el plan actual es el seleccionado y establece el atributo selected
                $selected = ($producto['codigo_producto'] == $productoSeleccionado) ? true : false;
                if ($selected) {
                    return $producto; // Devuelve la información completa del plan seleccionado
                }
            }
        }
    
        return null; // Retorna null si no se encontró el plan
    }
?>