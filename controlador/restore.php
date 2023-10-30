<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

$errors = '';
$emailOK = false;

$validEmail = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    include_once './validaciones.php';

    validarEmailRestorePassword($validEmail, $errors);

    if(empty($errors)) {
        require_once '../modelo/Conection.php';
        if (!validarEmailExistente($validEmail, $connexio)) {
            $errors .= "No estas registrado.<br>";
        } else {
            $emailOK = true;
            $token = bin2hex(openssl_random_pseudo_bytes(16));
            insertarToken($token, $connexio);
            //Load Composer's autoloader
            require '../vendor/autoload.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'informaticomondongo@gmail.com';
                $mail->Password = 'dyoz fyiu wyzz nxca';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;                                    

                //Recipients
                $mail->setFrom('informaticomondongo@gmail.com', 'Mondongo');
                $mail->addAddress($validEmail);
                $mail->isHTML(true);
                $mail->Subject = 'Restablecer contraseña';
                $mail->Body    = 'Para restablecer tu contraseña, utiliza el siguiente enlace: <a href="http://tudominio.com/restablecer.php?token=' . $token . '">Restablecer contraseña</a>';
                $mail->AltBody = 'Para restablecer tu contraseña, utiliza el siguiente enlace: http://tudominio.com/restablecer.php?token=' . $token;

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }     
    }
}


include_once '../vista/restore_view.php';
