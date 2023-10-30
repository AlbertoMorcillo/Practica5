<?php

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
        }
        
    }
}


include_once '../vista/restore_view.php';
?>