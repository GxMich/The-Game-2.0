<?php
    // Start session and regenerate session ID for security
    session_start();
    session_regenerate_id();
    // Remove any previous error messages
    unset($_SESSION['error_login']);
    unset($_SESSION['error_signUp']);
    // Delete 'username' and 'score' cookies by setting an expiration date in the past
    setcookie('username', "", time() - (86400 * 1));
    setcookie('score', "", time() - (86400 * 1));
    // Include the file for database connection
    require __DIR__ . '/connDb.php';
    // Handle login
    if(isset($_POST['name_user']) && isset($_POST['password_user'])) {
        // Assign POST values to local variables
        $username = $_POST['name_user'];
        $password = $_POST['password_user'];
        // Call login function to verify credentials
        $dati_user = login($username, $password);
        // If credentials are incorrect
        if($dati_user == false) {
            // Set error message in session and redirect to login page
            $_SESSION['error_login'] = "<strong>Login non Effetuato</strong><br>Credenziali Errate. Riprova";
            header('Location: /index.php');
            exit;
        } else {
            // Set cookies with user information
            setcookie('username', $dati_user['username'], time() + (86400 * 1));
            setcookie('score', (int)$dati_user['score'], time() + (86400 * 1));
            // Set session variables with user information
            $_SESSION['username'] = $dati_user['username'];
            $_SESSION['score'] = (int)$dati_user['score'];
            $_SESSION['matches'] = (int)$dati_user['n_partite'];
            $_SESSION['statisticsPP'] = (float)$dati_user['rapporto_PP'];
            // Redirect to homepage
            header('Location: home.php');
            exit;
        }  
    // Handle registration
    } elseif(isset($_POST['name_user_signUp']) && isset($_POST['password_user_signUp'])) {
        // Assign POST values to local variables
        $password = $_POST['password_user_signUp'];
        $username = $_POST['name_user_signUp'];
        // Check if the username is available
        if(checkUser($username)) {
            // Try to add the new user
            if(addUser($username, $password)) {
                // Set cookies with new user information
                setcookie('username', $username, time() + (86400 * 1));
                setcookie('score', 0, time() + (86400 * 1));
                // Set session variables with new user information
                $_SESSION['username'] = $username;
                $_SESSION['score'] = 0;
                $_SESSION['matches'] = 0;
                $_SESSION['statisticsPP'] = 0;
                // Redirect to homepage
                header('Location: home.php');
                exit;
            } else {
                // If there is an error during registration, set an error message in session
                $_SESSION['error_signUp'] = "<strong>Registrazione non Effetuata:</strong><br>Si è verificato un errore durante la registrazione. Riprovare";
                // End session and remove all cookies
                unset($_SESSION);
                $_SESSION = array();
                session_destroy();

                foreach($_COOKIE as $key => $value) {
                    setcookie($key, "", time() - (86400 * 1));
                }
                // Redirect to login page
                header('Location: /index.php');
                exit;
            }
        } else {
            // If the username is already in use, set an error message in session
            $_SESSION['error_signUp'] = "<strong>Registrazione non Effetuata:</strong><br>Username già in uso. Cambia username";
            // End session and remove all cookies
            unset($_SESSION);
            $_SESSION = array();
            session_destroy();
            foreach($_COOKIE as $key => $value) {
                setcookie($key, "", time() - (86400 * 1));
            }
            // Redirect to login page
            header('Location: /index.php');
            exit;
        }
    }
?>