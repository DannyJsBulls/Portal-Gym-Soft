<?php 
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    $id_usuario = $_POST['id_usuario'];
    $tipo_documento_usuario = $_POST['tipo_documento_usuario'];
    $nombres_usuario = $_POST['nombres_usuario'];
    $apellidos_usuario = $_POST['apellidos_usuario'];
    $fecha_nacimiento_usuario = $_POST['fecha_nacimiento_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $telefono_usuario = $_POST['telefono_usuario'];

    $clave = $_POST['id_usuario'];
    $rol_usuario = $_POST['rol_usuario'];    
    $estado_usuario = $_POST['estado_usuario'];

    // Verificar si algún campo está vacío
    if (empty($id_usuario) || empty($tipo_documento_usuario) || empty($nombres_usuario) || empty($apellidos_usuario) || empty($fecha_nacimiento_usuario) || empty($email_usuario) || empty($telefono_usuario)) {
        echo json_encode(['success' => false, 'message' => 'Error, por favor complete los campos para registrar el cliente']);
        exit; // Detener la ejecución si hay campos vacíos
    }

    // Logica para carga imagenes a un formulario

    // DFINIMOS EL PESO LIMITE Y FORMATOS DE IMAGENES PERMITIDOS
    define('LIMITE', 2000);
    define('ARREGLO', serialize(array('image/jpg', 'image/png', 'image/jpeg', 'image/gif')));
    $PERMITIDOS = unserialize(ARREGLO);


    // AHORA VALIDAMOS QUE EL ARCHIVO SI HAYA SIDO CARGADO Y NO TENGA ERRORES

    if ($_FILES['foto_usuario']['error']) {

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => '¡Error al cargar imagen, intente nuevamente!']);

    } else {

        // CONFIRMAMOS FORMATO DE IMAGEN Y PESO

        if (in_array($_FILES['foto_usuario']['type'], $PERMITIDOS) && $_FILES['foto_usuario']['size'] <= LIMITE * 1024) {
            

            // CAPTURAMOS LOS VALORES A GUARDAR EN LA BASE DE DATOS

            $foto_usuario = "../../uploads/users/".$_FILES['foto_usuario']['name'];

            // MOVEMOS EL ARCHIVO A LA CARPETA SELECCIONADA

            $resultado = move_uploaded_file($_FILES['foto_usuario']['tmp_name'], $foto_usuario);

            // Encriptamos clave

            $clavemd = password_hash($clave, PASSWORD_DEFAULT);

            // CREAMOS UN OBJETO A PARTIR DE LA CLASE CONSULTAS
            // PARA PODER ENVIAR LOS ARGUMENTOS A UNA FUNCION ESPECIFICA (registrarUserAdmin)

            $objConsultas = new Consultas();
            $result = $objConsultas->registrarClienteAdmin($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $estado_usuario, $rol_usuario, $clavemd, $foto_usuario);



        } else {

            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => '¡Error al cargar imagen, revisar formato de peso!']);

        }

    }
?>