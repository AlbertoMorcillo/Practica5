<?php

require_once '../modelo/configuration.php';
 
try {
    $adapter->authenticate();
    $userProfile = $adapter->getUserProfile();
    print_r($userProfile);
    echo '<a href="index.php">Logout</a>';
}
catch( Exception $e ){
    echo $e->getMessage() ;
}
?>