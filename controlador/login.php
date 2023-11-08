<?php
//Created by: Alberto Morcillo
session_set_cookie_params(25 * 60); // Establecer el tiempo de la sesión en 25 minutos
session_start(); // Llama a session_start solo una vez y al principio del archivo


// Comprueba si la clave 'contadorErrorPass' existe en la matriz $_SESSION
// Si no existe, inicialízala a 0
if (!isset($_SESSION['contadorErrorPass'])) {
    $_SESSION['contadorErrorPass'] = 0;
}
$errors = '';
$emailOK = false;
$secretKey = '6LdknPUoAAAAAAJv6Mv3G0IkMIanJxe8ayV-PIfE';

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
            if (password_verify($validPassword, $hash)) {
                if ($_SESSION['contadorErrorPass'] >= 3 && !$captcha) {
                    $errors .= 'Por favor, verifica el captcha.';
                } else {
                    $_SESSION['email'] = $validEmail;
                    $_SESSION['contadorErrorPass'] = 0;
                    header("Location: ./index_usuario_logged.php");
                    exit();
                }
            } else {
                $_SESSION['contadorErrorPass']++;
                $errors .= 'Contraseña equivocada.';
                if ($_SESSION['contadorErrorPass'] >= 3) {
                    if (!$captcha) {
                        $errors .= 'Por favor, verifica el captcha.';
                    } else {
                        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha");
                        $decodedResponse = json_decode($response, TRUE);
                        if ($decodedResponse['success']) {
                            $_SESSION['contadorErrorPass'] = 0;
                            
                        } else {
                            $errors .= 'Error al comprobar Captcha.';
                        }
                    }
                }
            }
        } else {
            $errors .= "Hubo un error en el login. Por favor, inténtalo nuevamente.";
        }
    }
} elseif (isset($_POST['submit2'])) {
        // Código para manejar el inicio de sesión con Google
        require_once '../modelo/configuration.php';

        try {
            $adapter->authenticate();
            $userProfile = $adapter->getUserProfile();
            $_SESSION['email'] = $userProfile->email;
            header("Location: ./index_usuario_logged.php");
            exit();
        }
        catch( Exception $e ){
            echo $e->getMessage() ;
        }
    }

// ID Cliente: 890609144903-ki0pmnluglrfv3s1c1btsji594vr142f.apps.googleusercontent.com
// Secreto del cliente: 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

include_once '../vista/login_view.php';
?>
