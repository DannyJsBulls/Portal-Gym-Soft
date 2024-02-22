<?php 
    require_once("../Model/conexion.php");
    require_once("../Model/validarSesion.php");

    // capturamos en variables los valores enviados desde el formualrio
    // atraves del method post y los name de los campos
    $email = $_POST['email'];
    $clave = $_POST['Password'];

    // Hashear la contraseña utilizando password_hash
    $clavemd = password_hash($clave, PASSWORD_DEFAULT);

    // Creamos el objeto a partir de la clase validar sesion
    $objValidar = new ValidarSesion();
    $result = $objValidar->iniciarSesion($email, $clavemd);
?>