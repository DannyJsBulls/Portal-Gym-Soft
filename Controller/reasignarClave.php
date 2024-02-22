<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once("../PHPMailer/Exception.php");
    require_once("../PHPMailer/Sesion.php");
    require_once("../PHPMailer/PHPMailer.php");
    require_once("../Model/conexion.php");

    class ReasignarClave {
        public function resetearClave ($id_usuario, $email_usuario){
            $objConexion = new Conexion;
            $conexion = $objConexion->get_conexion();
            
            $consultar ="SELECT * FROM usuarios WHERE id_usuario=:id_usuario AND email_usuario =:email_usuario";
            $result = $conexion->prepare ($consultar);
            
            $result->bindParam (":id_usuario", $id_usuario);
            $result->bindParam (":email_usuario", $email_usuario);

            $result->execute();
            $f=$result->fetch();

            if ($f){
                // Generamos la nueva clave a partir de un código aleatorio(8)
                $caracteres = "0123456789abcdefghijklmnopqrstuvwyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $longitud = 8;
                $newClave = substr(str_shuffle($caracteres),0,$longitud);
                // Encriptamos la nueva clave
                $clavemd = password_hash($newClave, PASSWORD_DEFAULT);
                
                $actualizarC = "UPDATE usuarios SET clavemd=:clavemd WHERE id_usuario=:id_usuario";
                $result = $conexion->prepare($actualizarC);

                $result->bindParam(":id_usuario", $id_usuario);
                $result->bindParam(":clavemd", $clavemd);

                $result->execute();

                // Lógica de reasignación y actualización
                $emailFor = $f['email_usuario'];

                // Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    // Configuración de acceso al servidor de Gmail para enviar los correos
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                        // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
                    $mail->Username   = 'ddmasolutions@gmail.com';               // SMTP username
                    $mail->Password   = 'waqiqwjhuvpmbiaq';                      // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             // Enable implicit TLS encryption
                    $mail->Port       = 465;                                    // TCP port to connect to

                    // Configuración del correo
                    $mail->setFrom('ddmasolutions@gmail.com', 'Soporte D.M.A Solutions');
                    $mail->addAddress($emailFor);                               // Add a recipient
                    $mail->isHTML(true);                                        // Set email format to HTML
                    $mail->CharSet = "UTF-8";                                   // Set character encoding

                    // Asunto y cuerpo del mensaje
                    $mail->Subject = 'GYM DDMAA SOLUTIONS - Reestablecimiento de contraseña';
                    $mail->Body = '
                        <!DOCTYPE html
                        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                <title>NOTIFICACION LIVING SAFE</title>
                                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                            </head>
                            <body style="margin: 0; padding: 0;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="padding: 10px 0 30px 0;">
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                                                <tr>
                                                    <td align="center" bgcolor="#212121" style="padding: 20px 0 20px 0; color: #ffffff; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                                        <img src="https://dannyjsbulls.github.io/Logo-Proyecto/" alt="Logo" width="120" height="120" style="display: block;" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#212121" style="padding: 40px 30px 40px 30px;">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td align="center" style="color:#FFFFFF; font-family: Arial, sans-serif; font-size: 24px;">
                                                                    <b>RECUPERACIÓN DE CONTRASEÑA</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tr>
                                                                            <td style="font-size: 0; line-height: 0;" width="100">
                                                                                &nbsp;
                                                                            </td>
                                                                            <td width="400" valign="top">
                                                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                    <tr>
                                                                                        <td align="center">
                                                                                            <p style="color:#fff; font-size:22px; padding-top: 30px">Hola apreciado usuario, tu nueva clave de acceso para nuestro sistema es:</p>
                                                                                            <p style="color:#fff; font-size:25px; padding-top: 30px">'.$newClave.' </p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td style="font-size: 0; line-height: 0;" width="100">
                                                                                &nbsp;
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#14ffec" style="padding: 30px 30px 30px 30px;">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td align="center" style="color: #010A43; font-family: Arial, sans-serif; font-size: 14px;" width="75%; text-aling:center">
                                                                    &reg; DDMA-Gym-soft-solutions.com - 2023<br />
                                                                    <a href="https://www.youtube.com/@codingnow6059" target="_blank" style="color: #010A43;">
                                                                        <font color="#010A43">www.DDMA-Gym-soft-solutions.com.co/</font>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </body>
                        </html>
                    ';

                    $mail->send();
                    return true; // Indica que se envió el correo exitosamente
                } 
                catch (Exception $e) {
                    return false; // Indica que hubo un error al enviar el correo
                }

            } else {
                return false; // Indica que los datos ingresados no coinciden con la base de datos
            }
        }
    }

    // Manejo del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificar si los campos requeridos están completos y si el correo electrónico tiene un formato válido
        if (empty($_POST['id_usuario']) || empty($_POST['email_usuario']) || !filter_var($_POST['email_usuario'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Por favor complete todos los campos requeridos con datos válidos.']);
            return;
        }

        $id_usuario = $_POST['id_usuario'];
        $email_usuario = $_POST['email_usuario'];
        $objRclave = new ReasignarClave();
        $result = $objRclave->resetearClave($id_usuario, $email_usuario);

        // Devolver la respuesta como JSON
        header('Content-Type: application/json');

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Se ha enviado una nueva contraseña a tu correo electrónico.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ocurrió un error en el servidor.']);
        }
    }
?>





