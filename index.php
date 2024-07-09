<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Game 2.0 </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style/index.css">
    <style>
        input:focus, textarea:focus, select:focus {outline: none;}
        html,body{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}
        .error {
            border: 2px solid red;
        }
        .valid {
            border: 2px solid green;
        }
        .error-message {
            color: red;
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>The Game <strong id="version">2.0</strong></h1>
        <h3>Description:</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto vero maxime similique numquam eveniet, <br>voluptatibus odio cumque quis? Esse nesciunt impedit porro quaerat aliquam saepe placeat qui obcaecati exercitationem quia?<br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto vero maxime similique numquam eveniet, <br>voluptatibus odio cumque quis? Esse nesciunt impedit porro quaerat aliquam saepe placeat qui obcaecati exercitationem quia?<br></p>
    </header>
    <div class="access">
        <!-- LOGIN -->
        <div id="login" class="card">
            <h3>ACCEDI</h3>
            <form action="file/check.php" method="post">
                <input id="name_user" type="text" name="name_user" placeholder="Username" required><br>
                <input id="password_user" type="password" name="password_user" placeholder="Password" required><br>
                <input type="checkbox" class="view_password_checkbox" data-target="login_password">
                <label for="view_password_checkbox">Mostra password</label><br>
                <input class="btn" type="submit" value="ACCEDI">
            </form>
            <p>oppure</p>
            <button class="btn" id="btn_signUp">REGISTRATI</button>
            <!-- if present, it shows the error message -->
            <?php if(isset($_SESSION['error_login'])){
                echo "<p>".$_SESSION['error_login']."</p>";
            } ?>
        </div>
        <!-- SIGN UP -->
        <div class="card"  id="signUp" style="display: none;">
            <h3>REGISTRATI</h3>
            <form id="registrationForm" action="file/check.php" method="post">
                <input id="name_user_signUp" type="text" name="name_user_signUp" placeholder="Username" required><br>
                <input id="password_user_signUp" type="password" name="password_user_signUp" placeholder="Password" required><br>
                <input id="confirm_password_user_signUp" type="password" name="confirm_password_user_signUp" placeholder="Conferma password" required><br>
                <label style="font-size: 0.8em;">La password deve avere almeno 8 caratteri, <br>una lettera maiuscola e un numero</label><br>
                <input type="checkbox" class="view_password_checkbox" data-target="signup_password">
                <label for="view_password_checkbox">Mostra password</label><br>
                <input class="btn" type="submit" value="REGISTRATI">
            </form>
            <p>oppure</p>
            <button class="btn" id="btn_login">ACCEDI</button>
            <!-- if present, it shows the error message -->
            <?php if(isset($_SESSION['error_signUp'])){
                echo "<p>".$_SESSION['error_signUp']."</p>";
            } ?>
        </div>
    </div>
    <script src="/JavaScript/index.js"></script>
</body>
</html>