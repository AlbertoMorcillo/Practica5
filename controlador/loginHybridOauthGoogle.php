<?php

require_once '../modelo/configuration.php';
try {
    $adapter->authenticate();
    $userProfile = $adapter->getUserProfile();
    $email = $userProfile->email;
    header("Location: ./callback.php");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>