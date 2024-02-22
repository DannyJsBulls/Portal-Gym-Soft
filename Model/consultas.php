<?php 
    class Consultas {
        private $conexion;

        // Constructor
        public function __construct() {
            $this->conexion = (new Conexion())->get_conexion();
        }
        // Mostrar informacion de cada usuario
        public function mostrarPerfilUsuario($id_usuario){
            $f = array(); // Inicializar el arreglo
        
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            // Preparar la consulta para obtener los pagos relacionados con los planes del cliente
            $consulta = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
            
            $result = $conexion->prepare($consulta);
            $result->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $result->execute();
        
            // Mientras existan registros, guardarlos en el arreglo $f
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
        
            return $f;
        }
        // Modulo Usuarios ROL ADMINISTRADOR
        // Registro de Usuario externo
        public function registrarUserExterno($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $clavemd, $rol_usuario, $estado_usuario){
            // Verificar si los campos requeridos están completos
            if (empty($id_usuario) || empty($email_usuario) || empty($tipo_documento_usuario) || empty($nombres_usuario) || empty($apellidos_usuario) || empty($fecha_nacimiento_usuario) || empty($telefono_usuario) || empty($clavemd)) {
                echo '<script> alert("Por favor complete todos los campos requeridos") </script>';
                echo "<script> location.href='../Views/Extras/registrarSesion.php' </script>";
                return; // Detener la ejecución del método
            }
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario OR email_usuario = :email_usuario";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":email_usuario", $email_usuario);

            $result->execute();

            $f = $result->fetch();

            if($f) {
                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Los datos ingresados ya se encuentran registrados en el sistema']);
            }else{
                $insertar = "INSERT INTO usuarios (id_usuario, tipo_documento_usuario, nombres_usuario, apellidos_usuario, fecha_nacimiento_usuario, email_usuario, telefono_usuario, clavemd, rol_usuario, estado_usuario)
                VALUES (:id_usuario, :tipo_documento_usuario, :nombres_usuario, :apellidos_usuario, :fecha_nacimiento_usuario, :email_usuario, :telefono_usuario, :clavemd, :rol_usuario, :estado_usuario)";
                
                $result = $conexion->prepare($insertar);

                $result->bindParam(":id_usuario", $id_usuario);
                $result->bindParam(":tipo_documento_usuario", $tipo_documento_usuario);
                $result->bindParam(":nombres_usuario", $nombres_usuario);
                $result->bindParam(":apellidos_usuario", $apellidos_usuario);
                $result->bindParam(":fecha_nacimiento_usuario", $fecha_nacimiento_usuario);
                $result->bindParam(":email_usuario", $email_usuario);
                $result->bindParam(":telefono_usuario", $telefono_usuario);
                $result->bindParam(":clavemd", $clavemd);
                $result->bindParam(":rol_usuario", $rol_usuario);
                $result->bindParam(":estado_usuario", $estado_usuario);

                $result->execute();

                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Registro Exitoso']);
            }
        }
        // Ver perfil de administrador
        public function mostrarPerfilAdministrador($id_usuario){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
            $result = $conexion->prepare($consultar);
            $result->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $result->execute();
        
            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para ver el perfil del usuario desde la lista de usuarios rol administrador
        public function buscarUsuarioAdmin($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();
        
            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para enviar el formulario de actualizacion la de usuario desde el perfil
        public function buscarPerfilAdministrador($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        public function registrarUserAdmin($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $estado_usuario, $rol_usuario, $clavemd, $foto_usuario){
            
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario OR email_usuario = :email_usuario";
            $result = $conexion->prepare($consultar);

            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":email_usuario", $email_usuario);

            $result->execute();

            $f = $result->fetch();

            if($f){
                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Los datos ingresados ya se encuentran registrados en el sistema']);
            }else{
                $insertar = "INSERT INTO usuarios (id_usuario, tipo_documento_usuario, nombres_usuario, apellidos_usuario, fecha_nacimiento_usuario, email_usuario, telefono_usuario, estado_usuario, rol_usuario, clavemd, foto_usuario)
                VALUES (:id_usuario, :tipo_documento_usuario, :nombres_usuario, :apellidos_usuario, :fecha_nacimiento_usuario, :email_usuario, :telefono_usuario, :estado_usuario, :rol_usuario, :clavemd, :foto_usuario)";

                $result = $conexion->prepare($insertar);

                $result->bindParam(":id_usuario", $id_usuario);
                $result->bindParam(":tipo_documento_usuario", $tipo_documento_usuario);
                $result->bindParam(":nombres_usuario", $nombres_usuario);
                $result->bindParam(":apellidos_usuario", $apellidos_usuario);
                $result->bindParam(":fecha_nacimiento_usuario", $fecha_nacimiento_usuario);
                $result->bindParam(":email_usuario", $email_usuario);
                $result->bindParam(":telefono_usuario", $telefono_usuario);
                $result->bindParam(":estado_usuario", $estado_usuario);
                $result->bindParam(":rol_usuario", $rol_usuario);
                $result->bindParam(":clavemd", $clavemd);
                $result->bindParam(":foto_usuario", $foto_usuario);

                $result->execute();

                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Usuario registrado con exito']);
            }
        }
        public function mostrarUserAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM usuarios";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra las tarjetas detalladas de los usuarios del sistema
        public function mostrarUsuarioAdmin(){
            $f = null;

            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM usuarios";
            $result = $conexion->prepare($consultar);
            $result->execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            return $f;
        }
        public function buscarUser($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        public function modificarUserAdmin($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $estado_usuario, $rol_usuario, $clavemd, $foto_usuario){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $actualizar = "UPDATE usuarios SET id_usuario=:id_usuario, tipo_documento_usuario=:tipo_documento_usuario, nombres_usuario=:nombres_usuario, apellidos_usuario=:apellidos_usuario, fecha_nacimiento_usuario=:fecha_nacimiento_usuario, email_usuario=:email_usuario, telefono_usuario=:telefono_usuario, estado_usuario=:estado_usuario, rol_usuario=:rol_usuario, clavemd=:clavemd, foto_usuario=:foto_usuario WHERE id_usuario=:id_usuario";
            $result = $conexion->prepare($actualizar);

            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":tipo_documento_usuario", $tipo_documento_usuario);
            $result->bindParam(":nombres_usuario", $nombres_usuario);
            $result->bindParam(":apellidos_usuario", $apellidos_usuario);
            $result->bindParam(":fecha_nacimiento_usuario", $fecha_nacimiento_usuario);
            $result->bindParam(":email_usuario", $email_usuario);
            $result->bindParam(":telefono_usuario", $telefono_usuario);
            $result->bindParam(":estado_usuario", $estado_usuario);
            $result->bindParam(":rol_usuario", $rol_usuario);
            $result->bindParam(":clavemd", $clavemd);
            $result->bindParam(":foto_usuario", $foto_usuario);

            $result->execute();
            
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Usuario actualizado con exito']);
        }
        public function eliminarUserAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            $eliminar = "DELETE FROM usuarios WHERE id_usuario = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);
        
            $result->execute();
        
            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Usuario eliminado con exito']);
        }        
        // Modulo Clientes Rol Administrador
        public function registrarClienteAdmin($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $estado_usuario, $rol_usuario, $clavemd, $foto_usuario){
            
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario OR email_usuario = :email_usuario";
            $result = $conexion->prepare($consultar);

            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":email_usuario", $email_usuario);

            $result->execute();

            $f = $result->fetch();

            if($f){
                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Los datos ingresados ya se encuentran registrados en el sistema']);
            }else{
                $insertar = "INSERT INTO usuarios (id_usuario, tipo_documento_usuario, nombres_usuario, apellidos_usuario, fecha_nacimiento_usuario, email_usuario, telefono_usuario, estado_usuario, rol_usuario, clavemd, foto_usuario)
                VALUES (:id_usuario, :tipo_documento_usuario, :nombres_usuario, :apellidos_usuario, :fecha_nacimiento_usuario, :email_usuario, :telefono_usuario, :estado_usuario, :rol_usuario, :clavemd, :foto_usuario)";

                $result = $conexion->prepare($insertar);

                $result->bindParam(":id_usuario", $id_usuario);
                $result->bindParam(":tipo_documento_usuario", $tipo_documento_usuario);
                $result->bindParam(":nombres_usuario", $nombres_usuario);
                $result->bindParam(":apellidos_usuario", $apellidos_usuario);
                $result->bindParam(":fecha_nacimiento_usuario", $fecha_nacimiento_usuario);
                $result->bindParam(":email_usuario", $email_usuario);
                $result->bindParam(":telefono_usuario", $telefono_usuario);
                $result->bindParam(":estado_usuario", $estado_usuario);
                $result->bindParam(":rol_usuario", $rol_usuario);
                $result->bindParam(":clavemd", $clavemd);
                $result->bindParam(":foto_usuario", $foto_usuario);

                $result->execute();

                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Cliente registrado con exito']);
            }
        }
        // Funcion para mostrar la vista de la tabla entrenadores ROL ADMINISTRADOR
        public function mostrarInfoClientesAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM clientes";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para mostrar la lista de clientes del sistema
        public function mostrarClienteAdmin(){
            $entrenadores = array();

            try {
                $objConexion = new Conexion;
                $conexion = $objConexion->get_conexion();

                $consulta = "SELECT * FROM usuarios WHERE rol_usuario = 'Cliente'";
                $resultado = $conexion->query($consulta);

                while ($entrenador = $resultado->fetch(PDO::FETCH_ASSOC)){
                    $entrenadores[] = $entrenador;
                }
            } catch (PDOException $e) {
                // Manejar cualquier error de base de datos aquí
                // Por ejemplo: echo "Error: " . $e->getMessage();
            }

            return $entrenadores;
        }
        // Funcion para ver el perfil del cliente rol administrador
        public function buscarClienteAdmin($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para modificar los datos del cliente en el formulario de actualizacion
        public function buscarCliente($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM clientes WHERE id_usuario = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        public function modificarClienteAdmin($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $estado_usuario, $rol_usuario, $clavemd, $foto_usuario){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $actualizar = "UPDATE clientes SET id_usuario=:id_usuario, tipo_documento_usuario=:tipo_documento_usuario, nombres_usuario=:nombres_usuario, apellidos_usuario=:apellidos_usuario, fecha_nacimiento_usuario=:fecha_nacimiento_usuario, email_usuario=:email_usuario, telefono_usuario=:telefono_usuario, estado_usuario=:estado_usuario, rol_usuario=:rol_usuario, clavemd=:clavemd, foto_usuario=:foto_usuario WHERE id_usuario=:id_usuario";
            $result = $conexion->prepare($actualizar);

            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":tipo_documento_usuario", $tipo_documento_usuario);
            $result->bindParam(":nombres_usuario", $nombres_usuario);
            $result->bindParam(":apellidos_usuario", $apellidos_usuario);
            $result->bindParam(":fecha_nacimiento_usuario", $fecha_nacimiento_usuario);
            $result->bindParam(":email_usuario", $email_usuario);
            $result->bindParam(":telefono_usuario", $telefono_usuario);
            $result->bindParam(":estado_usuario", $estado_usuario);
            $result->bindParam(":rol_usuario", $rol_usuario);
            $result->bindParam(":clavemd", $clavemd);
            $result->bindParam(":foto_usuario", $foto_usuario);

            $result->execute();
            
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Cliente actualizado con exito']);
        }
        public function eliminarClienteAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM clientes WHERE id_usuario = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);

            $result->execute();

            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Cliente eliminado con exito']);
        }
        // Modulo Entrenadores ROL ADMINISTRADOR
        public function registrarEntrenadorAdmin($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $estado_usuario, $rol_usuario, $clavemd, $foto_usuario){
            
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario OR email_usuario = :email_usuario";
            $result = $conexion->prepare($consultar);

            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":email_usuario", $email_usuario);

            $result->execute();

            $f = $result->fetch();

            if($f){
                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Los datos ingresados ya se encuentran registrados en el sistema']);
            }else{
                $insertar = "INSERT INTO usuarios (id_usuario, tipo_documento_usuario, nombres_usuario, apellidos_usuario, fecha_nacimiento_usuario, email_usuario, telefono_usuario, estado_usuario, rol_usuario, clavemd, foto_usuario)
                VALUES (:id_usuario, :tipo_documento_usuario, :nombres_usuario, :apellidos_usuario, :fecha_nacimiento_usuario, :email_usuario, :telefono_usuario, :estado_usuario, :rol_usuario, :clavemd, :foto_usuario)";

                $result = $conexion->prepare($insertar);

                $result->bindParam(":id_usuario", $id_usuario);
                $result->bindParam(":tipo_documento_usuario", $tipo_documento_usuario);
                $result->bindParam(":nombres_usuario", $nombres_usuario);
                $result->bindParam(":apellidos_usuario", $apellidos_usuario);
                $result->bindParam(":fecha_nacimiento_usuario", $fecha_nacimiento_usuario);
                $result->bindParam(":email_usuario", $email_usuario);
                $result->bindParam(":telefono_usuario", $telefono_usuario);
                $result->bindParam(":estado_usuario", $estado_usuario);
                $result->bindParam(":rol_usuario", $rol_usuario);
                $result->bindParam(":clavemd", $clavemd);
                $result->bindParam(":foto_usuario", $foto_usuario);

                $result->execute();

                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Entrenador registrado con exito']);
            }
        }
        // Funcion para mostrar la vista de la tabla entrenadores ROL ADMINISTRADOR
        public function mostrarInfoEntrenadorAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM entrenadores";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para mostrar la lista de entrenadores del sistema
        public function mostrarEntrenadorAdmin(){
            $entrenadores = array();

            try {
                $objConexion = new Conexion;
                $conexion = $objConexion->get_conexion();

                $consulta = "SELECT * FROM usuarios WHERE rol_usuario = 'Entrenador'";
                $resultado = $conexion->query($consulta);

                while ($entrenador = $resultado->fetch(PDO::FETCH_ASSOC)){
                    $entrenadores[] = $entrenador;
                }
            } catch (PDOException $e) {
                // Manejar cualquier error de base de datos aquí
                // Por ejemplo: echo "Error: " . $e->getMessage();
            }

            return $entrenadores;
        }
        // Funcion para ver el perfil del entrenador rol administrador
        public function buscarEntrenadorAdmin($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para modificar los datos del entrenador en el formulario de actualizacion
        public function buscarEntrenador($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM entrenadores WHERE id_usuario = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        public function modificarEntrenadorAdmin($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $estado_usuario, $rol_usuario, $clavemd, $foto_usuario){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $actualizar = "UPDATE entrenadores SET id_usuario=:id_usuario, tipo_documento_usuario=:tipo_documento_usuario, nombres_usuario=:nombres_usuario, apellidos_usuario=:apellidos_usuario, fecha_nacimiento_usuario=:fecha_nacimiento_usuario, email_usuario=:email_usuario, telefono_usuario=:telefono_usuario, estado_usuario=:estado_usuario, rol_usuario=:rol_usuario, clavemd=:clavemd, foto_usuario=:foto_usuario WHERE id_usuario=:id_usuario";
            $result = $conexion->prepare($actualizar);

            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":tipo_documento_usuario", $tipo_documento_usuario);
            $result->bindParam(":nombres_usuario", $nombres_usuario);
            $result->bindParam(":apellidos_usuario", $apellidos_usuario);
            $result->bindParam(":fecha_nacimiento_usuario", $fecha_nacimiento_usuario);
            $result->bindParam(":email_usuario", $email_usuario);
            $result->bindParam(":telefono_usuario", $telefono_usuario);
            $result->bindParam(":estado_usuario", $estado_usuario);
            $result->bindParam(":rol_usuario", $rol_usuario);
            $result->bindParam(":clavemd", $clavemd);
            $result->bindParam(":foto_usuario", $foto_usuario);

            $result->execute();
            
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Entrenador actualizado con exito']);
        }
        public function eliminarEntrenadorAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM entrenadores WHERE id_usuario = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);
        
            $result->execute();

            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Entrenador eliminado con exito']);
        }
        // MODULO PROVEEDORES ROL ADMINISTRADOR
        public function registrarProveedorAdmin($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $estado_usuario, $rol_usuario, $clavemd, $foto_usuario){
            
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario OR email_usuario = :email_usuario";
            $result = $conexion->prepare($consultar);

            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":email_usuario", $email_usuario);

            $result->execute();

            $f = $result->fetch();

            if($f){
                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Los datos ingresados ya se encuentran registrados en el sistema']);
            }else{
                $insertar = "INSERT INTO usuarios (id_usuario, tipo_documento_usuario, nombres_usuario, apellidos_usuario, fecha_nacimiento_usuario, email_usuario, telefono_usuario, estado_usuario, rol_usuario, clavemd, foto_usuario)
                VALUES (:id_usuario, :tipo_documento_usuario, :nombres_usuario, :apellidos_usuario, :fecha_nacimiento_usuario, :email_usuario, :telefono_usuario, :estado_usuario, :rol_usuario, :clavemd, :foto_usuario)";

                $result = $conexion->prepare($insertar);

                $result->bindParam(":id_usuario", $id_usuario);
                $result->bindParam(":tipo_documento_usuario", $tipo_documento_usuario);
                $result->bindParam(":nombres_usuario", $nombres_usuario);
                $result->bindParam(":apellidos_usuario", $apellidos_usuario);
                $result->bindParam(":fecha_nacimiento_usuario", $fecha_nacimiento_usuario);
                $result->bindParam(":email_usuario", $email_usuario);
                $result->bindParam(":telefono_usuario", $telefono_usuario);
                $result->bindParam(":estado_usuario", $estado_usuario);
                $result->bindParam(":rol_usuario", $rol_usuario);
                $result->bindParam(":clavemd", $clavemd);
                $result->bindParam(":foto_usuario", $foto_usuario);

                $result->execute();

                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Proveedor registrado con exito']);
            }
        }
        // Funcion para mostrar la vista de la tabla entrenadores ROL ADMINISTRADOR
        public function mostrarInfoProveedorAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM proveedores";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para mostrar la lista de proveedores del sistema
        public function mostrarProveedorAdmin(){
            $entrenadores = array();

            try {
                $objConexion = new Conexion;
                $conexion = $objConexion->get_conexion();

                $consulta = "SELECT * FROM usuarios WHERE rol_usuario = 'Proveedor'";
                $resultado = $conexion->query($consulta);

                while ($entrenador = $resultado->fetch(PDO::FETCH_ASSOC)){
                    $entrenadores[] = $entrenador;
                }
            } catch (PDOException $e) {
                // Manejar cualquier error de base de datos aquí
                // Por ejemplo: echo "Error: " . $e->getMessage();
            }

            return $entrenadores;
        }
        // Funcion para ver el perfil del proveedor rol administrador
        public function buscarProveedorAdmin($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM usuarios WHERE id_usuario = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para modificar los datos del entrenador en el formulario de actualizacion
        public function buscarProveedor($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM proveedores WHERE id_usuario = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        public function modificarProveedorAdmin($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $estado_usuario, $rol_usuario, $clavemd, $foto_usuario){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $actualizar = "UPDATE proveedores SET id_usuario=:id_usuario, tipo_documento_usuario=:tipo_documento_usuario, nombres_usuario=:nombres_usuario, apellidos_usuario=:apellidos_usuario, fecha_nacimiento_usuario=:fecha_nacimiento_usuario, email_usuario=:email_usuario, telefono_usuario=:telefono_usuario, estado_usuario=:estado_usuario, rol_usuario=:rol_usuario, clavemd=:clavemd, foto_usuario=:foto_usuario WHERE id_usuario=:id_usuario";
            $result = $conexion->prepare($actualizar);

            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":tipo_documento_usuario", $tipo_documento_usuario);
            $result->bindParam(":nombres_usuario", $nombres_usuario);
            $result->bindParam(":apellidos_usuario", $apellidos_usuario);
            $result->bindParam(":fecha_nacimiento_usuario", $fecha_nacimiento_usuario);
            $result->bindParam(":email_usuario", $email_usuario);
            $result->bindParam(":telefono_usuario", $telefono_usuario);
            $result->bindParam(":estado_usuario", $estado_usuario);
            $result->bindParam(":rol_usuario", $rol_usuario);
            $result->bindParam(":clavemd", $clavemd);
            $result->bindParam(":foto_usuario", $foto_usuario);

            $result->execute();
            
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Proveedor actualizado con exito']);
        }
        public function eliminarProveedorAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM proveedores WHERE id_usuario = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);

            $result->execute();

            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Proveedor eliminado con exito']);
        }
        // MODULO DE ACTIVIDADES ROL ADMINISTRADOR
        public function registrarActividadesAdmin($codigo_actividad, $nombre_actividad, $descripcion_actividad, $tipo_actividad, $requisitos_actividad, $estado_actividad, $objetivos_actividad, $area_actividad, $foto_actividad){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            $consultar = "SELECT * FROM actividades WHERE codigo_actividad = :codigo_actividad";
            $result = $conexion->prepare($consultar);

            $result->bindParam(":codigo_actividad", $codigo_actividad);

            $result->execute();

            $f = $result->fetch();

            if($f){
                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'El codigo de la actividad ya se encuentra registrado en el sistema']);
            }else{
                $insertar = "INSERT INTO actividades (codigo_actividad, nombre_actividad, descripcion_actividad, tipo_actividad, requisitos_actividad, estado_actividad, objetivos_actividad, area_actividad, foto_actividad)
                VALUES (:codigo_actividad, :nombre_actividad, :descripcion_actividad, :tipo_actividad, :requisitos_actividad, :estado_actividad, :objetivos_actividad, :area_actividad, :foto_actividad)";
        
                $result = $conexion->prepare($insertar);
            
                $result->bindParam(":codigo_actividad", $codigo_actividad);
                $result->bindParam(":nombre_actividad", $nombre_actividad);
                $result->bindParam(":descripcion_actividad", $descripcion_actividad);
                $result->bindParam(":tipo_actividad", $tipo_actividad);
                $result->bindParam(":requisitos_actividad", $requisitos_actividad);
                $result->bindParam(":estado_actividad", $estado_actividad);
                $result->bindParam(":objetivos_actividad", $objetivos_actividad);
                $result->bindParam(":area_actividad", $area_actividad);
                $result->bindParam(":foto_actividad", $foto_actividad);
            
                $result->execute();
            
                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Actividad registrada con exito']);
            }   
        }
        // Esta funcion muestra la tabla de actividades disponibles en el sistema
        public function mostrarActividadesAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM actividades";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra los detalles de la lista de actividades en el gimansio, funcion para el administrador
        public function mostrarActividadesAdministrador(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM actividades";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion busca el detalle de la actividad seleccionada para el rol administrador
        public function buscarActividadesAdministrador($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM actividades WHERE codigo_actividad = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra el formulario de actualizacion, para actualizar actividades ROL ADMINISTRADOR
        public function buscarActividades($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM actividades WHERE codigo_actividad = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion es la que realiza la funcion de actualizar la actividad ROL ADMINISTRADOR
        public function modificarActividadesAdmin($codigo_actividad, $nombre_actividad, $descripcion_actividad, $tipo_actividad, $requisitos_actividad, $estado_actividad, $objetivos_actividad, $area_actividad, $foto_actividad) {
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            $actualizar = "UPDATE actividades SET 
                nombre_actividad = :nombre_actividad,
                descripcion_actividad = :descripcion_actividad,
                tipo_actividad = :tipo_actividad,
                requisitos_actividad = :requisitos_actividad,
                estado_actividad = :estado_actividad,
                objetivos_actividad = :objetivos_actividad,
                area_actividad = :area_actividad,
                foto_actividad = :foto_actividad
                WHERE codigo_actividad = :codigo_actividad";
        
            $result = $conexion->prepare($actualizar);
        
            $result->bindParam(":codigo_actividad", $codigo_actividad);
            $result->bindParam(":nombre_actividad", $nombre_actividad);
            $result->bindParam(":descripcion_actividad", $descripcion_actividad);
            $result->bindParam(":tipo_actividad", $tipo_actividad);
            $result->bindParam(":requisitos_actividad", $requisitos_actividad);
            $result->bindParam(":estado_actividad", $estado_actividad);
            $result->bindParam(":objetivos_actividad", $objetivos_actividad);
            $result->bindParam(":area_actividad", $area_actividad);
            $result->bindParam(":foto_actividad", $foto_actividad);
        
            $result->execute();
        
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Actividad actualizada con exito']);
        }
        // Esta funcion realiza la funcion de eliminar una actividad ROL ADMINISTRADOR
        public function eliminarActividadesAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM actividades WHERE codigo_actividad = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);

            $result->execute();

            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Actividad eliminada con exito']);
        }
        // MODULO PLANES ROL ADMINISTRADOR
        public function registrarPlanesAdmin($codigo_plan, $nombre_plan, $descripcion_plan, $precio_plan, $porcentaje_ganancia_plan, $precio_final_plan, $duracion_plan, $acceso_servicios_plan, $restricciones_plan, $estado_plan, $descuentos_plan, $categoria_plan){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM planes WHERE codigo_plan = :codigo_plan";
            $result = $conexion->prepare($consultar);

            $result->bindParam(":codigo_plan", $codigo_plan);

            $result->execute();

            $f = $result->fetch();

            if($f){
                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'El codigo del plan ya se encuentra registrado en el sistema']);
            }else{
                $insertar = "INSERT INTO planes (codigo_plan, nombre_plan, descripcion_plan, precio_plan, porcentaje_ganancia_plan, precio_final_plan, duracion_plan, acceso_servicios_plan, restricciones_plan, estado_plan, descuentos_plan, categoria_plan)
                VALUES (:codigo_plan, :nombre_plan, :descripcion_plan, :precio_plan, :porcentaje_ganancia_plan, :precio_final_plan, :duracion_plan, :acceso_servicios_plan, :restricciones_plan, :estado_plan, :descuentos_plan, :categoria_plan)";

                $result = $conexion->prepare($insertar);

                $result->bindParam(":codigo_plan", $codigo_plan);
                $result->bindParam(":nombre_plan", $nombre_plan);
                $result->bindParam(":descripcion_plan", $descripcion_plan);
                $result->bindParam(":precio_plan", $precio_plan);
                $result->bindParam(":porcentaje_ganancia_plan", $porcentaje_ganancia_plan);
                $result->bindParam(":precio_final_plan", $precio_final_plan);
                $result->bindParam(":duracion_plan", $duracion_plan);
                $result->bindParam(":acceso_servicios_plan", $acceso_servicios_plan);
                $result->bindParam(":restricciones_plan", $restricciones_plan);
                $result->bindParam(":estado_plan", $estado_plan);
                $result->bindParam(":descuentos_plan", $descuentos_plan);
                $result->bindParam(":categoria_plan", $categoria_plan);

                $result->execute();

                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Plan registrado con exito']);
            }         
        }
        // Esta funcion muestra la tabla de los planes disponibles en el sistema
        public function mostrarPlanesAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM planes";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra los planes disponibles en el sistema
        public function mostrarPlanesAdministrador(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM planes";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra el detalle del plan
        public function buscarPlanesAdministrador($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM planes WHERE codigo_plan = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion envia al formulario de actualizacion de datos para actualizar el plan
        public function buscarPlanes($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM planes WHERE codigo_plan = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion realiza la accion de modificar o actualizar los datos de los planes en el formulario
        public function modificarPlanesAdmin($codigo_plan, $nombre_plan, $descripcion_plan, $precio_plan, $porcentaje_ganancia_plan, $precio_final_plan, $duracion_plan, $acceso_servicios_plan, $restricciones_plan, $estado_plan, $descuentos_plan, $categoria_plan) {
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            $actualizar = "UPDATE planes SET
                codigo_plan=:codigo_plan,
                nombre_plan=:nombre_plan,
                descripcion_plan=:descripcion_plan,
                precio_plan=:precio_plan,
                porcentaje_ganancia_plan=:porcentaje_ganancia_plan,
                precio_final_plan=:precio_final_plan,
                duracion_plan=:duracion_plan,
                acceso_servicios_plan=:acceso_servicios_plan,
                restricciones_plan=:restricciones_plan,
                estado_plan=:estado_plan,
                descuentos_plan=:descuentos_plan,
                categoria_plan=:categoria_plan
                WHERE codigo_plan=:codigo_plan";
        
            $result = $conexion->prepare($actualizar);
        
            $result->bindParam(":codigo_plan", $codigo_plan);
            $result->bindParam(":nombre_plan", $nombre_plan);
            $result->bindParam(":descripcion_plan", $descripcion_plan);
            $result->bindParam(":precio_plan", $precio_plan);
            $result->bindParam(":porcentaje_ganancia_plan", $porcentaje_ganancia_plan);
            $result->bindParam(":precio_final_plan", $precio_final_plan);
            $result->bindParam(":duracion_plan", $duracion_plan);
            $result->bindParam(":acceso_servicios_plan", $acceso_servicios_plan);
            $result->bindParam(":restricciones_plan", $restricciones_plan);
            $result->bindParam(":estado_plan", $estado_plan);
            $result->bindParam(":descuentos_plan", $descuentos_plan);
            $result->bindParam(":categoria_plan", $categoria_plan);
        
            $result->execute();
        
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Plan actualizado con exito']);
        }
        // Esta funcion realiza la funcion de elimanr el plan
        public function eliminarPlanesAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM planes WHERE codigo_plan = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);

            $result->execute();
            
            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Plan eliminado con exito']);
        }
        // MODULO PEDIDOS Y VENTAS DE PLANES ROL ADMINISTRADOR
        // Esta funcion realiza el registro desde el formulario
        public function registrarPagosPlanesAdmin($fecha_entrega_plan, $hora_entrega_plan, $metodo_pago_plan, $estado_venta_plan, $precio_venta_plan, $codigo_plan, $id_usuario, $forma_entrega, $direccion_entrega){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $insertar = "INSERT INTO ventas_planes (fecha_entrega_plan, hora_entrega_plan, metodo_pago_plan, estado_venta_plan, precio_venta_plan, codigo_plan, id_usuario, forma_entrega, direccion_entrega)
            VALUES (:fecha_entrega_plan, :hora_entrega_plan, :metodo_pago_plan, :estado_venta_plan, :precio_venta_plan, :codigo_plan, :id_usuario, :forma_entrega, :direccion_entrega)";

            $result = $conexion->prepare($insertar);

            $result->bindParam(":fecha_entrega_plan", $fecha_entrega_plan);
            $result->bindParam(":hora_entrega_plan", $hora_entrega_plan);
            $result->bindParam(":metodo_pago_plan", $metodo_pago_plan);
            $result->bindParam(":estado_venta_plan", $estado_venta_plan);
            $result->bindParam(":precio_venta_plan", $precio_venta_plan);
            $result->bindParam(":codigo_plan", $codigo_plan);
            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":forma_entrega", $forma_entrega);
            $result->bindParam(":direccion_entrega", $direccion_entrega);

            $result->execute();

            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'El pedido del plan fue registrado con exito']);
            // echo '<script> alert("REGISTRO DE PAGO EXITOSO") </script>';
            // echo "<script> location.href='../../Views/Administrador/verPagos.php' </script>";
        
        }
        // Funcion para mostrar la tabla de peidos y ventas de planes
        public function mostrarPagosPlanesAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_planes";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para ver el dalle del pedido desde la ta tabla
        public function buscarPedidosCliAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_planes WHERE codigo_venta_plan = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra el metodo de pago en el detalle del pedido de la tabla
        public function buscarMetodoPagoAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_planes WHERE codigo_venta_plan = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra una inner join para el deatlle del pedido de la tabla
        public function buscarPedidosDetalleCliAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            
            // Consulta SQL con INNER JOIN para unir las tablas
            $consultar = "SELECT planes.nombre_plan, planes.descripcion_plan, planes.categoria_plan, planes.restricciones_plan, planes.precio_final_plan,
                ventas_planes.estado_venta_plan
                FROM planes
                INNER JOIN ventas_planes ON planes.codigo_plan = ventas_planes.codigo_plan
                WHERE ventas_planes.codigo_venta_plan  = :id_user;";
                
                
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();
            
            // Mientras existan registros, los convertimos en un arreglo
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra el la direccion de entrega en el detalle del pedido de la tabla
        public function buscarDireccionEntregaAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_planes WHERE codigo_venta_plan = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra el formulario de actualizacion de ventas y pedidos de planes
        public function buscarPagosPlanes($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_planes WHERE codigo_venta_plan = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para mostrar la recibo o comprobante del pedido de los planes 
        public function buscarPagosPlanesAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_planes WHERE codigo_venta_plan = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();
        
            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        public function modificarPagosPlanesAdmin($codigo_venta_plan, $fecha_entrega_plan, $hora_entrega_plan, $metodo_pago_plan, $estado_venta_plan, $precio_venta_plan, $codigo_plan, $id_usuario, $forma_entrega, $direccion_entrega){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            $actualizar = "UPDATE ventas_planes SET
                codigo_venta_plan = :codigo_venta_plan,
                fecha_entrega_plan = :fecha_entrega_plan,
                hora_entrega_plan = :hora_entrega_plan,
                metodo_pago_plan = :metodo_pago_plan,
                estado_venta_plan = :estado_venta_plan,
                precio_venta_plan = :precio_venta_plan,
                codigo_plan = :codigo_plan,
                id_usuario = :id_usuario,
                forma_entrega = :forma_entrega,
                direccion_entrega = :direccion_entrega
            WHERE codigo_venta_plan = :codigo_venta_plan";
        
            $result = $conexion->prepare($actualizar);
        
            $result->bindParam(":codigo_venta_plan", $codigo_venta_plan);
            $result->bindParam(":fecha_entrega_plan", $fecha_entrega_plan);
            $result->bindParam(":hora_entrega_plan", $hora_entrega_plan);
            $result->bindParam(":metodo_pago_plan", $metodo_pago_plan);
            $result->bindParam(":estado_venta_plan", $estado_venta_plan);
            $result->bindParam(":precio_venta_plan", $precio_venta_plan);
            $result->bindParam(":codigo_plan", $codigo_plan);
            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":forma_entrega", $forma_entrega);
            $result->bindParam(":direccion_entrega", $direccion_entrega);
            
            $result->execute();
        
            // echo '<script> alert("Ha modificado la información del Pago del Plan") </script>';
            // echo "<script> location.href='../../Views/Administrador/verPagos.php' </script>";
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Pedido del plan actualizado con exito']);
        }
        // Esta funcion realiza las funciones de eliminacion
        public function eliminarPagosPlanesAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM ventas_planes WHERE codigo_venta_plan = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);

            $result->execute();
            
            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Pedido del plan eliminado con exito']);
        }
        // Esta funcion trae por codigo los planes disponibles
        public function mostrarPlanes() {
            $planes = null;
        
            // Creamos objeto conexión
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            try {
                // Consulta SQL para obtener la lista de planes
                $consultar = "SELECT codigo_plan, nombre_plan FROM planes";
                
                // Preparamos la consulta
                $result = $conexion->prepare($consultar);
        
                // Ejecutamos la consulta
                $result->execute();
        
                // Mientras existan registros, lo que está en result lo convertimos en un arreglo
                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    $planes[] = $resultado;
                }
        
            } catch (PDOException $e) {
                // Manejo de errores de PDO
                echo "Error: " . $e->getMessage();
            }
        
            return $planes;
        }
        // Funcion para mostrar el nombre del plan en la tabla
        public function obtenerNombrePlanPorCodigo($codigoProducto) {
            $nombrePlan = null;
        
            try {
                $consultar = "SELECT nombre_plan FROM planes WHERE codigo_plan = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $codigoProducto, PDO::PARAM_INT);
                $result->execute();
        
                $nombrePlan = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $nombrePlan;
        }
        // Funcion para mostrar el rol del usuario en el recibo de pedidos
        public function obtenerRolUsuario($idUsuario) {
            $rolUsuario = null;
        
            try {
                $consultar = "SELECT rol_usuario FROM usuarios WHERE id_usuario = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $idUsuario, PDO::PARAM_INT);
                $result->execute();
        
                $rolUsuario = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $rolUsuario;
        }
        // Funcion para mostrar el nombre del usuario en el recibo de pedidos
        public function obtenerNombreUsuario($idUsuario) {
            $nombreUsuario = null;
        
            try {
                $consultar = "SELECT nombres_usuario FROM usuarios WHERE id_usuario = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $idUsuario, PDO::PARAM_INT);
                $result->execute();
        
                $nombreUsuario = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $nombreUsuario;
        }
        // Funcion para mostrar el apellido del usuario en el recibo de pedidos
        public function obtenerApellidoUsuario($idUsuario) {
            $apellidoUsuario = null;
        
            try {
                $consultar = "SELECT apellidos_usuario FROM usuarios WHERE id_usuario = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $idUsuario, PDO::PARAM_INT);
                $result->execute();
        
                $apellidoUsuario = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $apellidoUsuario;
        }
        // Funcion para mostrar el telefono del usuario en el recibo de pedidos
        public function obtenerTelefonoUsuario($idUsuario) {
            $telefonoUsuario = null;
        
            try {
                $consultar = "SELECT telefono_usuario FROM usuarios WHERE id_usuario = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $idUsuario, PDO::PARAM_INT);
                $result->execute();
        
                $telefonoUsuario = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $telefonoUsuario;
        }
        // Funcion para mostrar el precio del plan seleccionado 
        public function mostrarPrecioPlan() {
            $planes = null;
        
            // Creamos objeto conexión
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            try {
                // Consulta SQL para obtener la lista de planes
                $consultar = "SELECT codigo_plan, precio_final_plan FROM planes";
                
                // Preparamos la consulta
                $result = $conexion->prepare($consultar);
        
                // Ejecutamos la consulta
                $result->execute();
        
                // Mientras existan registros, lo que está en result lo convertimos en un arreglo
                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    $planes[] = $resultado;
                }
        
            } catch (PDOException $e) {
                // Manejo de errores de PDO
                echo "Error: " . $e->getMessage();
            }
        
            return $planes;
        }
        // MODULO PRODUCTOS ROL ADMINISTRADOR
        // Funcion para registrar un producto, realiza la accion de registrar
        public function registrarProductosAdmin($codigo_producto, $nombre_producto, $descripcion_producto, $cantidad_productos_disponibles, $fecha_vencimiento_producto, $categoria_producto, $marca_producto, $estado_producto, $precio_inicial_producto, $porcentaje_ganancia_producto, $precio_final_producto, $foto_producto){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM productos WHERE codigo_producto = :codigo_producto";
            $result = $conexion->prepare($consultar);

            $result->bindParam(":codigo_producto", $codigo_producto);

            $result->execute();

            $f = $result->fetch();

            if($f){
                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'El codigo del producto ya se encuentra registrado en el sistema']);
            }else{
                $insertar = "INSERT INTO productos (codigo_producto, nombre_producto, descripcion_producto, cantidad_productos_disponibles, fecha_vencimiento_producto, categoria_producto, marca_producto, estado_producto, precio_inicial_producto, porcentaje_ganancia_producto, precio_final_producto, foto_producto)
                VALUES (:codigo_producto, :nombre_producto, :descripcion_producto, :cantidad_productos_disponibles, :fecha_vencimiento_producto, :categoria_producto, :marca_producto, :estado_producto, :precio_inicial_producto, :porcentaje_ganancia_producto, :precio_final_producto, :foto_producto)";

                $result = $conexion->prepare($insertar);

                $result->bindParam(":codigo_producto", $codigo_producto);
                $result->bindParam(":nombre_producto", $nombre_producto);
                $result->bindParam(":descripcion_producto", $descripcion_producto);
                $result->bindParam(":cantidad_productos_disponibles", $cantidad_productos_disponibles);
                $result->bindParam(":fecha_vencimiento_producto", $fecha_vencimiento_producto);
                $result->bindParam(":categoria_producto", $categoria_producto);
                $result->bindParam(":marca_producto", $marca_producto);
                $result->bindParam(":estado_producto", $estado_producto);
                $result->bindParam(":precio_inicial_producto", $precio_inicial_producto);
                $result->bindParam(":porcentaje_ganancia_producto", $porcentaje_ganancia_producto);
                $result->bindParam(":precio_final_producto", $precio_final_producto);
                $result->bindParam(":foto_producto", $foto_producto);
                
                $result->execute();

                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Producto registrado con exito']);
            }
        }
        // Funcion para mostrar la tabla de productos ROL ADMINISTRADOR
        public function mostrarProductosAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM productos";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra la lista de productos diponibles 
        public function mostrarProductosAdministrador(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM productos";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra la informacion de cada producto 
        public function buscarProductosAdministrador($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM productos WHERE codigo_producto = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para enviar el fomulario de actualizacion para mostrar el formulario de actualizacion
        public function buscarProductos($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM productos WHERE codigo_producto = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion realiza la actualizacion de los datos de los productos en el formulario de actualizacion
        public function modificarProductosAdmin($codigo_producto, $nombre_producto, $descripcion_producto, $cantidad_productos_disponibles, $fecha_vencimiento_producto, $categoria_producto, $marca_producto, $estado_producto, $precio_inicial_producto, $porcentaje_ganancia_producto, $precio_final_producto, $foto_producto){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $actualizar = "UPDATE productos SET codigo_producto=:codigo_producto, nombre_producto=:nombre_producto, descripcion_producto=:descripcion_producto, cantidad_productos_disponibles=:cantidad_productos_disponibles, fecha_vencimiento_producto=:fecha_vencimiento_producto, categoria_producto=:categoria_producto, marca_producto=:marca_producto, estado_producto=:estado_producto, precio_inicial_producto=:precio_inicial_producto, porcentaje_ganancia_producto=:porcentaje_ganancia_producto, precio_final_producto=:precio_final_producto, foto_producto=:foto_producto WHERE codigo_producto=:codigo_producto";

            $result = $conexion->prepare($actualizar);

            $result->bindParam(":codigo_producto", $codigo_producto);
            $result->bindParam(":nombre_producto", $nombre_producto);
            $result->bindParam(":descripcion_producto", $descripcion_producto);
            $result->bindParam(":cantidad_productos_disponibles", $cantidad_productos_disponibles);
            $result->bindParam(":fecha_vencimiento_producto", $fecha_vencimiento_producto);
            $result->bindParam(":categoria_producto", $categoria_producto);
            $result->bindParam(":marca_producto", $marca_producto);
            $result->bindParam(":estado_producto", $estado_producto);
            $result->bindParam(":precio_inicial_producto", $precio_inicial_producto);
            $result->bindParam(":porcentaje_ganancia_producto", $porcentaje_ganancia_producto);
            $result->bindParam(":precio_final_producto", $precio_final_producto);
            $result->bindParam(":foto_producto", $foto_producto);

            $result->execute();

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Producto actualizado con exito']);
        }
        // Funcion para realizar la funcion de eliminar un producto
        public function eliminarProductosAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM productos WHERE codigo_producto = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);

            $result->execute();
            
            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Producto eliminado con exito']);
        }
        // MODULO PEDIDOS DE PRODUCTOS A PROVEEDORES
        // Esta funcion realiza el registro desde el formulario
        public function registrarComprasAdmin($fecha_entrega_proveedor, $hora_entrega_proveedor, $metodo_pago_proveedor, $estado_pedido_proveedor, $precio_pedido_proveedor, $codigo_producto, $id_usuario, $forma_entrega_proveedor, $direccion_gimnasio, $cantidad_pedido_proveedor){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            // Verificar si el id de proveedor es valido
            $consultarProveedor = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario AND rol_usuario = 'Proveedor'";
            $resultProveedor = $conexion->prepare($consultarProveedor);
            $resultProveedor->bindParam(":id_usuario", $id_usuario);
            $resultProveedor->execute();

            if (!$resultProveedor->fetch()){
                header('Content-Type: application/json');
                echo json_encode(['error' => true, 'message' => 'Numero de identificacion de proveedor invalido o no es un proveedor registrado']);
                return; // Agrega este return para salir de la función en caso de error
            }else{

                $insertar = "INSERT INTO compras_pedidos (fecha_entrega_proveedor, hora_entrega_proveedor, metodo_pago_proveedor, estado_pedido_proveedor, precio_pedido_proveedor, codigo_producto, id_usuario, forma_entrega_proveedor, direccion_gimnasio, cantidad_pedido_proveedor)
                VALUES (:fecha_entrega_proveedor, :hora_entrega_proveedor, :metodo_pago_proveedor, :estado_pedido_proveedor, :precio_pedido_proveedor, :codigo_producto, :id_usuario, :forma_entrega_proveedor, :direccion_gimnasio, :cantidad_pedido_proveedor)";

                $result = $conexion->prepare($insertar);

                $result->bindParam(":fecha_entrega_proveedor", $fecha_entrega_proveedor);
                $result->bindParam(":hora_entrega_proveedor", $hora_entrega_proveedor);
                $result->bindParam(":metodo_pago_proveedor", $metodo_pago_proveedor);
                $result->bindParam(":estado_pedido_proveedor", $estado_pedido_proveedor);
                $result->bindParam(":precio_pedido_proveedor", $precio_pedido_proveedor);
                $result->bindParam(":codigo_producto", $codigo_producto);
                $result->bindParam(":id_usuario", $id_usuario);
                $result->bindParam(":forma_entrega_proveedor", $forma_entrega_proveedor);
                $result->bindParam(":direccion_gimnasio", $direccion_gimnasio);
                $result->bindParam(":cantidad_pedido_proveedor", $cantidad_pedido_proveedor);

                $result->execute();

                // Devuelve una respuesta en formato JSON para manejar en JavaScript
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'El pedido del producto fue registrado con exito']);
                // echo '<script> alert("REGISTRO DE PAGO EXITOSO") </script>';
                // echo "<script> location.href='../../Views/Administrador/verPagos.php' </script>";
            }
        }
        public function mostrarComprasAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM compras_pedidos";
            $result = $conexion->prepare($consultar);
            $result->execute();
            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para ver el dalle del pedido desde la ta tabla
        public function buscarPedidosProductoProAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM compras_pedidos WHERE codigo_compra_proveedor = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra el metodo de pago en el detalle del pedido de la tabla
        public function buscarMetodoPagoProductoProAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM compras_pedidos WHERE codigo_compra_proveedor = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra una inner join para el deatlle del pedido de la tabla
        public function buscarPedidosDetaProductoProAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            
            // Consulta SQL con INNER JOIN para unir las tablas
            $consultar = "SELECT productos.foto_producto, productos.nombre_producto, productos.descripcion_producto, productos.categoria_producto, productos.marca_producto, 
                productos.precio_final_producto, compras_pedidos.estado_pedido_proveedor
                FROM productos
                INNER JOIN compras_pedidos ON productos.codigo_producto = compras_pedidos.codigo_producto
                WHERE compras_pedidos.codigo_compra_proveedor  = :id_user;";
                
                
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();
            
            // Mientras existan registros, los convertimos en un arreglo
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra el la direccion de entrega en el detalle del pedido de la tabla
        public function buscarDireccionProductoProAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM compras_pedidos WHERE codigo_compra_proveedor = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra el formulario de actualizacion de datos
        public function buscarCompras($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM compras_pedidos WHERE codigo_compra_proveedor = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // Mientras existan registros lo que esta en el result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para mostrar la recibo o comprobante del pedido de los productos a proveedores
        public function buscarPagosProductosProveedores($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM compras_pedidos WHERE codigo_compra_proveedor = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();
        
            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        public function modificarComprasAdmin($codigo_compra_proveedor, $fecha_entrega_proveedor, $hora_entrega_proveedor, $metodo_pago_proveedor, $estado_pedido_proveedor, $precio_pedido_proveedor, $codigo_producto, $id_usuario, $forma_entrega_proveedor, $direccion_gimnasio, $cantidad_pedido_proveedor){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            $actualizar = "UPDATE compras_pedidos SET
                codigo_compra_proveedor = :codigo_compra_proveedor,
                fecha_entrega_proveedor = :fecha_entrega_proveedor,
                hora_entrega_proveedor = :hora_entrega_proveedor,
                metodo_pago_proveedor = :metodo_pago_proveedor,
                estado_pedido_proveedor = :estado_pedido_proveedor,
                precio_pedido_proveedor = :precio_pedido_proveedor,
                codigo_producto = :codigo_producto,
                id_usuario = :id_usuario,
                forma_entrega_proveedor = :forma_entrega_proveedor,
                direccion_gimnasio = :direccion_gimnasio,
                cantidad_pedido_proveedor = :cantidad_pedido_proveedor
            WHERE codigo_compra_proveedor = :codigo_compra_proveedor";
        
            $result = $conexion->prepare($actualizar);
        
            $result->bindParam(":codigo_compra_proveedor", $codigo_compra_proveedor);
            $result->bindParam(":fecha_entrega_proveedor", $fecha_entrega_proveedor);
            $result->bindParam(":hora_entrega_proveedor", $hora_entrega_proveedor);
            $result->bindParam(":metodo_pago_proveedor", $metodo_pago_proveedor);
            $result->bindParam(":estado_pedido_proveedor", $estado_pedido_proveedor);
            $result->bindParam(":precio_pedido_proveedor", $precio_pedido_proveedor);
            $result->bindParam(":codigo_producto", $codigo_producto);
            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":forma_entrega_proveedor", $forma_entrega_proveedor);
            $result->bindParam(":direccion_gimnasio", $direccion_gimnasio);
            $result->bindParam(":cantidad_pedido_proveedor", $cantidad_pedido_proveedor);
            
            $result->execute();
        
            // echo '<script> alert("Ha modificado la información del Pago del Plan") </script>';
            // echo "<script> location.href='../../Views/Administrador/verPagos.php' </script>";
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Pedido del producto actualizado con exito']);
        }
        // Esta funcion realiza las funciones de eliminacion
        public function eliminarPagosProductosProveeAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM compras_pedidos WHERE codigo_compra_proveedor = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);

            $result->execute();
            
            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Pedido del producto a proveedor eliminado con exito']);
        }
        // Esta funcion trae por id los proveedores disponibles
        public function mostrarProveedores() {
            $proveedores = null;
        
            // Creamos objeto conexión
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            try {
                // Consulta SQL para obtener la lista de proveedores
                $consultar = "SELECT id_usuario, nombres_usuario, apellidos_usuario FROM usuarios WHERE rol_usuario = 'Proveedor'";
                
                // Preparamos la consulta
                $result = $conexion->prepare($consultar);
        
                // Ejecutamos la consulta
                $result->execute();
        
                // Mientras existan registros, lo que está en result lo convertimos en un arreglo
                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    $proveedores[] = $resultado;
                }
        
            } catch (PDOException $e) {
                // Manejo de errores de PDO
                echo "Error: " . $e->getMessage();
            }
        
            return $proveedores;
        }
        // Esta funcion trae por codigo los productos disponibles
        public function mostrarProductos() {
            $productos = null;
        
            // Creamos objeto conexión
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            try {
                // Consulta SQL para obtener la lista de planes
                $consultar = "SELECT codigo_producto, nombre_producto FROM productos";
                
                // Preparamos la consulta
                $result = $conexion->prepare($consultar);
        
                // Ejecutamos la consulta
                $result->execute();
        
                // Mientras existan registros, lo que está en result lo convertimos en un arreglo
                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    $productos[] = $resultado;
                }
        
            } catch (PDOException $e) {
                // Manejo de errores de PDO
                echo "Error: " . $e->getMessage();
            }
        
            return $productos;
        }
        // Funcion para mostrar el nombre del producto en la tabla
        public function obtenerNombreProductoPorCodigo($codigoProducto) {
            $nombreProducto = null;
        
            try {
                $consultar = "SELECT nombre_producto FROM productos WHERE codigo_producto = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $codigoProducto, PDO::PARAM_INT);
                $result->execute();
        
                $nombreProducto = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $nombreProducto;
        }
        // Funcion para mostrar el rol del proveedor en el recibo de pedidos
        public function obtenerRolProveedor($idProveedor) {
            $rolUsuario = null;
        
            try {
                $consultar = "SELECT rol_usuario FROM usuarios WHERE id_usuario = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $idProveedor, PDO::PARAM_INT);
                $result->execute();
        
                $rolUsuario = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $rolUsuario;
        }
        // Funcion para mostrar el nombre del proveedor en el recibo de pedidos
        public function obtenerNombreProveedor($idProveedor) {
            $nombreProveedor = null;
        
            try {
                $consultar = "SELECT nombres_usuario FROM usuarios WHERE id_usuario = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $idProveedor, PDO::PARAM_INT);
                $result->execute();
        
                $nombreProveedor = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $nombreProveedor;
        }
        // Funcion para mostrar el apellido del proveedor en el recibo de pedidos
        public function obtenerApellidoProveedor($idProveedor) {
            $apellidoProveedor = null;
        
            try {
                $consultar = "SELECT apellidos_usuario FROM usuarios WHERE id_usuario = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $idProveedor, PDO::PARAM_INT);
                $result->execute();
        
                $apellidoProveedor = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $apellidoProveedor;
        }
        // Funcion para mostrar el telefono del proveedor en el recibo de pedidos
        public function obtenerTelefonoProveedor($idProveedor) {
            $telefonoProveedor = null;
        
            try {
                $consultar = "SELECT telefono_usuario FROM usuarios WHERE id_usuario = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $idProveedor, PDO::PARAM_INT);
                $result->execute();
        
                $telefonoProveedor = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $telefonoProveedor;
        }
        // Esta funcion trae por codigo la imagen del producto seleccionado
        public function mostrarProductosImg() {
            $productos = null;
        
            // Creamos objeto conexión
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            try {
                // Consulta SQL para obtener la lista de planes
                $consultar = "SELECT codigo_producto, foto_producto FROM productos";
                
                // Preparamos la consulta
                $result = $conexion->prepare($consultar);
        
                // Ejecutamos la consulta
                $result->execute();
        
                // Mientras existan registros, lo que está en result lo convertimos en un arreglo
                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    $productos[] = $resultado;
                }
        
            } catch (PDOException $e) {
                // Manejo de errores de PDO
                echo "Error: " . $e->getMessage();
            }
        
            return $productos;
        }
        // Funcion para mostrar el precio del producto seleccionado 
        public function mostrarPrecioProducto() {
            $productos = null;
        
            // Creamos objeto conexión
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            try {
                // Consulta SQL para obtener la lista de planes
                $consultar = "SELECT codigo_producto, precio_final_producto FROM productos";
                
                // Preparamos la consulta
                $result = $conexion->prepare($consultar);
        
                // Ejecutamos la consulta
                $result->execute();
        
                // Mientras existan registros, lo que está en result lo convertimos en un arreglo
                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    $productos[] = $resultado;
                }
        
            } catch (PDOException $e) {
                // Manejo de errores de PDO
                echo "Error: " . $e->getMessage();
            }
        
            return $productos;
        }
        // MODULO PEDIDOS DE PRODUCTOA A CLIENTES
        // Esta funcion realiza el registro desde el formulario
        public function registrarVentasClientesAdmin($fecha_entrega_cliente, $hora_entrega_cliente, $metodo_pago_cliente, $estado_pedido_cliente, $precio_pedido_cliente, $codigo_producto, $id_usuario, $forma_entrega_cliente, $direccion_residencia){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $insertar = "INSERT INTO ventas_pedidos (fecha_entrega_cliente, hora_entrega_cliente, metodo_pago_cliente, estado_pedido_cliente, precio_pedido_cliente, codigo_producto, id_usuario, forma_entrega_cliente, direccion_residencia)
            VALUES (:fecha_entrega_cliente, :hora_entrega_cliente, :metodo_pago_cliente, :estado_pedido_cliente, :precio_pedido_cliente, :codigo_producto, :id_usuario, :forma_entrega_cliente, :direccion_residencia)";

            $result = $conexion->prepare($insertar);

            $result->bindParam(":fecha_entrega_cliente", $fecha_entrega_cliente);
            $result->bindParam(":hora_entrega_cliente", $hora_entrega_cliente);
            $result->bindParam(":metodo_pago_cliente", $metodo_pago_cliente);
            $result->bindParam(":estado_pedido_cliente", $estado_pedido_cliente);
            $result->bindParam(":precio_pedido_cliente", $precio_pedido_cliente);
            $result->bindParam(":codigo_producto", $codigo_producto);
            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":forma_entrega_cliente", $forma_entrega_cliente);
            $result->bindParam(":direccion_residencia", $direccion_residencia);

            $result->execute();

            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'El pedido del producto fue registrado con exito']);
            // echo '<script> alert("REGISTRO DE PAGO EXITOSO") </script>';
            // echo "<script> location.href='../../Views/Administrador/verPagos.php' </script>";
        
        }
        // Esta funcion muestra el formulario de actualizacion de datos
        public function buscarVentasClientes($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_pedidos WHERE codigo_venta_producto = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // Mientras existan registros lo que esta en el result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para mostrar la recibo o comprobante del pedido de los productos a clientes
        public function buscarPagosProductosClientes($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_pedidos WHERE codigo_venta_producto = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();
        
            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra la tabla de pedidos de productos de clientes
        public function mostrarVentasClientesAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_pedidos";
            $result = $conexion->prepare($consultar);
            $result->execute();
            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para ver el dalle del pedido desde la ta tabla
        public function buscarPedidosProductoCliAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_pedidos WHERE codigo_venta_producto = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra el metodo de pago en el detalle del pedido de la tabla
        public function buscarMetodoPagoProductoCliAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_pedidos WHERE codigo_venta_producto = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra una inner join para el detalle del pedido de la tabla
        public function buscarPedidosDetaProductoCliAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            
            // Consulta SQL con INNER JOIN para unir las tablas
            $consultar = "SELECT productos.foto_producto, productos.nombre_producto, productos.descripcion_producto, productos.categoria_producto, productos.marca_producto, 
                productos.precio_final_producto, ventas_pedidos.estado_pedido_cliente
                FROM productos
                INNER JOIN ventas_pedidos ON productos.codigo_producto = ventas_pedidos.codigo_producto
                WHERE ventas_pedidos.codigo_venta_producto  = :id_user;";
                
                
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();
            
            // Mientras existan registros, los convertimos en un arreglo
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion muestra el la direccion de entrega en el detalle del pedido de la tabla
        public function buscarDireccionProductoCliAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM ventas_pedidos WHERE codigo_venta_producto = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        public function modificarVentasClientesAdmin($codigo_venta_producto, $fecha_entrega_cliente, $hora_entrega_cliente, $metodo_pago_cliente, $estado_pedido_cliente, $precio_pedido_cliente, $codigo_producto, $id_usuario, $forma_entrega_cliente, $direccion_residencia){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            $actualizar = "UPDATE ventas_pedidos SET
                codigo_venta_producto = :codigo_venta_producto,
                fecha_entrega_cliente = :fecha_entrega_cliente,
                hora_entrega_cliente = :hora_entrega_cliente,
                metodo_pago_cliente = :metodo_pago_cliente,
                estado_pedido_cliente = :estado_pedido_cliente,
                precio_pedido_cliente = :precio_pedido_cliente,
                codigo_producto = :codigo_producto,
                id_usuario = :id_usuario,
                forma_entrega_cliente = :forma_entrega_cliente,
                direccion_residencia = :direccion_residencia
            WHERE codigo_venta_producto = :codigo_venta_producto";
        
            $result = $conexion->prepare($actualizar);
        
            $result->bindParam(":codigo_venta_producto", $codigo_venta_producto);
            $result->bindParam(":fecha_entrega_cliente", $fecha_entrega_cliente);
            $result->bindParam(":hora_entrega_cliente", $hora_entrega_cliente);
            $result->bindParam(":metodo_pago_cliente", $metodo_pago_cliente);
            $result->bindParam(":estado_pedido_cliente", $estado_pedido_cliente);
            $result->bindParam(":precio_pedido_cliente", $precio_pedido_cliente);
            $result->bindParam(":codigo_producto", $codigo_producto);
            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":forma_entrega_cliente", $forma_entrega_cliente);
            $result->bindParam(":direccion_residencia", $direccion_residencia);
            
            $result->execute();
        
            // echo '<script> alert("Ha modificado la información del Pago del Plan") </script>';
            // echo "<script> location.href='../../Views/Administrador/verPagos.php' </script>";
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Pedido del producto actualizado con exito']);
        }
        // Esta funcion realiza las funciones de eliminacion
        public function eliminarPagosProductosClienteAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM ventas_pedidos WHERE codigo_venta_producto = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);

            $result->execute();
            
            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Pedido del producto a cliente eliminado con exito']);
        }
        // Funcion para mostrar el rol del cliente en el recibo de pedidos
        public function obtenerRolCliente($idCliente) {
            $rolUsuario = null;
        
            try {
                $consultar = "SELECT rol_usuario FROM usuarios WHERE id_usuario = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $idCliente, PDO::PARAM_INT);
                $result->execute();
        
                $rolUsuario = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $rolUsuario;
        }
        // MODULO INSCRIPCIONES LIBRES ROL ADMINISTRADOR
        // Funcion para registrar desde el formulario la inscipcion libre
        public function registrarInscripLibreAdmin($fecha_inicio_actividad, $hora_inicio_actividad, $estado_inscripcion_libre, $comentarios_inscripcion_libre, $codigo_actividad, $codigo_venta_plan, $id_usuario){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            // Verificar la existencia del plan en ventas_planes asociado al usuario
            $consulta_plan_usuario = "SELECT * FROM ventas_planes WHERE codigo_venta_plan = :codigo_venta_plan AND id_usuario = :id_usuario AND estado_venta_plan = 'Entregado'";
            $result_plan_usuario = $conexion->prepare($consulta_plan_usuario);
            $result_plan_usuario->bindParam(":codigo_venta_plan", $codigo_venta_plan);
            $result_plan_usuario->bindParam(":id_usuario", $id_usuario);
            $result_plan_usuario->execute();

            if (!$result_plan_usuario->fetch()) {
                // No cumple con los requisitos, manejar el error
                header('Content-Type: application/json');
                echo json_encode(['error' => true, 'message' => 'El usuario no tiene el plan correspondiente o no ha sido entregado para realizar la inscripción libre.']);
                return;
            }

            $insertar = "INSERT INTO inscripciones_libres (fecha_inicio_actividad, hora_inicio_actividad, estado_inscripcion_libre, comentarios_inscripcion_libre, codigo_actividad, codigo_venta_plan, id_usuario)
            VALUES (:fecha_inicio_actividad, :hora_inicio_actividad, :estado_inscripcion_libre, :comentarios_inscripcion_libre, :codigo_actividad, :codigo_venta_plan, :id_usuario)";

            $result = $conexion->prepare($insertar);

            $result->bindParam(":fecha_inicio_actividad", $fecha_inicio_actividad);
            $result->bindParam(":hora_inicio_actividad", $hora_inicio_actividad);
            $result->bindParam(":estado_inscripcion_libre", $estado_inscripcion_libre);
            $result->bindParam(":comentarios_inscripcion_libre", $comentarios_inscripcion_libre);
            $result->bindParam(":codigo_actividad", $codigo_actividad);
            $result->bindParam(":codigo_venta_plan", $codigo_venta_plan);
            $result->bindParam(":id_usuario", $id_usuario);

            $result->execute();

            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Inscripcion libre registrada con exito']);
 
        }
        // funcion para mostrar la tabla de inscripciones
        public function mostrarInscripcionesLibresAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM inscripciones_libres";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion trae por codigo las actividades disponibles
        public function mostrarActividades() {
            $actividades = null;
        
            // Creamos objeto conexión
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            try {
                // Consulta SQL para obtener la lista de actividades
                $consultar = "SELECT codigo_actividad, nombre_actividad FROM actividades";
                
                // Preparamos la consulta
                $result = $conexion->prepare($consultar);
        
                // Ejecutamos la consulta
                $result->execute();
        
                // Mientras existan registros, lo que está en result lo convertimos en un arreglo
                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    $actividades[] = $resultado;
                }
        
            } catch (PDOException $e) {
                // Manejo de errores de PDO
                echo "Error: " . $e->getMessage();
            }
        
            return $actividades;
        }
        // Esta funcion trae por id los clientes disponibles
        public function mostrarClientes() {
            $clientes = null;
        
            // Creamos objeto conexión
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            try {
                // Consulta SQL para obtener la lista de clientes
                $consultar = "SELECT id_usuario, nombres_usuario, apellidos_usuario FROM usuarios WHERE rol_usuario IN ('Cliente', 'Administrador')";
                
                // Preparamos la consulta
                $result = $conexion->prepare($consultar);
        
                // Ejecutamos la consulta
                $result->execute();
        
                // Mientras existan registros, lo que está en result lo convertimos en un arreglo
                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    $clientes[] = $resultado;
                }
        
            } catch (PDOException $e) {
                // Manejo de errores de PDO
                echo "Error: " . $e->getMessage();
            }
        
            return $clientes;
        }
        // Funcion para mostrar el nombre de la actividad en la tabla
        public function obtenerNombreActividadPorCodigo($codigoActividad) {
            $nombreActividad = null;
        
            try {
                $consultar = "SELECT nombre_actividad FROM actividades WHERE codigo_actividad = :codigo";
                $result = $this->conexion->prepare($consultar);
                $result->bindParam(':codigo', $codigoActividad, PDO::PARAM_INT);
                $result->execute();
        
                $nombreActividad = $result->fetchColumn();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            return $nombreActividad;
        }
        // Esta funcion busca el formulario de actualizacion para mostrarlo en pantalla el formulario de actualizacion
        public function buscarInscripcionesLibres($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM inscripciones_libres WHERE codigo_inscripcion_libre = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Funcion para mostrar la recibo o comprobante de la inscripcion libre 
        public function buscarInscripcionLiAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM inscripciones_libres WHERE codigo_inscripcion_libre = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();
        
            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // esta funcion realiza la actualizacion en el formulario de actualizacion
        public function modificarInscripcionLiAdmin($codigo_inscripcion_libre, $fecha_inicio_actividad, $hora_inicio_actividad, $estado_inscripcion_libre, $comentarios_inscripcion_libre, $codigo_actividad, $codigo_venta_plan, $id_usuario){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            $actualizar = "UPDATE inscripciones_libres SET
                codigo_inscripcion_libre = :codigo_inscripcion_libre,
                fecha_inicio_actividad = :fecha_inicio_actividad,
                hora_inicio_actividad = :hora_inicio_actividad,
                estado_inscripcion_libre = :estado_inscripcion_libre,
                comentarios_inscripcion_libre = :comentarios_inscripcion_libre,
                codigo_actividad = :codigo_actividad,
                codigo_venta_plan = :codigo_venta_plan,
                id_usuario = :id_usuario
            WHERE codigo_inscripcion_libre = :codigo_inscripcion_libre";
        
            $result = $conexion->prepare($actualizar);
        
            $result->bindParam(":codigo_inscripcion_libre", $codigo_inscripcion_libre);
            $result->bindParam(":fecha_inicio_actividad", $fecha_inicio_actividad);
            $result->bindParam(":hora_inicio_actividad", $hora_inicio_actividad);
            $result->bindParam(":estado_inscripcion_libre", $estado_inscripcion_libre);
            $result->bindParam(":comentarios_inscripcion_libre", $comentarios_inscripcion_libre);
            $result->bindParam(":codigo_actividad", $codigo_actividad);
            $result->bindParam(":codigo_venta_plan", $codigo_venta_plan);
            $result->bindParam(":id_usuario", $id_usuario);
            
            $result->execute();
        
            // echo '<script> alert("Ha modificado la información del Pago del Plan") </script>';
            // echo "<script> location.href='../../Views/Administrador/verPagos.php' </script>";
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Inscripcion de actividad actualizada con exito']);
        }
        // Esta funcion realiza las funciones de eliminacion
        public function eliminarInscripLiAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM inscripciones_libres WHERE codigo_inscripcion_libre = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);

            $result->execute();
            
            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Inscripcion libre eliminada con exito']);
        }
        // MODULO INSCRIPCIONES PERSONALIZADAS ROL ADMINISTRADOR
        // Funcion para registrar desde el formulario la inscipcion libre
        public function registrarInscripPersoAdmin($fecha_inicio_actividad, $hora_inicio_actividad, $estado_inscripcion_perso, $comentarios_inscripcion_perso, $codigo_actividad, $codigo_venta_plan, $id_usuario, $id_entrenador) {
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            // Verificar la existencia del plan en ventas_planes
            $consulta_plan = "SELECT * FROM ventas_planes WHERE codigo_venta_plan = :codigo_venta_plan AND estado_venta_plan = 'Entregado' AND (codigo_plan = '2025' OR codigo_plan = '2026')";
            $result_plan = $conexion->prepare($consulta_plan);
            $result_plan->bindParam(":codigo_venta_plan", $codigo_venta_plan);
            $result_plan->execute();

            if (!$result_plan->fetch()) {
                // No cumple con los requisitos, manejar el error
                header('Content-Type: application/json');
                echo json_encode(['error' => true, 'message' => 'Lo sentimos, el plan no cumple con los requisitos para inscripciones personalizadas o no ha sido entregado. Por favor, contacta al administrador para más información.']);
                return;
            }

            // Resto del código para la inserción en inscripciones_personalizadas
            $insertar = "INSERT INTO inscripciones_personalizadas (fecha_inicio_actividad, hora_inicio_actividad, estado_inscripcion_perso, comentarios_inscripcion_perso, codigo_actividad, codigo_venta_plan, id_usuario, id_entrenador)
                VALUES (:fecha_inicio_actividad, :hora_inicio_actividad, :estado_inscripcion_perso, :comentarios_inscripcion_perso, :codigo_actividad, :codigo_venta_plan, :id_usuario, :id_entrenador)";

            $result = $conexion->prepare($insertar);

            $result->bindParam(":fecha_inicio_actividad", $fecha_inicio_actividad);
            $result->bindParam(":hora_inicio_actividad", $hora_inicio_actividad);
            $result->bindParam(":estado_inscripcion_perso", $estado_inscripcion_perso);
            $result->bindParam(":comentarios_inscripcion_perso", $comentarios_inscripcion_perso);
            $result->bindParam(":codigo_actividad", $codigo_actividad);
            $result->bindParam(":codigo_venta_plan", $codigo_venta_plan);
            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":id_entrenador", $id_entrenador);

            $result->execute();

            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Inscripcion personalizada registrada con exito']);
        }        
        // funcion para mostrar la tabla de inscripciones
        public function mostrarInscripcionesPersoAdmin(){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM inscripciones_personalizadas";
            $result = $conexion->prepare($consultar);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion trae por id los entrenadores disponibles
        public function mostrarEntrenadores() {
            $entrenadores = null;
        
            // Creamos objeto conexión
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            try {
                // Consulta SQL para obtener la lista de proveedores
                $consultar = "SELECT id_usuario, nombres_usuario, apellidos_usuario FROM usuarios WHERE rol_usuario = 'Entrenador'";
                
                // Preparamos la consulta
                $result = $conexion->prepare($consultar);
        
                // Ejecutamos la consulta
                $result->execute();
        
                // Mientras existan registros, lo que está en result lo convertimos en un arreglo
                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    $entrenadores[] = $resultado;
                }
        
            } catch (PDOException $e) {
                // Manejo de errores de PDO
                echo "Error: " . $e->getMessage();
            }
        
            return $entrenadores;
        }
        // Esta funcion trae por codigo las actividades disponibles
        public function mostrarActividadesInscrip() {
            $actividades = null;
        
            // Creamos objeto conexión
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            try {
                // Consulta SQL para obtener la lista de planes
                $consultar = "SELECT codigo_actividad, nombre_actividad FROM actividades";
                
                // Preparamos la consulta
                $result = $conexion->prepare($consultar);
        
                // Ejecutamos la consulta
                $result->execute();
        
                // Mientras existan registros, lo que está en result lo convertimos en un arreglo
                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    $actividades[] = $resultado;
                }
        
            } catch (PDOException $e) {
                // Manejo de errores de PDO
                echo "Error: " . $e->getMessage();
            }
        
            return $actividades;
        }
        // Funcion para mostrar la recibo o comprobante de la inscripcion personalizada 
        public function buscarInscripcionPersoAdmin($id_user){
            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM inscripciones_personalizadas WHERE codigo_inscripcion_perso = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();
        
            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // Esta funcion busca el formulario de actualizacion para mostrarlo en pantalla el formulario de actualizacion
        public function buscarInscripcionesPerso($id_user){

            $f = null;
            // Creamos objeto conexion
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            // prepare
            $consultar = "SELECT * FROM inscripciones_personalizadas WHERE codigo_inscripcion_perso = :id_user";
            $result = $conexion->prepare($consultar);
            $result->bindParam(":id_user", $id_user);
            $result->execute();

            // mientras existan registro loq que esta en result lo convertimos en un arreglo, para separar dato por dato
            while ($resultado = $result->fetch()) {
                $f[] = $resultado;
            }
            return $f;
        }
        // esta funcion realiza la actualizacion en el formulario de actualizacion
        public function modificarInscripcionPersoAdmin($codigo_inscripcion_perso, $fecha_inicio_actividad, $hora_inicio_actividad, $estado_inscripcion_perso, $comentarios_inscripcion_perso, $codigo_actividad, $codigo_venta_plan, $id_usuario, $id_entrenador){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
        
            $actualizar = "UPDATE inscripciones_personalizadas SET
                codigo_inscripcion_perso = :codigo_inscripcion_perso,
                fecha_inicio_actividad = :fecha_inicio_actividad,
                hora_inicio_actividad = :hora_inicio_actividad,
                estado_inscripcion_perso = :estado_inscripcion_perso,
                comentarios_inscripcion_perso = :comentarios_inscripcion_perso,
                codigo_actividad = :codigo_actividad,
                codigo_venta_plan = :codigo_venta_plan,
                id_usuario = :id_usuario,
                id_entrenador = :id_entrenador
            WHERE codigo_inscripcion_perso = :codigo_inscripcion_perso";
        
            $result = $conexion->prepare($actualizar);
        
            $result->bindParam(":codigo_inscripcion_perso", $codigo_inscripcion_perso);
            $result->bindParam(":fecha_inicio_actividad", $fecha_inicio_actividad);
            $result->bindParam(":hora_inicio_actividad", $hora_inicio_actividad);
            $result->bindParam(":estado_inscripcion_perso", $estado_inscripcion_perso);
            $result->bindParam(":comentarios_inscripcion_perso", $comentarios_inscripcion_perso);
            $result->bindParam(":codigo_actividad", $codigo_actividad);
            $result->bindParam(":codigo_venta_plan", $codigo_venta_plan);
            $result->bindParam(":id_usuario", $id_usuario);
            $result->bindParam(":id_entrenador", $id_entrenador);
            
            $result->execute();
        
            // echo '<script> alert("Ha modificado la información del Pago del Plan") </script>';
            // echo "<script> location.href='../../Views/Administrador/verPagos.php' </script>";
            // Devuelve una respuesta en formato JSON para manejar en JavaScript
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Inscripcion de actividad actualizada con exito']);
        }
        // Esta funcion realiza las funciones de eliminacion
        public function eliminarInscripPersoAdmin($id_user){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();

            $eliminar = "DELETE FROM inscripciones_personalizadas WHERE codigo_inscripcion_perso = :id_user";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":id_user", $id_user);

            $result->execute();
            
            // Envía una respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Inscripcion personalizada eliminada con exito']);
        }
    }
?>