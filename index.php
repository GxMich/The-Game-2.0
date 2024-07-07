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

        <div id="login" class="card"><!-- LOGIN -->
            <h3>ACCEDI</h3>
            <form action="login_signUp.php" method="post">

                <input id="name_user" type="text" name="name_user" placeholder="Username" required><br>

                <input id="password_user" type="password" name="password_user" placeholder="Password" required><br>

                <input type="checkbox" class="view_password_checkbox" data-target="login_password">
                <label for="view_password_checkbox">Mostra password</label><br>

                <input class="btn" type="submit" value="ACCEDI">
            </form>
            <p>oppure</p>
            <button class="btn" id="btn_signUp">REGGISTRATI</button>
            <p><strong>Errore:</strong><br>errore login</p>
        </div>
        




        <div class="card"  id="signUp" style="display: none;"><!-- SIGN UP -->
            <h3>REGGISTRATI</h3>
            <form id="registrationForm" action="login_signUp.php" method="post">
                <input id="name_user_signUp" type="text" name="name_user_signUp" placeholder="Username" required><br>

                <input id="password_user_signUp" type="password" name="password_user" placeholder="Password" required><br>

                <input id="confirm_password_user_signUp" type="password" name="confirm_password_user_signUp" placeholder="Conferma password" required><br>

                <label style="font-size: 0.8em;">La password deve avere almeno 8 caratteri, <br>una lettera maiuscola e un numero</label><br>
                <input type="checkbox" class="view_password_checkbox" data-target="signup_password">
                <label for="view_password_checkbox">Mostra password</label><br>

                <input class="btn" type="submit" value="REGISTRATI">
            </form>
            <p>oppure</p>
            <button class="btn" id="btn_login">ACCEDI</button>
            <p><strong>Errore:</strong><br>errore registrazione</p>
        </div>
    </div>



    <script>
        $(document).ready(function(){
            $('#btn_signUp').click(function(){
                $('#login').hide();
                $('#signUp').show();
            });
            $('#btn_login').click(function(){
                $('#login').show();
                $('#signUp').hide();
            });
        });
        
    </script>
        
    <script>
        $(document).ready(function(){

            // Retrieve the entered password
            var passwordInput = $('#password_user_signUp');

            // Retrieve the entered password confirmation
            var confirmPassword = $('#confirm_password_user_signUp');

            // Retrieve the password error message
            var passwordError = $('#passwordError_signUp');

            /*
                This function checks whether the password entered by the user meets the mandatory criteria 
                and assigns or removes a class from the input based on its validity.
            */
            function validatePassword(){
                // Use the val() method to retrieve the value entered into the input by the user
                var password = passwordInput.val();

                // Create two regex rules to check if the chosen password contains at least one uppercase letter and a number
                var uppercaseRegex = /[A-Z]/;
                var numberRegex = /[0-9]/;

                // If the entered password meets the mandatory criteria, assign the class "valid" and remove the class "error"
                if(password.length >= 8 && uppercaseRegex.test(password) && numberRegex.test(password)){
                    // Add and remove class
                    passwordInput.removeClass("error").addClass("valid");
                    return true;
                } else {
                    // Add and remove class
                    passwordInput.removeClass("valid").addClass("error");
                    return false;
                }
            }

            /*
                This function checks whether the user has entered the same password and confirm password 
                and assigns or removes a class from the input based on their validity.
            */
            function validateConfirmPassword() {
                // Check if the password and confirm password are the same
                if (confirmPassword.val() === passwordInput.val() && confirmPassword.val() !== ""){
                    // Add and remove class
                    confirmPassword.removeClass("error").addClass("valid");
                    return true;
                } else {
                    // Add and remove class
                    confirmPassword.removeClass("valid").addClass("error");
                    return false;
                }
            }

            // Add an input event listener to passwordInput to validate the password as the user types
            passwordInput.on("input", validatePassword);

            // Add an input event listener to confirmPassword to validate the confirmation password as the user types
            confirmPassword.on("input", validateConfirmPassword);

            // Add a change event listener to the view_password checkbox to toggle the visibility of the password fields
            $(".view_password_checkbox").on("change", function() {
                // Determine the target fields based on the data attribute
                var target = $(this).data("target");
                var type = this.checked ? "text" : "password";

                // Update the type for the relevant password fields
                if (target === "login_password") {
                    $("#password_user").attr("type", type);
                } else if (target === "signup_password") {
                    $("#password_user_signUp, #confirm_password_user_signUp").attr("type", type);
                }
            });
            // Add a submit event listener to the registration form
            $("#registrationForm").on("submit", function(event) {
                // Prevent form submission if the password or confirmation password is invalid
                if (!validatePassword() || !validateConfirmPassword()) {
                    event.preventDefault();
                }
            });

        });
    </script>
</body>
</html>