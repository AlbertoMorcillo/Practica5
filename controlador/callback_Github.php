<?php

require_once '../vendor/autoload.php';
require_once '../modelo/Conection.php';

use League\OAuth2\Client\Provider\Github;

// Obtener la configuración
$config = include '../modelo/configuration_Github.php';

// Asegurarse de que $config sea un array
if (!is_array($config)) {
    exit('Error de configuración de GitHub');
}

$provider = new Github($config);

// Si no se ha proporcionado el código de autorización, muestra un error
if (!isset($_GET['code'])) {
    exit('Código de autorización no proporcionado');
} else {
    // Si el estado no coincide, muestra un error
    if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
        exit('Invalid state');
    }

    // Intercambio del código de autorización por un token de acceso
    try {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code'],
        ]);

        // Accede a la información del usuario autenticado
        $user = $provider->getResourceOwner($token);

        // Muestra la información del usuario
        echo '<pre>';
        print_r($user->toArray());
        echo '</pre>';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// session_start(); // Iniciar la sesión

// require_once '../vendor/autoload.php';
// require_once '../modelo/Conection.php';

// use League\OAuth2\Client\Provider\Github;

// // Obtener la configuración
// $config = include '../modelo/configuration_Github.php';

// $provider = new Github($config['github']);

// if (!isset($_GET['code'])) {
//     // Paso 1: Redirige al usuario a GitHub para la autorización
//     $authorizationUrl = $provider->getAuthorizationUrl(['scope' => ['user', 'user:email']]);
//     $_SESSION['oauth2state'] = $provider->getState();
//     header('Location: ' . $authorizationUrl);
//     exit;
// } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
//     // Paso 2: Verifica que el estado sea el mismo
//     unset($_SESSION['oauth2state']);
//     exit('Invalid state');
// } else {
//     try {
//         // Paso 3: Obtiene el token de acceso usando el código de autorización
//         $token = $provider->getAccessToken('authorization_code', [
//             'code' => $_GET['code'],
//         ]);

//         // Paso 4: Usa el token para obtener información del usuario
//         $user = $provider->getResourceOwner($token);

//         // Aquí puedes almacenar la información del usuario en la sesión o la base de datos
//         $email = $user->getEmail();

//         // Verificar si el correo electrónico ya existe en la base de datos
//         if (!validarEmailExistente($email, $connexio)) {
//             if (insertarUsuarioHybridAuth($email, $connexio)) {
//                 // Iniciar sesión para el nuevo usuario
//                 $_SESSION['email'] = $email;
//                 $_SESSION["usuari_id"] = getUserId($email, $connexio);

//                 // Redirigir al usuario a la página de inicio del usuario logueado
//                 header("Location: ./index_usuario_logged.php");
//                 exit;
//             } else {
//                 // Manejar el error si la inserción del usuario falla
//                 echo 'Error al insertar el usuario.';
//             }
//         } else {
//             // Si el correo electrónico ya existe en la base de datos, iniciar sesión para el usuario existente
//             $_SESSION['email'] = $email;
//             $_SESSION["usuari_id"] = getUserId($email, $connexio);

//             // Redirigir al usuario a la página de inicio del usuario logueado
//             header("Location: ./index_usuario_logged.php");
//             exit;
//         }
//     } catch (\Exception $e) {
//         // Manejar errores de autenticación
//         // Redirigir al usuario a una página de error
//         header("Location: ./error_page.php?message=" . urlencode($e->getMessage()));
//         exit;
//     }
// }
?>
