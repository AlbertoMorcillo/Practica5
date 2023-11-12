<?php
//Created by Alberto Morcillo
require_once '../modelo/configuration.php';
require_once '../modelo/Conection.php';


$adapter->authenticate();
$userProfile = $adapter->getUserProfile();
$email = $userProfile->email; // Obtener el correo electrónico del usuario
try {
// Verificar si el correo electrónico ya existe en la base de datos
if (!validarEmailExistente($email, $connexio)) {
    if (insertarUsuarioHybridAuth($email, $connexio)) {
        // Iniciar sesión para el nuevo usuario
        $_SESSION['email'] = $email;
        $_SESSION["usuari_id"] = getUserId($email, $connexio);

        // Redirigir al usuario a la página de inicio del usuario logueado
        header("Location: ./index_usuario_logged.php");
        exit();
    } else {
        // Manejar el error si la inserción del usuario falla
        $errors .= "Error al insertar el usuario.";
    }
} else {
    // Si el correo electrónico ya existe en la base de datos, iniciar sesión para el usuario existente
    $_SESSION['email'] = $email;
    $_SESSION["usuari_id"] = getUserId($email, $connexio);

    // Redirigir al usuario a la página de inicio del usuario logueado
    header("Location: ./index_usuario_logged.php");
    exit();
}
} catch (Exception $e) {
echo $e->getMessage();
}

?>