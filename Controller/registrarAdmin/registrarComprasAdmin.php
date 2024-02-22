<?php 
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    $fecha_entrega_proveedor = $_POST['fecha_entrega_proveedor'];
    $hora_entrega_proveedor = $_POST['hora_entrega_proveedor'];
    $metodo_pago_proveedor = $_POST['metodo_pago_proveedor'];
    $estado_pedido_proveedor = 'Comprado';
    $precio_pedido_proveedor = $_POST['precio_pedido_proveedor'];
    $codigo_producto = $_POST['codigo_producto'];
    $id_usuario = $_POST['id_usuario'];
    $forma_entrega_proveedor = $_POST['forma_entrega_proveedor'];
    $direccion_gimnasio = $_POST['direccion_gimnasio'];
    $cantidad_pedido_proveedor = $_POST['cantidad_pedido_proveedor'];

    // Verificar si algún campo está vacío
    if (empty($fecha_entrega_proveedor) || empty($hora_entrega_proveedor) || empty($metodo_pago_proveedor) || empty($estado_pedido_proveedor) || empty($precio_pedido_proveedor) || empty($codigo_producto) || empty($id_usuario) || empty($forma_entrega_proveedor) || empty($direccion_gimnasio) || empty($cantidad_pedido_proveedor)) {
        echo json_encode(['success' => false, 'message' => 'Error, por favor complete los campos para realizar el pedido']);
        exit; // Detener la ejecución si hay campos vacíos
    }
    
    
    $objConsultas = new Consultas();
    $result = $objConsultas->registrarComprasAdmin(
        $fecha_entrega_proveedor,
        $hora_entrega_proveedor,
        $metodo_pago_proveedor,
        $estado_pedido_proveedor,
        $precio_pedido_proveedor,
        $codigo_producto,
        $id_usuario,  
        $forma_entrega_proveedor,
        $direccion_gimnasio,
        $cantidad_pedido_proveedor      
    );

?>