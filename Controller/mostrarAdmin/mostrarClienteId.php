<?php 
    // Función para mostrar el id de usuario por nombre
    function mostrarClienteId($usuarioSeleccionado = null) {
        $objConsultas = new Consultas();
        $clientes = $objConsultas->mostrarClientes();  // Obtener la lista de usuarios clientes
        
        if (!empty($clientes)) {
            echo '<select name="id_usuario" id="id_usuario_select" class="form-control">'; 
            
            echo '<option value="" selected disabled>Seleccione un Cliente</option>';
                    
            foreach ($clientes as $cliente) {
                // Verifica si el plan actual es el seleccionado y establece el atributo selected
                $selected = ($cliente['id_usuario'] == $usuarioSeleccionado) ? 'selected' : '';
                echo '<option value="' . $cliente['id_usuario'] . '" ' . $selected . '>' . $cliente['nombres_usuario'] . ' ' . $cliente['apellidos_usuario'] . '</option>';
            }
        
            echo '</select>';        
        } else {
            echo '<h2>No hay clientes disponibles</h2>';
        }
    }
?>


