<?php 
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    $fecha_entrega_cliente = $_POST['fecha_entrega_cliente'];
    $hora_entrega_cliente = $_POST['hora_entrega_cliente'];
    $metodo_pago_cliente = $_POST['metodo_pago_cliente'];
    $estado_pedido_cliente = 'Comprado';
    $precio_pedido_cliente = $_POST['precio_pedido_cliente'];
    $codigo_producto = $_POST['codigo_producto'];
    $id_usuario = $_POST['id_usuario'];
    $forma_entrega_cliente = $_POST['forma_entrega_cliente'];
    $direccion_residencia = $_POST['direccion_residencia'];

    // Verificar si algún campo está vacío
    if (empty($fecha_entrega_cliente) || empty($hora_entrega_cliente) || empty($metodo_pago_cliente) || empty($estado_pedido_cliente) || empty($precio_pedido_cliente) || empty($codigo_producto) || empty($id_usuario) || empty($forma_entrega_cliente) || empty($direccion_residencia)) {
        echo json_encode(['success' => false, 'message' => 'Error, por favor complete los campos para realizar el pedido']);
        exit; // Detener la ejecución si hay campos vacíos
    }
    
    
    $objConsultas = new Consultas();
    $result = $objConsultas->registrarVentasClientesAdmin(
        $fecha_entrega_cliente,
        $hora_entrega_cliente,
        $metodo_pago_cliente,
        $estado_pedido_cliente,
        $precio_pedido_cliente,
        $codigo_producto,
        $id_usuario,  
        $forma_entrega_cliente,
        $direccion_residencia        
    );

?>