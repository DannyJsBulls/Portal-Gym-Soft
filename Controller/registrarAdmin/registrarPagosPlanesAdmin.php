<?php
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    // Obtén todos los valores del formulario
    // $codigo_venta_plan = $_POST['codigo_venta_plan'];
    $fecha_entrega_plan = $_POST['fecha_entrega_plan'];
    $hora_entrega_plan = $_POST['hora_entrega_plan'];
    $metodo_pago_plan = $_POST['metodo_pago_plan'];
    $estado_venta_plan = 'Comprado';
    $precio_venta_plan = $_POST['precio_venta_plan'];
    $codigo_plan = $_POST['codigo_plan'];
    $id_usuario = $_POST['id_usuario'];
    $forma_entrega = $_POST['forma_entrega'];
    $direccion_entrega = $_POST['direccion_entrega'];
    
    // Verificar si algún campo está vacío
    if (empty($fecha_entrega_plan) || empty($hora_entrega_plan) || empty($metodo_pago_plan) || empty($estado_venta_plan) || empty($precio_venta_plan) || empty($codigo_plan) || empty($id_usuario) || empty($forma_entrega) || empty($direccion_entrega)) {
        echo json_encode(['success' => false, 'message' => 'Error, por favor complete los campos para realizar el pedido']);
        exit; // Detener la ejecución si hay campos vacíos
    }

    // Si no hay campos vacíos, proceder con el registro
    $objConsultas = new Consultas();
    $result = $objConsultas->registrarPagosPlanesAdmin(
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