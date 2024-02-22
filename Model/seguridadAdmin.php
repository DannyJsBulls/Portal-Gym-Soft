<?php 

    session_start();

    if(!isset($_SESSION['autentificado'])) {
        echo '<script>alert("Por favor inicie sesión para acceder a este sistema.");</script>';
        echo "<script> window.location.href='../Extras/iniciarSesion.php' </script>";
        exit;
    } elseif ($_SESSION['rol_usuario'] != "Administrador" && $_SESSION['rol_usuario'] != "Entrenador" && $_SESSION['rol_usuario'] != "Cliente" && $_SESSION['rol_usuario'] != "Proveedor") {
        echo '<script>alert("Tu rol no tiene permisos para acceder a esta interfaz.");</script>';
        echo "<script> window.location.href='../Extras/iniciarSesion.php' </script>";
        exit;
    }

?>



