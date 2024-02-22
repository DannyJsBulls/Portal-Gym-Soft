<?php
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    // Obtén todos los valores del formulario
    $fecha_inicio_actividad = $_POST['fecha_inicio_actividad'];
    $hora_inicio_actividad = $_POST['hora_inicio_actividad'];
    $estado_inscripcion_perso = $_POST['estado_inscripcion_perso'];
    $comentarios_inscripcion_perso = $_POST['comentarios_inscripcion_perso'];
    $codigo_actividad = $_POST['codigo_actividad'];
    $codigo_venta_plan = $_POST['codigo_venta_plan'];
    $id_usuario = $_POST['id_usuario'];
    $id_entrenador = $_POST['id_entrenador'];

    // Verificar si algún campo está vacío
    if (empty($fecha_inicio_actividad) || empty($hora_inicio_actividad) || empty($estado_inscripcion_perso) || empty($comentarios_inscripcion_perso) || empty($codigo_actividad) || empty($codigo_venta_plan) || empty($id_usuario) || empty($id_entrenador)) {
        echo json_encode(['success' => false, 'message' => 'Error, por favor complete todos los campos para realizar el registro']);
        exit; // Detener la ejecución si hay campos vacíos
    }

    // Si no hay campos vacíos, proceder con el registro
    $objConsultas = new Consultas();
    $result = $objConsultas->registrarInscripPersoAdmin(
        $fecha_inicio_actividad,
        $hora_inicio_actividad,
        $estado_inscripcion_perso,
        $comentarios_inscripcion_perso,
        $codigo_actividad,
        $codigo_venta_plan,
        $id_usuario,
        $id_entrenador
    );

?>