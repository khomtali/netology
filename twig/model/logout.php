<?php
    require_once 'authFunctions.php';
    if(isAuthorized())
        logOut();
    header('Location: ./authorization.php');
?>
