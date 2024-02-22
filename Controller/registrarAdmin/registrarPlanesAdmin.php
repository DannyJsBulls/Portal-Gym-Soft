<?php
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    // Obtén todos los valores del formulario
    $codigo_plan = $_POST['codigo_plan'];
    $nombre_plan = $_POST['nombre_plan'];
    $descripcion_plan = $_POST['descripcion_plan'];
    $precio_plan = $_POST['precio_plan'];
    $porcentaje_ganancia_plan = $_POST['porcentaje_ganancia_plan'];
    $precio_final_plan = 0;
    $duracion_plan = $_POST['duracion_plan'];
    $acceso_servicios_plan = $_POST['acceso_servicios_plan'];
    $restricciones_plan = $_POST['restricciones_plan'];
    $estado_plan = $_POST['estado_plan'];
    $descuentos_plan = $_POST['descuentos_plan'];
    $categoria_plan = $_POST['categoria_plan'];

    // Verificar si algún campo está vacío
    if (empty($codigo_plan) || empty($nombre_plan) || empty($descripcion_plan) || empty($precio_plan) || empty($porcentaje_ganancia_plan) || empty($duracion_plan) || empty($acceso_servicios_plan) || empty($restricciones_plan) || empty($estado_plan) || empty($descuentos_plan) || empty($categoria_plan)) {
        echo json_encode(['success' => false, 'message' => 'Error, por favor complete todos los campos para realizar el registro']);
        exit; // Detener la ejecución si hay campos vacíos
    }

    // Si no hay campos vacíos, proceder con el registro
    $objConsultas = new Consultas();
    $result = $objConsultas->registrarPlanesAdmin(
        $codigo_plan,
        $nombre_plan,
        $descripcion_plan,
        $precio_plan,
        $porcentaje_ganancia_plan,
        $precio_final_plan,
        $duracion_plan,
        $acceso_servicios_plan,
        $restricciones_plan,
        $estado_plan,
        $descuentos_plan,
        $categoria_plan
    );

?>
