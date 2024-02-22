<?php
    function mostrarPerfilUsuario($id_usuario){

        // Traemos la informacion de los usuarios desde el modelo, a partir de la clase y la funcion
        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarPerfilUsuario($id_usuario);

        if (!isset($result)) {
            echo '<h2>No Hay Usuarios Registrados en el Sistema</h2>';
        }else {
            foreach ($result as $f) {
                echo '
                    <img class="perfil-foto-container perfil-foto"src="' . $f['foto_usuario'] . '" alt="Foto Usuario">
                    <h3 class="card-rol mt-3">' . $f['nombres_usuario'] . ' <br> ' . $f['apellidos_usuario'] . '</h3>
                    <p class="rol">' . $f['rol_usuario'] . '</p>
                ';
            }
        }
    }
    
?>