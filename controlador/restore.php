<?php

$errors = '';

$validEmail = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    include_once './validaciones.php';
    validarEmailRestorePassword($validEmail, $errors);
}


include_once '../vista/restore_view.php';
?>
