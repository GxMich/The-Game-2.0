<?php
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION['username'])||!isset($_COOKIE['username'])){
        header('Location: /index.php');
        exit;
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
    <?php
    require 'file/navbar.php';
    ?>
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

                    <input class="input" type="text" name="username" placeholder="Nuovo username" required><br>

                    <input id="password_change_username" class="input" type="password" name="password" placeholder="Password" required><br>

                    <input type="checkbox" class="view_password_checkbox" data-target="change_username">
                    <label for="view_password_checkbox">Mostra password</label><br>
                    <input class="btn" type="submit" name="change-username" value="SALVA">
                </form>
            </div>


            <div class="card-setting"  id="form-change-password" style="display: none;">
                <h3>Cambio Password</h3>
                <form id="form_change_password" method="post">

                    <input id="old_password" class="input" type="password" name="password" placeholder="Vecchia Password" required><br>

                    <input id="new_password" class="input" type="password" name="password" placeholder="Nuova Password" required><br>

                    <input id="confirm_new_password" class="input" type="password" name="password" placeholder="Conferma Nuova Password" required><br>

                    <input type="checkbox" class="view_password_checkbox" data-target="change_password">
                    <label for="view_password_checkbox">Mostra password</label><br>
                    <input class="btn" type="submit" name="change-username" value="SALVA">
                </form>
            </div>
        </div>
        
</main>
    <script src="/JavaScript/setting.js"></script>
    
</body>
</html>