<?php 
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    $codigo_producto = $_POST['codigo_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion_producto = $_POST['descripcion_producto'];
    $cantidad_productos_disponibles = $_POST['cantidad_productos_disponibles'];
    $fecha_vencimiento_producto = $_POST['fecha_vencimiento_producto'];
    $categoria_producto = $_POST['categoria_producto'];
    $marca_producto = $_POST['marca_producto'];
    $estado_producto = $_POST['estado_producto'];
    $precio_inicial_producto = $_POST['precio_inicial_producto'];
    $porcentaje_ganancia_producto = $_POST['porcentaje_ganancia_producto'];
    $precio_final_producto = $_POST['precio_final_producto'];

    // Logica para carga imagenes a un formulario

    // DFINIMOS EL PESO LIMITE Y FORMATOS DE IMAGENES PERMITIDOS
    define('LIMITE', 2000);
    define('ARREGLO', serialize(array('image/jpg', 'image/png', 'image/jpeg', 'image/gif')));
    $PERMITIDOS = unserialize(ARREGLO);


    // AHORA VALIDAMOS QUE EL ARCHIVO SI HAYA SIDO CARGADO Y NO TENGA ERRORES

    if ($_FILES['foto_producto']['error']) {

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => '¡Error al cargar imagen, intente nuevamente!']);

    } else {

        // CONFIRMAMOS FORMATO DE IMAGEN Y PESO

        if (in_array($_FILES['foto_producto']['type'], $PERMITIDOS) && $_FILES['foto_producto']['size'] <= LIMITE * 1024) {
            

            // CAPTURAMOS LOS VALORES A GUARDAR EN LA BASE DE DATOS

            $foto_producto = "../../uploads/users/".$_FILES['foto_producto']['name'];

            // MOVEMOS EL ARCHIVO A LA CARPETA SELECCIONADA

            $resultado = move_uploaded_file($_FILES['foto_producto']['tmp_name'], $foto_producto);

            // CREAMOS UN OBJETO A PARTIR DE LA CLASE CONSULTAS
            // PARA PODER ENVIAR LOS ARGUMENTOS A UNA FUNCION ESPECIFICA (registrarUserAdmin)

            $objConsultas = new Consultas();
            $result = $objConsultas->modificarProductosAdmin(
                $codigo_producto, 
                $nombre_producto, 
                $descripcion_producto, 
                $cantidad_productos_disponibles, 
                $fecha_vencimiento_producto, 
                $categoria_producto, 
                $marca_producto, 
                $estado_producto, 
                $precio_inicial_producto, 
                $porcentaje_ganancia_producto, 
                $precio_final_producto,
                $foto_producto
            );


        } else {

            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => '¡Error al cargar imagen, revisar formato de peso!']);

        }

    }

?>