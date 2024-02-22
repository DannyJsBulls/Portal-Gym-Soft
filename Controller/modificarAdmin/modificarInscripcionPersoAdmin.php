<?php
    require_once("../../Model/conexion.php");
    require_once("../../Model/consultas.php");

    // Obtén todos los valores del formulario
    $codigo_inscripcion_perso = $_POST['codigo_inscripcion_perso'];
    $fecha_inicio_actividad = $_POST['fecha_inicio_actividad'];
    $hora_inicio_actividad = $_POST['hora_inicio_actividad'];
    $estado_inscripcion_perso = $_POST['estado_inscripcion_perso'];
    $comentarios_inscripcion_perso = $_POST['comentarios_inscripcion_perso'];
    $codigo_actividad = $_POST['codigo_actividad'];
    $codigo_venta_plan = $_POST['codigo_venta_plan'];
    $id_usuario = $_POST['id_usuario'];
    $id_entrenador = $_POST['id_entrenador'];

    // Si no hay campos vacíos, proceder con el registro
    $objConsultas = new Consultas();
    $result = $objConsultas->modificarInscripcionPersoAdmin(
        $codigo_inscripcion_perso,
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