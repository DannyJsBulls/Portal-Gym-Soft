<?php 
    // Agrega un parámetro opcional para el código del plan seleccionado
    function mostrarPlanCodigo($planSeleccionado = null) {
        $objConsultas = new Consultas();
        $planes = $objConsultas->mostrarPlanes();  // Obtener la lista de planes

        if (!empty($planes)) {
            foreach ($planes as $plan) {
                if ($plan['codigo_plan'] == $planSeleccionado) {
                    $nombre_plan = $plan['nombre_plan'];
                    break;
                }
            }

            echo '<input type="text" name="nombre_plan" id="nombre_plan_input" class="form-control" value="' . htmlspecialchars($nombre_plan) . '" readonly>';
            echo '<input type="hidden" name="codigo_plan" value="' . $planSeleccionado . '">';  

        } else {
            echo '<h2>No hay planes disponibles</h2>';
        }
    }
        
    function mostrarPlanSeleccion($planSeleccionado = null) {
        $objConsultas = new Consultas();
        $planes = $objConsultas->mostrarPlanes();  // Obtener la lista de planes
        
        if (!empty($planes)) {
            foreach ($planes as $plan) {
                // Verifica si el plan actual es el seleccionado y establece el atributo selected
                $selected = ($plan['codigo_plan'] == $planSeleccionado) ? true : false;
                if ($selected) {
                    return $plan; // Devuelve la información completa del plan seleccionado
                }
            }
        }
    
        return null; // Retorna null si no se encontró el plan
    }

    function mostrarPrecioPlan($planSeleccionado = null) {
        $objConsultas = new Consultas();
        $planes = $objConsultas->mostrarPrecioPlan();  // Obtener el precio del plan
        
        if (!empty($planes)) {
            foreach ($planes as $plan) {
                // Verifica si el plan actual es el seleccionado y establece el atributo selected
                $selected = ($plan['codigo_plan'] == $planSeleccionado) ? true : false;
                if ($selected) {
                    return $plan; // Devuelve la información completa del plan seleccionado
                }
            }
        }
    
        return null; // Retorna null si no se encontró el plan
    }
?>
