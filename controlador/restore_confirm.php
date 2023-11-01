<?php
$errors = '';
$insertadoCorrectamente = '';
require_once '../modelo/Conection.php';

// Get the token from the URL
$token = isset($_GET['token']) ? $_GET['token'] : null;
$validPassword = isset($_POST['password']) ? htmlspecialchars($_POST['password'])  : '';
$validPasswordRepetida = isset($_POST['passwordRepetida']) ? htmlspecialchars( $_POST['passwordRepetida']) : '';

$user = getUserByToken($token, $connexio);

if ($user === false) {
    header("Location: ./invalid_token.php");
    exit();
}

// Obtener el correo electrónico del usuario de la fila recuperada
$email = $user['email'];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['submit'])){
        include_once './validaciones.php';
        validarPasswordSignin($validPassword, $errors);
        validarPasswordRepetida($validPassword, $errors, $validPasswordRepetida);
        
        if (empty($errors)) {
            require_once '../modelo/Conection.php';
            $hashedPassword = password_hash($validPassword, PASSWORD_DEFAULT);
            $insertadoCorrectamente = updatePassword($email, $hashedPassword, $connexio);
        }

        if ($insertadoCorrectamente) {
            //TODO: O hacer que se logee automaticamente o llevaré al login.php para que el mismo se loguee.

        }

    }
}



include_once '../vista/restore_confirm_view.php';
?>