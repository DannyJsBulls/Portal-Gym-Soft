<?php 
    // Función para mostrar el id de usuario por nombre
    function mostrarEntrenadorId($usuarioSeleccionado = null) {
        $objConsultas = new Consultas();
        $entrenadores = $objConsultas->mostrarEntrenadores();  // Obtener la lista de usuarios entrenadores
        
        if (!empty($entrenadores)) {
            foreach ($entrenadores as $entrenador) {
                if ($entrenador['id_usuario'] == $usuarioSeleccionado) {
                    $nombre_entrenador = $entrenador['nombres_usuario'] . ' ' . $entrenador['apellidos_usuario'];
                    break; // Terminamos el bucle una vez que encontramos el entrenador seleccionado
                }
            }

            echo '<input type="text" name="nombre_entrenador" id="nombre_entrenador_input" class="form-control" value="' . htmlspecialchars($nombre_entrenador) . '" readonly>';
            echo '<input type="hidden" name="id_entrenador" value="' . $usuarioSeleccionado . '">';  
        } else {
            echo '<h2>No hay entrenadores disponibles</h2>';
        }
    }
    // Agrega un parámetro opcional para el código de la actividad seleccionada
    function mostrarActividadCoSelect($actividadSeleccionada = null) {
        $objConsultas = new Consultas();
        $actividades = $objConsultas->mostrarActividadesInscrip();  // Obtener la lista de actividades
        
        if (!empty($actividades)) {
            echo '<select name="codigo_actividad" id="codigo_actividad_select" class="form-control">';  // Asegúrate de abrir el elemento select
    
            echo '<option value="" selected disabled>Seleccione una Actividad</option>';
    
            foreach ($actividades as $actividad) {
                // Verifica si el producto actual es el seleccionado y establece el atributo selected
                $selected = ($actividad['codigo_actividad'] == $actividadSeleccionada) ? 'selected' : '';
                echo '<option value="' . $actividad['codigo_actividad'] . '" ' . $selected . '>' . $actividad['nombre_actividad'] . '</option>';
            }
    
            echo '</select>';
        } else {
            echo '<h2>No hay actividades disponibles</h2>';
        }
    }
    
?>