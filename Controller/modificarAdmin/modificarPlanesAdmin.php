<?php 
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    $codigo_plan = $_POST['codigo_plan'];
    $nombre_plan = $_POST['nombre_plan'];
    $descripcion_plan = $_POST['descripcion_plan'];
    $precio_plan = $_POST['precio_plan'];
    $porcentaje_ganancia_plan = $_POST['porcentaje_ganancia_plan'];
    $precio_final_plan = $_POST['precio_final_plan'];
    $duracion_plan = $_POST['duracion_plan'];
    $acceso_servicios_plan = $_POST['acceso_servicios_plan'];
    $restricciones_plan = $_POST['restricciones_plan'];
    $estado_plan = $_POST['estado_plan'];
    $descuentos_plan = $_POST['descuentos_plan'];
    $categoria_plan = $_POST['categoria_plan'];

    
    $objConsultas = new Consultas();
    $result = $objConsultas->modificarPlanesAdmin(
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