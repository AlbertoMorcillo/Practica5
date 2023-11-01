<?php
$errors = '';
require_once '../modelo/Conection.php';

// Get the token from the URL
$token = isset($_GET['token']) ? $_GET['token'] : null;

$user = getUserByToken($token, $connexio);

if ($user === false) {
    header("Location: ./invalid_token.php");
    exit();
}

include_once '../vista/restore_confirm_view.php';
?>