<?php 
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    $codigo_actividad = $_POST['codigo_actividad'];
    $nombre_actividad = $_POST['nombre_actividad'];
    $descripcion_actividad = $_POST['descripcion_actividad'];
    $tipo_actividad = $_POST['tipo_actividad'];
    $requisitos_actividad = $_POST['requisitos_actividad'];
    $estado_actividad = $_POST['estado_actividad'];
    $objetivos_actividad = $_POST['objetivos_actividad'];
    $area_actividad = $_POST['area_actividad'];

    // Verificar si algún campo está vacío
    if (empty($codigo_actividad) || empty($nombre_actividad) || empty($descripcion_actividad) || empty($tipo_actividad) || empty($requisitos_actividad) || empty($estado_actividad) || empty($objetivos_actividad) || empty($area_actividad)) {
        echo json_encode(['success' => false, 'message' => 'Error, por favor complete los campos para registrar la actividad']);
        exit; // Detener la ejecución si hay campos vacíos
    }

    // Logica para carga imagenes a un formulario

    // DFINIMOS EL PESO LIMITE Y FORMATOS DE IMAGENES PERMITIDOS
    define('LIMITE', 2000);
    define('ARREGLO', serialize(array('image/jpg', 'image/png', 'image/jpeg', 'image/gif')));
    $PERMITIDOS = unserialize(ARREGLO);


    // AHORA VALIDAMOS QUE EL ARCHIVO SI HAYA SIDO CARGADO Y NO TENGA ERRORES

    if ($_FILES['foto_actividad']['error']) {

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => '¡Error al cargar imagen, intente nuevamente!']);

    } else {

        // CONFIRMAMOS FORMATO DE IMAGEN Y PESO

        if (in_array($_FILES['foto_actividad']['type'], $PERMITIDOS) && $_FILES['foto_actividad']['size'] <= LIMITE * 1024) {
            

            // CAPTURAMOS LOS VALORES A GUARDAR EN LA BASE DE DATOS

            $foto_actividad = "../../uploads/users/".$_FILES['foto_actividad']['name'];

            // MOVEMOS EL ARCHIVO A LA CARPETA SELECCIONADA

            $resultado = move_uploaded_file($_FILES['foto_actividad']['tmp_name'], $foto_actividad);

            
            // CREAMOS UN OBJETO A PARTIR DE LA CLASE CONSULTAS
            // PARA PODER ENVIAR LOS ARGUMENTOS A UNA FUNCION ESPECIFICA (registrarUserAdmin)

            $objConsultas = new Consultas();
            $result = $objConsultas->registrarActividadesAdmin(
                $codigo_actividad,
                $nombre_actividad, 
                $descripcion_actividad, 
                $tipo_actividad, 
                $requisitos_actividad, 
                $estado_actividad, 
                $objetivos_actividad, 
                $area_actividad,
                $foto_actividad
            );

        } else {

            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => '¡Error al cargar imagen, revisar formato de peso!']);

        }

    }
?>