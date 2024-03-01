<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../Website-Externo/css/estiloRegistro.css">
  </head>
  <body class="bg-dark">
    
    <section>
        <!-- clase g-0, nos borra el scroll que tenia en el eje x -->
        <div class="row g-0">
            <div class="col-lg-7 d-none d-lg-block">
                <!-- aca traemos el carrusel de bootsrap -->
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <!-- clase min-vh-100 ajusta la imagen de altura al 100% de la pantalla -->
                        <div class="carousel-item img-1 min-vh-100 active" data-bs-interval="5000">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="font-weight-bold color">La mas potente del mercado</h5>
                                <a href="#" class="text-muted text-decoration-none destacado">Visita nuestra tienda</a>
                            </div>
                        </div>
                        <div class="carousel-item img-2 min-vh-100" data-bs-interval="5000">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="font-weight-bold color">Descubre la nueva generacion</h5>
                                <a href="#" class="text-muted text-decoration-none destacado">Visita nuestra tienda</a>
                            </div>
                        </div>
                        <div class="carousel-item img-3 min-vh-100" data-bs-interval="5000">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="font-weight-bold color">La mas potente del mercado</h5>
                                <a href="#" class="text-muted text-decoration-none destacado">Visita nuestra tienda</a>
                            </div>
                        </div>
                        <div class="carousel-item img-4 min-vh-100" data-bs-interval="5000">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="font-weight-bold color">Descubre la nueva generacion</h5>
                                <a href="#" class="text-muted text-decoration-none destacado">Visita nuestra tienda</a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-lg-5 d-flex flex-column align-items-end min-vh-100">
                <!-- clase px-lg-5 define un padding en los lados en los dispositivos largos(grandes), -->
                <!-- clase pt-lg-4 Define un padding superior en los dispositivos largos(grandes) -->
                <!-- clase pb-lg-3 define un padding inferior en los dispositivos largos(grandes) -->
                <div class="px-lg-5 pt-lg-4 pb-lg-3 p-4 w-100 mb-auto">
                    <a href="../../index.html">
                        <img src="../Extras/Logos/logo-trnasparente.png" alt="Logo" class="img-fluid custom-img mx-auto">
                    </a>
                </div>
                <div class="px-lg-5 py-lg-4 p-4 w-100 align-self-center">
                    <!-- clase text-light cambia el color del texto a blanco -->
                    <!-- clase font-weight-bold usar negrita en el titulo, y la clase mb-4para que tenga un padding inferior -->
                    <h1 class="font-weight-bold mb-4">Crear Cuenta</h1>
                    <!-- Importamos el fomrulario de boostrap -->
                    <form action="../../Controller/registrarUserExterno.php" method="POST" class="row g-3" name="registerUserForm">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Num Identificacion:</label>
                            <input type="number" name="id_usuario" class="form-control margin" id="inputEmail4" placeholder="Ingrese su numero de identificacion" required>
                        </div>
                        <div class="col-md-6 form-select-container">
                            <label for="inputState" class="form-label margin">Tipo de Documento:</label>
                            <select id="inputState" name="tipo_documento_usuario" class="form-select margin" required>
                                <option selected>Seleccione una Opcion...</option>
                                <option value="CC">CC</option>
                                <option value="CE">CE</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                            </select>
                            <div class="select-arrow"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Nombres:</label>
                            <input type="text" name="nombres_usuario" class="form-control margin" id="inputEmail4" placeholder="Ingrese sus nombres" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Apellidos:</label>
                            <input type="text" name="apellidos_usuario" class="form-control margin" id="inputEmail4" placeholder="Ingrese sus apellidos" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Fecha De Nacimiento:</label>
                            <div class="custom-date-input">
                                <input type="date" name="fecha_nacimiento_usuario" class="form-control margin" id="fechaNacimiento" required>
                                <div class="date-icon"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Email:</label>
                            <input type="email" name="email_usuario" class="form-control margin" id="inputEmail4" placeholder="Ingrese su email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Telefono:</label>
                            <input type="number" name="telefono_usuario" class="form-control margin" id="inputEmail4" placeholder="Ingrese su numero de telefono" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Contraseña:</label>
                            <input type="password" name="clave" class="form-control margin" id="inputEmail4" placeholder="Ingrese una Contraseña" required>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Acepto Terminos y condiciones
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary col-12 login btnRegisterUser">Crear Cuenta</button>
                        </div>
                    </form>
                </div>
                <div class="text-center px-lg-5 pt-lg-3 pb-lg-4 p-4 w-100 mt-auto">
                    <p class="d-inline-block mb-0">¿Ya tienes una cuenta?</p> <a href="iniciarSesion.php" class="text-primary font-weight-bold text-decoration-none register">Inicia Sesion</a>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Inicializa el carrusel después de que la página esté completamente cargada
            var myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleInterval'));
        });
    </script>
    <script src="https://kit.fontawesome.com/9ed7eb7a61.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../Website-Externo/js/login/registrarUserExterno.js"></script>
  </body>
</html>