<?php
//Created by Alberto Morcillo
require_once '../vendor/autoload.php';

$config = [
    'client_id' => 'dec4183aaa2ab59e10af',
    'client_secret' => '703626635336c32a91a779f01908f5979308a8dd',
    'redirect_uri' => 'http://localhost/BACKEND/PRACTICAS/UF2/Practica5/controlador/callback_Github.php',
    'scopes' => ['user:email'],
];

$provider = new \League\OAuth2\Client\Provider\Github($config);

return $config;
?>
