<?php
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");
    require_once("../../Controller/mostrarAdmin/mostrarPagosPlanesAdmin.php");
    require_once("../../Model/seguridadAdmin.php");

    // Asegurémonos de que el cliente haya iniciado sesión y obtener su ID de cliente
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
        // mostrarActividadesCliente($id_cliente);
    } else {
        echo '<h2>No se pudo obtener el ID del Entrenador en sesión.</h2>';
    }
?>
<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icofont@3.0.0/dist/icofont.min.css">
        <link rel="stylesheet" href="../Website-Externo/plugins/icofont/icofont.min.css">
        <link rel="stylesheet" href="../Website-Externo/plugins/themify-icons.css">
        <link rel="stylesheet" href="../Dashboard/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Dashboard/css/style.css">
        <title>Dashboard Gym Soft</title>
    </head>
    <body>
        <div class="d-flex">
            <?php 
                include("menu.php");
            ?>
            <!-- <div id="sidebar-container" class="bg-primary">
                <div class="logo">
                    <img src="../../Views/Extras/logos/logo-trnasparente.png" class="img-light" alt="Logo" style="max-width: 100%;">
                </div>
                <nav class="menu">
                    <a href="home.php" class="d-block text-light p-3" class="active"><i class="icofont-home mr-2 lead"></i> Inicio</a>
                    <a href="#" class="d-block text-light p-3"><i class="icofont-users mr-2 lead"></i> Usuarios</a>
                    <a href="#" class="d-block text-light p-3"><i class="icofont-user mr-2 lead"></i> Clientes</a>
                    <a href="#" class="d-block text-light p-3"><i class="icofont-muscle align-icon mr-2 lead"></i> Entrenadores</a>
                    <a href="#" class="d-block text-light p-3"><i class="icofont-live-messenger mr-2 lead"></i> Proveedores</a>
                    <a href="#" class="d-block text-light p-3"><i class="icofont-gym-alt-2 mr-2 lead"></i> Actividades</a>
                    <a href="#" class="d-block text-light p-3"><i class="icofont-tags mr-2 lead"></i> Planes</a>
                    <a href="#" class="d-block text-light p-3"><i class="icofont-dumbbell mr-2 lead"></i> Productos</a>
                    <a href="#" class="d-block text-light p-3"><i class="icofont-exit mr-2 lead"></i> Cerrar Sesion</a>
                </nav>
            </div> -->
            <div class="w-100">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="float-left">
                            <div class="hamburger sidebar-toggle" id="hamburgerBtn" style="margin-right: 10px;">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </div>
                        </div>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                            <button class="btn btn-search" type="submit"><i class="icon ion-md-search"></i></button>
                        </form>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle admin-boton" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Administrador
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="verPerfilAdministrador.php"><i class="icofont-user"></i> Mi Perfil</a>
                                        <a class="dropdown-item" href="#"><i class="icofont-notification"></i> Suscripcion</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../../Controller/cerrarSesion.php" id="cerrarSesionLink"><i class="icofont-exit"></i> Cerrar Sesion</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div id="content">
                    <section class="py-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="font-weight-bold mb-0">Actualizar Pedido De Planes</h1>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="bg-mix">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-title">
                                            <h1 class="title-table">Formulario de Actualizacion</h1>
                                            <p class="parrafo-table">Por favor modifique los campos para actualizar la informacion del pedido del plan</p>
                                        </div>
                                        <div class="card-body">
                                            <?php 
                                                cargarPagosPlanes();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>  
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../Website-Externo/js/actualizar/actualizarPagoPlan.js"></script>
        <script src="../Dashboard/js/inactivity.js"></script>
        <script>
            $(document).ready(function () {
                // Agrega un evento de clic al botón de hamburguesa
                $('.sidebar-toggle').click(function () {
                    // Alterna la visibilidad del menú lateral
                    $('#sidebar-container').animate({
                        width: 'toggle'
                    });
                });
            });
        </script>
    </body>
</html>