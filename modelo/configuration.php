<?php

require_once 'vendor/autoload.php';
 
$config = [
    'callback' => 'YOUR_DOMAIN_URL/index.php',
    'keys'     => [
                    'id' => 'YOUR_CLIENT_ID',
                    'secret' => 'YOUR_CLIENT_SECRET'
                ],
    'scope'    => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
            'access_type' => 'offline'
    ]
];
 
$adapter = new Hybridauth\Provider\Google($config);
?>