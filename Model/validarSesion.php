<?php
    class ValidarSesion {
        public function iniciarSesion($email_usuario, $clave) {
            // Verificar si los campos requeridos están completos
            if (empty($email_usuario) || empty($clave)) {
                $this->respondError('Por favor complete todos los campos requeridos');
                return;
            }

            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM usuarios WHERE email_usuario = :email_usuario";
            $result = $conexion->prepare($consultar);

            $result->bindParam(":email_usuario", $email_usuario);

            $result->execute();

            if ($f = $result->fetch()) {
                if (password_verify($clave, $f['clavemd'])) {
                    if ($f['estado_usuario'] == "Activo") {
                        session_start();
                        $_SESSION['id'] = $f['id_usuario'];
                        $_SESSION['email_usuario'] = $f['email_usuario'];
                        $_SESSION['nombres_usuario'] = $f['nombres_usuario'];
                        $_SESSION['apellidos_usuario'] = $f['apellidos_usuario'];
                        $_SESSION['rol_usuario'] = $f['rol_usuario'];
                        $_SESSION['id_usuario'] = $f['id_usuario'];
                        $_SESSION['autentificado'] = "SI";

                        $redirect_url = ''; // Define la URL de redirección según el rol (puedes cambiar esto)
                        switch ($f['rol_usuario']) {
                            case 'Administrador':
                                $message = 'Bienvenido Usuario Administrador';
                                $rol_usuario = 'Administrador'; // Agregamos esta línea para enviar el rol
                                $redirect_url = '../Administrador/home.php';
                                break;
                            case 'Entrenador':
                                $message = 'Bienvenido Usuario Entrenador';
                                $rol_usuario = 'Entrenador'; // Agregamos esta línea para enviar el rol
                                $redirect_url = '../Entrenadores/home.php';
                                break;
                            case 'Cliente':
                                $message = 'Bienvenido Usuario Cliente';
                                $rol_usuario = 'Cliente'; // Agregamos esta línea para enviar el rol
                                $redirect_url = '../Clientes/home.php';
                                break;
                            case 'Proveedor':
                                $message = 'Bienvenido Usuario Proveedor';
                                $rol_usuario = 'Proveedor'; // Agregamos esta línea para enviar el rol
                                $redirect_url = '../Proveedores/home.php';
                                break;
                        }

                        $this->respondSuccess(['message' => $message, 'rol_usuario' => $rol_usuario, 'redirect_url' => $redirect_url]);
                    } else {
                        $this->respondError('Tu cuenta está bloqueada o inactiva. Contacta al Administrador');
                    }
                } else {
                    $this->respondError('La clave ingresada no coincide en la base de datos');
                }
            } else {
                $this->respondError('El email ingresado no existe en la base de datos');
            }
        }

        public function cerrarSesion() {
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            session_start();
            session_destroy();

            // $this->respondSuccess(['message' => 'Sesión cerrada exitosamente']);

            echo "<script> location.href='../Views/Extras/vistaExit.php' </script>";
        }

        private function respondError($message) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $message]);
            exit;
        }

        private function respondSuccess($data) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true] + $data);
            exit;
        }
    }

    // Manejo del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $objValidar = new ValidarSesion();
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $clave = isset($_POST['Password']) ? $_POST['Password'] : null;
        $objValidar->iniciarSesion($email, $clave);
    }
?>




