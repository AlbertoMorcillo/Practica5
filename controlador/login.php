<?php
//Created by: Alberto Morcillo

session_start(); // Llama a session_start solo una vez y al principio del archivo

$errors = '';
$emailOK = false;

// Variables para almacenar valores válidos
$validEmail = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$validPassword = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';

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
        if ($emailOK) {
            $_SESSION['email'] = $validEmail;
            header("Location: ./index_usuario_logged.php");
            exit();
        } else {
            $errors .= "Hubo un error en el login. Por favor, inténtalo nuevamente.";
        }
    }
}

/**
 * entrarEnLogin - Redirige a la página de login
 *
 * @return void
 */
function entrarEnLogin() {
    if (isset($_POST['login'])) {
        header('Location: ../vista/login_view.php');
        exit();
    }
}

include_once '../vista/login_view.php';
?>
