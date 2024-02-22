<?php 
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    $codigo_venta_producto = $_POST['codigo_venta_producto'];
    $fecha_entrega_cliente = $_POST['fecha_entrega_cliente'];
    $hora_entrega_cliente = $_POST['hora_entrega_cliente'];
    $metodo_pago_cliente = $_POST['metodo_pago_cliente'];
    $estado_pedido_cliente = $_POST['estado_pedido_cliente'];
    $precio_pedido_cliente = $_POST['precio_pedido_cliente'];
    $codigo_producto = $_POST['codigo_producto'];
    $id_usuario = $_POST['id_usuario'];
    $forma_entrega_cliente = $_POST['forma_entrega_cliente'];
    $direccion_residencia = $_POST['direccion_residencia'];
    
    $objConsultas = new Consultas();
    $result = $objConsultas->modificarVentasClientesAdmin(
        $codigo_venta_producto,
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