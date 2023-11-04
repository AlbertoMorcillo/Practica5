<?php
//Created by: Alberto Morcillo
session_set_cookie_params(25 * 60); // Establecer el tiempo de la sesión en 25 minutos
session_start(); // Llama a session_start solo una vez y al principio del archivo




$errors = '';
$emailOK = false;
$contadorErrorPass = 0;
$secretkey = '6LdknPUoAAAAAAJv6Mv3G0IkMIanJxe8ayV-PIfE';

// Variables para almacenar valores válidos
$validEmail = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$validPassword = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    include_once './validaciones.php';

    validarEmailLogin($validEmail, $errors);
    validarPasswordLogin($validPassword, $errors);

    if (empty($errors)) {
        require_once '../modelo/Conection.php';
        if (!validarEmailExistente($validEmail, $connexio)) {
            $errors .= "No estás registrado.<br>";
        } else {
            $emailOK = true;
        }
        $hash = obtenerHashContraseña($validEmail, $connexio);
        if ($emailOK) {
            if(password_verify($validPassword, $hash)){
                $_SESSION['email'] = $validEmail;
                header("Location: ./index_usuario_logged.php");
                exit();
            }
            if(!password_verify($validPassword, $hash)){
                $_SESSION['contadorErrorPass']++;
                $errors .= 'Contraseña equivocada.';
                if($_SESSION['contadorErrorPass'] === 3){
                    if(!$captcha){
                        echo 'Por favor, verifica el captcha';
                    } else {
                        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha");
                        $decodedResponse = json_decode($response, TRUE);
                        if($decodedResponse['success'])
                        {
                            echo '<h2>Thanks</h2>';
                        } else {
                            echo '<h3>Error al comprobar Captcha </h3>';
                        }
                    }
                }
            }     
        } else {
            $errors .= "Hubo un error en el login. Por favor, inténtalo nuevamente.";
        }
    }
}

include_once '../vista/login_view.php';
?>