<?php
//Created by: Alberto Morcillo

$errors = '';
$insertadoCorrectamente = false;

$validEmail = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$validPassword = isset($_POST['password']) ? $_POST['password'] : '';
$validPasswordRepetida = isset($_POST['passwordRepetida']) ? $_POST['passwordRepetida'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        include_once './validaciones.php';

        validarEmailSignin($validEmail, $errors);
        validarPasswordSignin($validPassword, $errors);
        validarPasswordRepetida($validPassword, $errors, $validPasswordRepetida);

        if (empty($errors)) {
            require_once '../modelo/Conection.php';
            if (validarEmailExistente($validEmail, $connexio)) {
                $errors .= "Ya estás registrado. Por favor, inicia sesión.";
            } else {
                // Hash de la contraseña antes de guardarla en la base de datos
                $hashedPassword = password_hash($validPassword, PASSWORD_DEFAULT);
                $insertadoCorrectamente = insertarUsuario($validEmail, $hashedPassword, $connexio);
            }

            if ($insertadoCorrectamente) {
                // Iniciar sesión
                session_start();

                // Guardar el email del usuario en la sesión
                $_SESSION['email'] = $validEmail;

                // Redirigir al usuario a la página de inicio después de iniciar sesión
                header("Location: ./index_usuario_logged.php");
                exit();
            } else {
                $errors .= "Hubo un error al registrar el usuario. Por favor, intenta nuevamente.";
            }
        }
    }
}

include_once '../vista/signin_view.php';
?>
