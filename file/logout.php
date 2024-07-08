<?php
    session_start();
    unset($_SESSION);
    $_SESSION=array();
    session_destroy();
    
    foreach($_COOKIE as $key=>$value){
        setcookie( $key , "" , time() - (86400 * 1) );
    }
    header('Location: /index.php');
    exit;
?>