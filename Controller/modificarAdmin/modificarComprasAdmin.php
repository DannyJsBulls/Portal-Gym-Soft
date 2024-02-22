<?php 
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    $codigo_compra_proveedor = $_POST['codigo_compra_proveedor'];
    $fecha_entrega_proveedor = $_POST['fecha_entrega_proveedor'];
    $hora_entrega_proveedor = $_POST['hora_entrega_proveedor'];
    $metodo_pago_proveedor = $_POST['metodo_pago_proveedor'];
    $estado_pedido_proveedor = $_POST['estado_pedido_proveedor'];
    $precio_pedido_proveedor = $_POST['precio_pedido_proveedor'];
    $codigo_producto = $_POST['codigo_producto'];
    $id_usuario = $_POST['id_usuario'];
    $forma_entrega_proveedor = $_POST['forma_entrega_proveedor'];
    $direccion_gimnasio = $_POST['direccion_gimnasio'];
    $cantidad_pedido_proveedor = $_POST['cantidad_pedido_proveedor'];
    
    $objConsultas = new Consultas();
    $result = $objConsultas->modificarComprasAdmin(
        $codigo_compra_proveedor,
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