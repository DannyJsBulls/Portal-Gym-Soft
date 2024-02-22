<?php 
    require_once("../Model/conexion.php");
    require_once("../Model/validarSesion.php");

    $objCerrar = new validarSesion();
    $result = $objCerrar->cerrarSesion();
?>