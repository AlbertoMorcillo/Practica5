<?php

require_once '../vendor/autoload.php';
 
$config = [
    'callback' => 'http://localhost/BACKEND/PRACTICAS/UF2/Practica5/controlador/index_usuario_logged.php',
    'keys'     => [
                    'id' => '890609144903-ki0pmnluglrfv3s1c1btsji594vr142f.apps.googleusercontent.com',
                    'secret' => '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'
                ],
    'scope'    => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
            'access_type' => 'offline'
    ]
];
 
$adapter = new Hybridauth\Provider\Google($config);
?>