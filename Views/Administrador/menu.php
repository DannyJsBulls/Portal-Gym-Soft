<?php 
    require_once('../../Controller/mostrarPerfilUsuario.php'); // Ruta correcta a mostrarPerfilUsuario.php
?>
<div id="sidebar-container" class="bg-primary">
    <div class="logo">
        <img src="../../Views/Extras/logos/logo-trnasparente.png" class="img-light" alt="Logo" style="max-width: 100%;">
    </div>
    <div class="perfil-foto-container">
        <div class="perfil-foto">
            <?php 
                if(isset($id_usuario)){
                    mostrarPerfilUsuario($id_usuario);
                }
            ?>
        </div>
    </div>
    <nav  id="sidebar" class="menu">
        <a href="home.php" class="d-block text-light p-3 item"><i class="icofont-home mr-2 lead"></i> Inicio</a>
        <a href="verUsuarios.php" class="d-block text-light p-3 item"><i class="icofont-users mr-2 lead"></i> Usuarios</a>
        <a href="verTablaClientes.php" class="d-block text-light p-3 item"><i class="icofont-user mr-2 lead"></i> Clientes</a>
        <a href="verTablaEntrenadores.php" class="d-block text-light p-3 item"><i class="icofont-muscle align-icon mr-2 lead"></i> Entrenadores</a>
        <a href="verTablaProveedores.php" class="d-block text-light p-3 item"><i class="icofont-live-messenger mr-2 lead"></i> Proveedores</a>
        <a href="verActividades.php" class="d-block text-light p-3 item"><i class="icofont-gym-alt-3 mr-2 lead"></i> Actividades</a>
        <a href="verInscripcionesLibres.php" class="d-block text-light p-3 item"><i class="icofont-file-alt mr-2 lead"></i> Inscripciones Libres</a>
        <a href="verInscripcionesPerso.php" class="d-block text-light p-3 item"><i class="icofont-file-alt mr-2 lead"></i> Inscripciones Personalizadas</a>
        <a href="verPlanes.php" class="d-block text-light p-3 item"><i class="icofont-tags mr-2 lead"></i> Planes</a>
        <a href="verPagos.php" class="d-block text-light p-3 item"><i class="icofont-fast-delivery mr-2 lead"></i> Pedidos Planes</a>
        <a href="verProductos.php" class="d-block text-light p-3 item"><i class="icofont-dumbbell mr-2 lead"></i> Productos</a>
        <a href="verOrdenCompras.php" class="d-block text-light p-3 item"><i class="icofont-fast-delivery mr-2 lead"></i> Pedidos Proveedores</a>
        <a href="verVentasClientes.php" class="d-block text-light p-3 item"><i class="icofont-fast-delivery mr-2 lead"></i> Pedidos Productos</a>
        <a href="../../Controller/cerrarSesion.php" class="d-block text-light p-3 item"><i class="icofont-exit mr-2 lead"></i> Cerrar Sesion</a>
    </nav>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var menu = document.getElementById('sidebar');
        var links = menu.getElementsByTagName('a');
        var cerrarSesionLink = document.getElementById('cerrarSesionLink');

        // Recuperar la página activa almacenada en localStorage
        var activePage = localStorage.getItem('activePage');

        // Si la sesión ha sido cerrada o es la primera visita, establecer la página activa en "Inicio"
        if (!activePage || activePage === 'cerrarSesion') {
            activePage = 'home';
            // Eliminar la entrada correspondiente al activePage en localStorage
            localStorage.removeItem('activePage');
        }

        // Establecer la clase "active" en el enlace correspondiente
        for (var i = 0; i < links.length; i++) {
            var linkPage = links[i].href.split('/').pop().split('.').shift();

            if (activePage === linkPage) {
                links[i].classList.add('active');
                break;
            }
        }

        // Agregar un controlador de clic a todos los enlaces del menú
        for (var i = 0; i < links.length; i++) {
            links[i].addEventListener('click', function() {
                // Almacenar la página activa en localStorage
                localStorage.setItem('activePage', this.href.split('/').pop().split('.').shift());
            });
        }

        // Agregar un controlador de clic específico para el enlace de cerrar sesión
        cerrarSesionLink.addEventListener('click', function() {
            // Al cerrar sesión, establecer la página activa en "Inicio"
            localStorage.setItem('activePage', 'home');
        });
    });
</script>








