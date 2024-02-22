<?php 
    // Agrega un parámetro opcional para el código de la actividad seleccionada
    function mostrarActividadCodigo($actividadSeleccionada = null) {
        $objConsultas = new Consultas();
        $actividades = $objConsultas->mostrarActividades();  // Obtener la lista de actividades
        
        if (!empty($actividades)) {
            foreach ($actividades as $actividad) {
                if ($actividad['codigo_actividad'] == $actividadSeleccionada) {
                    $nombre_actividad = $actividad['nombre_actividad'];
                    break; // Terminamos el bucle una vez que encontramos la actividad seleccionada
                }
            }

            echo '<input type="text" name="nombre_actividad" id="nombre_actividad_input" class="form-control" value="' . htmlspecialchars($nombre_actividad) . '" readonly>';
            echo '<input type="hidden" name="codigo_actividad" value="' . $actividadSeleccionada . '">';  
        } else {
            echo '<h2>No hay actividades disponibles</h2>';
        }
    }
?>
