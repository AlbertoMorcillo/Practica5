<?php
//Created by Alberto Morcillo
require_once '../vendor/autoload.php';
require_once '../modelo/configuration_Github.php';
require_once '../modelo/Conection.php';

use League\OAuth2\Client\Provider\Github;

// Obtener la configuración
$config = include '../modelo/configuration_Github.php';

// Asegurarse de que $config sea un array
if (!is_array($config)) {
    exit('Error de configuración de GitHub');
}

$provider = new Github($config);

try {
    // Autenticar usando el proveedor de GitHub
    $authorizationUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authorizationUrl);
    exit;
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
