<?php
// Start session and regenerate session ID for security
session_start();
session_regenerate_id();
// Unset any previous messages related to username or password changes
unset($_SESSION['mess_change_username']);
unset($_SESSION['mess_change_password']);
// Redirect to login page if 'username' is not set in session or cookie
if(!isset($_SESSION['username']) || !isset($_COOKIE['username'])){
    header('Location: /index.php');
    exit;
}
// Include the file for database connection
require __DIR__ . '/connDb.php';
// Handle username change request
if(isset($_POST['change-username'])){
    // Check if the new username is available
    if(checkUser($_POST['new_username'])){
        $new_username = $_POST['new_username'];
        $password = $_POST['password'];
        $old_username = $_SESSION['username'];
        // Try to change the username
        if(changeUsername($password, $new_username, $old_username)){  
            $_SESSION['mess_change_username'] = "<p style='color:green;'>Username change successful</p>";
            // Update the username in session and cookie
            setcookie('username', $_SESSION['username'], time() + (86400 * 1));
            $_SESSION['username'] = $new_username;
        } else {
            $_SESSION['mess_change_username'] = "<p style='color:red;'>Username change failed.</p>";
        }
    } else {
        $_SESSION['mess_change_username'] = "<p style='color:red;'>Username change failed: Username already in use</p>";
    }
    // Handle password change request
} else if(isset($_POST['change-password'])){
    $username = $_SESSION['username'];
    $new_password = $_POST['new_password'];
    $old_password = $_POST['old_password'];
    // Try to change the password
    if(changePassword($username, $old_password, $new_password)){  
        $_SESSION['mess_change_password'] = "<p style='color:green;'>Password change successful</p>";
    } else {
        $_SESSION['mess_change_password'] = "<p style='color:red;'>Password change failed.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/navbar.css">
    <link rel="stylesheet" href="/style/setting.css">
    <title>The Game 2.0 - Setting</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php require __DIR__ . '/navbar.php';?>
    <main>
        <h3>Modifica dati Utente</h3>
        <div id="data-change">
            <div id="choice-setting">    
                <div id="swich-choice-setting">
                    <div class="choice-change-data-user change-setting-select" id="change-username" >
                        <h4>USERNAME</h4>
                    </div>
                    <div class="choice-change-data-user" id="change-password">
                        <h4>PASSWORD</h4>
                    </div>
                </div>
            </div>
            <div class="card-setting" id="form-change-username">
                <h3>Cambio Username</h3>
                <form method="post">
                    <input class="input" type="text" name="new_username" placeholder="Nuovo username" required><br>
                    <input id="password_change_username" class="input" type="password" name="password" placeholder="Password" required><br>
                    <input type="checkbox" class="view_password_checkbox" data-target="change_username">
                    <label for="view_password_checkbox">Mostra password</label><br>
                    <input class="btn" type="submit" name="change-username" value="SALVA">
                </form>
                <?php if(isset($_SESSION['mess_change_username'])){echo $_SESSION['mess_change_username'];} ?>
            </div>
            <div class="card-setting"  id="form-change-password" style="display: none;">
                <h3>Cambio Password</h3>
                <form id="form_change_password" method="post">
                    <input id="old_password" class="input" type="password" name="old_password" placeholder="Vecchia Password" required><br>
                    <input id="new_password" class="input" type="password" name="new_password" placeholder="Nuova Password" required><br>
                    <input id="confirm_new_password" class="input" type="password" name="password" placeholder="Conferma Nuova Password" required><br>
                    <input type="checkbox" class="view_password_checkbox" data-target="change_password">
                    <label for="view_password_checkbox">Mostra password</label><br>
                    <input class="btn" type="submit" name="change-password" value="SALVA">
                </form>
                <?php if(isset($_SESSION['mess_change_password'])){echo $_SESSION['mess_change_password'];} ?>
            </div>
        </div>
    </main>
    <script src="/JavaScript/setting.js"></script>
</body>
</html>