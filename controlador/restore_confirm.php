<?php
//Created By Alberto Morcillo
session_start();
$errors = '';
$insertadoCorrectamente = '';
require_once '../modelo/Conection.php';

$token = isset($_GET['token']) ? $_GET['token'] : null;
$validPassword = isset($_POST['password']) ? htmlspecialchars($_POST['password'])  : '';
$validPasswordRepetida = isset($_POST['passwordRepetida']) ? htmlspecialchars($_POST['passwordRepetida']) : '';

if(isset($_GET['token'])){
    $_SESSION['token'] = $_GET['token'];
    
}
$user = getUserByToken($_SESSION['token'], $connexio);



if ($user) {
    // Obtener el correo electrónico del usuario de la fila recuperada
    $email = $user;
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (isset($_POST['submit'])){
            include_once './validaciones.php';
            validarPasswordRestore($validPassword, $errors);
            validarPasswordRepetida($validPassword, $errors, $validPasswordRepetida);
            if (empty($errors)) {
                require_once '../modelo/Conection.php';
                $hashedPassword = password_hash($validPassword, PASSWORD_DEFAULT);
                $insertadoCorrectamente = updatePassword($email, $hashedPassword, $connexio);
            }

            if ($insertadoCorrectamente) {
                header('Location: ./login.php');
                // exit();
            } else {
                $errors .= "Hubo un error al actualizar la contraseña. Por favor, intenta nuevamente.";
            }
        }
    }
} else {
    header('Location: ./invalid_token.php');
}

include_once '../vista/restore_confirm_view.php';
?>