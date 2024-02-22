<?php 
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    $codigo_venta_plan = $_POST['codigo_venta_plan'];
    $fecha_entrega_plan = $_POST['fecha_entrega_plan'];
    $hora_entrega_plan = $_POST['hora_entrega_plan'];
    $metodo_pago_plan = $_POST['metodo_pago_plan'];
    $estado_venta_plan = $_POST['estado_venta_plan'];
    $precio_venta_plan = $_POST['precio_venta_plan'];
    $codigo_plan = $_POST['codigo_plan'];
    $id_usuario = $_POST['id_usuario'];
    $forma_entrega = $_POST['forma_entrega'];
    $direccion_entrega = $_POST['direccion_entrega'];
    
    $objConsultas = new Consultas();
    $result = $objConsultas->modificarPagosPlanesAdmin(
        $codigo_venta_plan,
        $fecha_entrega_plan,
        $hora_entrega_plan,
        $metodo_pago_plan,
        $estado_venta_plan,
        $precio_venta_plan,
        $codigo_plan,
        $id_usuario,
        $forma_entrega,
        $direccion_entrega
    );

?>