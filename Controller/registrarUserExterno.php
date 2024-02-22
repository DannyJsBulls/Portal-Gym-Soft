<?php 

    require_once("../Model/conexion.php");
    require_once("../Model/consultas.php");

    $id_usuario = $_POST['id_usuario'];
    $tipo_documento_usuario = $_POST['tipo_documento_usuario'];
    $nombres_usuario = $_POST['nombres_usuario'];
    $apellidos_usuario = $_POST['apellidos_usuario'];
    $fecha_nacimiento_usuario = $_POST['fecha_nacimiento_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $telefono_usuario = $_POST['telefono_usuario'];
    
    $clave = $_POST['clave'];
    
    // Valores por defecto 
    $rol_usuario = 'Cliente';
    $estado_usuario = 'Activo';
    // Encriptamos la clave
    $clavemd = password_hash($clave, PASSWORD_DEFAULT);

    $objConsultas = new Consultas();
    $result = $objConsultas->registrarUserExterno($id_usuario, $tipo_documento_usuario, $nombres_usuario, $apellidos_usuario, $fecha_nacimiento_usuario, $email_usuario, $telefono_usuario, $clavemd, $rol_usuario, $estado_usuario);
    
?>