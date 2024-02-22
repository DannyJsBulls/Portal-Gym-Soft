<?php
    // importamos las dependencias
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");
    require_once("../../Controller/mostrarAdmin/mostrarProductoCodigo.php");
    require_once("../../Controller/mostrarAdmin/mostrarClienteId.php");
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
                                    <h1 class="font-weight-bold mb-0">Registrar Pedidos de Productos a Clientes</h1>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="bg-mix">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 my-3">
                                    <div class="card">
                                        <div class="card-title">
                                            <h1 class="title-table">Formulario de Registro</h1>
                                            <p class="parrafo-table">Por favor complete los campos para registrar un pedido de un producto</p>
                                        </div>
                                        <div class="card-body fresh">
                                            <form class="my-2 overflow-hidden" action="../../Controller/registrarAdmin/registrarVentasClientesAdmin.php" method="POST" name="registroVentaProductoForm">
                                                <section  id="art-content">
                                                    <article id="first-art" class="row d-flex section">
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <label>CLIENTE</label>
                                                            <!-- <input type="number" class="form-control" placeholder="Ingrese un numero de identificacion" name="id_usuario" required> -->
                                                            <?php 
                                                                // Verifica si se proporcionó un id de usuario seleccionado en la URL
                                                                $idUsuarioSeleccionado = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
                                                                // LLama a mostrarProveedorId con el id de usuario seleccionado
                                                                mostrarClienteId($idUsuarioSeleccionado);
                                                            ?>
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <label>PRODUCTO</label>
                                                            <?php 
                                                                // Verifica si se proporcionó un código de plan seleccionado en la URL
                                                                $codigo_producto_seleccionado = isset($_GET['codigo_producto']) ? $_GET['codigo_producto'] : null;
                                                                    
                                                                // Llama a mostrarPlanCodigo con el código de plan seleccionado
                                                                mostrarProductoCodigo($codigo_producto_seleccionado);
                                                            ?>
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <label>ELIGE LA FORMA DE ENTREGA</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="forma_entrega_cliente" value="Enviar a domicilio" id="flexRadioDefault2">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    Enviar a domicilio
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </article>
                                                    <article id="second-art" class="row d-flex section" style="display: none;">
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <h5>ELIGE FECHA, HORA Y DIRECCIÓN PARA EL ENVÍO.</h5>
                                                            <label>FECHA</label>
                                                            <input type="date" class="form-control" placeholder="Ingrese una fecha" name="fecha_entrega_cliente" id="fecha_entrega_cliente">
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <label>HORA</label>
                                                            <input type="time" class="form-control" placeholder="Ingrese una hora" name="hora_entrega_cliente" id="hora_entrega_cliente">
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <label>DIRECCION DE ENTREGA</label>
                                                            <input type="text" class="form-control" placeholder="Ingrese la dirección de entrega" name="direccion_residencia" id="direccion_residencia">
                                                        </div>
                                                    </article>
                                                    <article id="third-art" class="row d-flex section" style="display: none;">
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <h5>METODO DE PAGO</h5>
                                                            <label>PAGO CONTRA ENTREGA</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="metodo_pago_cliente" value="Efectivo" id="flexRadioDefault2">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    <i class="icofont-bill-alt"></i> Efectivo
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </article>
                                                    <article id="fourth-art" class="row d-flex section" style="display: none;">
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <h5>REVISA Y CONFIRMA TU PEDIDO</h5>
                                                            <label>DETALLES DE LA ENTREGA</label>
                                                            <div class="row kriss">
                                                                <div class="col-lg-3">
                                                                    <i class="icofont-location-pin umbita"></i>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <!-- Aquí es donde mostrarás la dirección ingresada -->
                                                                    <p id="direccionResidencia" class="card-text mt-3 propio"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <div class="row kriss">
                                                                <div class="col-lg-3">
                                                                    <i class="icofont-fast-delivery umbita"></i>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <p class="card-text mt-3 propio">Recibes 1 producto en envio</p>
                                                                </div>
                                                            </div>
                                                            <div class="row kriss">
                                                                <div class="col-lg-3">
                                                                    
                                                                </div>
                                                                <div class="col-lg-9"> 
                                                                    <!-- Aquí es donde mostrarás la fecha y hora ingresada -->
                                                                    <p id="fechaMostradaPro" class="card-text mt-3 propio"></p>
                                                                    <p id="horaMostradaPro" class="card-text mt-3 propio"></p>
                                                                    <div class="row">
                                                                        <div class="col-lg-3">
                                                                            <?php 
                                                                                // Verifica si se proporcionó un código de producto seleccionado en la URL
                                                                                $codigo_producto_seleccionado = isset($_GET['codigo_producto']) ? $_GET['codigo_producto'] : null;

                                                                                // Llama a mostrarPlanSeleccion con el código de plan seleccionado
                                                                                $infoProductoSeleccionado = mostrarProductoImagen($codigo_producto_seleccionado);

                                                                                // Muestra la imagen del producto o un mensaje adecuado
                                                                                if ($infoProductoSeleccionado) {
                                                                                    echo '<img src="' . $infoProductoSeleccionado['foto_producto'] . '" alt="Imagen del producto" class="product-image">';
                                                                                } else {
                                                                                    echo 'No hay producto seleccionado';
                                                                                }
                                                                            ?>
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <p class="card-text mt-3 propio">
                                                                                <?php
                                                                                    // Verifica si se proporcionó un código de producto seleccionado en la URL
                                                                                    $codigo_producto_seleccionado = isset($_GET['codigo_producto']) ? $_GET['codigo_producto'] : null;

                                                                                    // Llama a mostrarPlanSeleccion con el código de plan seleccionado
                                                                                    $infoProductoSeleccionado = mostrarProductoSeleccion($codigo_producto_seleccionado);

                                                                                    // Muestra el nombre del plan seleccionado o un mensaje adecuado
                                                                                    echo ($infoProductoSeleccionado) ? $infoProductoSeleccionado['nombre_producto'] : 'No hay producto seleccionado';
                                                                                ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <label>DETALLES DEL PAGO</label>
                                                            <div class="row kriss">
                                                                <div class="col-lg-3">
                                                                    <i class="icofont-bill-alt umbita"></i>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <p class="card-text mt-3 propio">Efectivo</p>
                                                                    <p class="card-text mt-3 propio">Pagas
                                                                        $ <?php 
                                                                            // Verifica si se proporcionó un código de producto seleccionado en la URL
                                                                            $codigo_producto_seleccionado = isset($_GET['codigo_producto']) ? $_GET['codigo_producto'] : null;

                                                                            $infoProductoSeleccionado = mostrarPrecioProducto($codigo_producto_seleccionado);

                                                                            // Muestra el nombre del producto seleccionado o un mensaje adecuado
                                                                            echo ($infoProductoSeleccionado) ? $infoProductoSeleccionado['precio_final_producto'] : 'No hay producto seleccionado';
                                                                        ?>
                                                                    </p>
                                                                    <p class="card-text mt-3 propio mb-4 texto-pequeño">Permanece vigilante de la programacion temporal establecida para la entrega.</p>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="precio_pedido_cliente" value="<?= isset($infoProductoSeleccionado['precio_final_producto']) ? $infoProductoSeleccionado['precio_final_producto'] : ''; ?>">
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <button type="submit" class="btn btn-primary update btnRegistroVentaProducto">Confirmar Pedido</button>
                                                        </div>
                                                    </article>
                                                </section>
                                            </form>
                                            <button id="next-btn" class="form-group btn btn-primary update w-100">Continuar</button>   
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 my-3">
                                    <div class="card">
                                        <div class="card-title">
                                            <h1 class="title-table sombra-titulo">Resumen del pedido</h1>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <p class="card-text mt-3 recibo sombra-titulo">
                                                        <?php
                                                            // Verifica si se proporcionó un código de plan seleccionado en la URL
                                                            $codigo_producto_seleccionado = isset($_GET['codigo_producto']) ? $_GET['codigo_producto'] : null;

                                                            // Llama a mostrarPlanSeleccion con el código de plan seleccionado
                                                            $infoProductoSeleccionado = mostrarProductoSeleccion($codigo_producto_seleccionado);

                                                            // Muestra el nombre del plan seleccionado o un mensaje adecuado
                                                            echo ($infoProductoSeleccionado) ? $infoProductoSeleccionado['nombre_producto'] : 'No hay producto seleccionado';
                                                        ?>
                                                    </p>
                                                    <p class="card-text mt-3 recibo">
                                                        Pagas
                                                    </p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <p class="card-text mt-3 recibo sombra-titulo">
                                                        $ <?php 
                                                            // Verifica si se proporcionó un código de plan seleccionado en la URL
                                                            $codigo_producto_seleccionado = isset($_GET['codigo_producto']) ? $_GET['codigo_producto'] : null;

                                                            $infoProductoSeleccionado = mostrarPrecioProducto($codigo_producto_seleccionado);

                                                            // Muestra el nombre del plan seleccionado o un mensaje adecuado
                                                            echo ($infoProductoSeleccionado) ? $infoProductoSeleccionado['precio_final_producto'] : 'No hay producto seleccionado';
                                                        ?>
                                                    </p>
                                                    <p class="card-text mt-3 recibo font-weight-bold">
                                                        $ <?php 
                                                            // Verifica si se proporcionó un código de plan seleccionado en la URL
                                                            $codigo_producto_seleccionado = isset($_GET['codigo_producto']) ? $_GET['codigo_producto'] : null;

                                                            $infoProductoSeleccionado = mostrarPrecioProducto($codigo_producto_seleccionado);

                                                            // Muestra el nombre del plan seleccionado o un mensaje adecuado
                                                            echo ($infoProductoSeleccionado) ? $infoProductoSeleccionado['precio_final_producto'] : 'No hay producto seleccionado';
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>  
                </div>
            </div>
        </div>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../Website-Externo/js/registrar/registrarVentaProducto.js"></script>
        <script src="../Website-Externo/js/pedidos-proveedor.js"></script>
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

        <script>
            document.getElementById('direccion_residencia').addEventListener('input', function() {
                var direccionIngresada = this.value;
                document.getElementById('direccionResidencia').textContent = 'Dirección de Entrega: ' + direccionIngresada;
            });
        </script>

        <script>
            document.getElementById('fecha_entrega_cliente').addEventListener('input', function() {
                var direccionIngresada = this.value;
                document.getElementById('fechaMostradaPro').textContent = 'Fecha de Entrega: ' + direccionIngresada;
            });
        </script>

        <script>
            document.getElementById('hora_entrega_cliente').addEventListener('input', function() {
                var direccionIngresada = this.value;
                document.getElementById('horaMostradaPro').textContent = 'Hora de Entrega: ' + direccionIngresada;
            });
        </script>
    </body>
</html>