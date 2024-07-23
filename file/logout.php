<?php
    // Start session
    session_start();
    // Unset all session variables
    unset($_SESSION);
    // Reset the session array
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Loop through all cookies and delete them by setting an expiration date in the past
    foreach($_COOKIE as $key => $value) {
        setcookie($key, "", time() - (86400 * 1));
    }
    // Redirect to the login page
    header('Location: /index.php');
    exit;
?>