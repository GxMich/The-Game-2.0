<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrazione</title>
<style>
    input:focus, textarea:focus, select:focus {
    outline: none;
}

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Registrazione</h2>
<!-- test -->
<form id="registrationForm" action="login_signUp.php" method="post">
    <label for="nome_utente">Nome utente:</label>
    <input id="nome_utente" type="text" name="nome_utente" placeholder="Inserisci nome utente" required><br>
    
    <label for="password_utente">Password:</label>
    <input id="password_utente" type="password" name="password_utente" placeholder="Inserisci password" required><br>
    
    <label for="conferma_password_utente">Conferma password:</label>
    <input id="conferma_password_utente" type="password" name="conferma_password_utente" placeholder="Conferma password" required><br>
    
    <label>La password deve essere lunga almeno 8 caratteri e deve comprendere almeno una lettera maiuscola e un numero</label><br>
    <span id="passwordError" class="error-message">La password non rispetta i criteri richiesti.</span><br>
    
    <input type="checkbox" id="view_password">
    <label for="view_password">Mostra password</label><br>
    
    <input type="reset" value="CANCELLA">
    <input type="submit" value="ACCEDI">
</form>

<script>
$(document).ready(function() {
    var passwordInput = $("#password_utente");
    var confirmPasswordInput = $("#conferma_password_utente");
    var passwordError = $("#passwordError");

    // Funzione di validazione della password
    function validatePassword() {
        var password = passwordInput.val();
        var uppercaseRegex = /[A-Z]/;
        var numberRegex = /[0-9]/;

        if (password.length >= 8 && uppercaseRegex.test(password) && numberRegex.test(password)) {
            passwordInput.removeClass("error").addClass("valid");
            passwordError.hide();
            return true;
        } else {
            passwordInput.removeClass("valid").addClass("error");
            passwordError.show();
            return false;
        }
    }

    // Funzione di validazione della conferma della password
    function validateConfirmPassword() {
        if (confirmPasswordInput.val() === passwordInput.val() && confirmPasswordInput.val() !== "") {
            confirmPasswordInput.removeClass("error").addClass("valid");
            return true;
        } else {
            confirmPasswordInput.removeClass("valid").addClass("error");
            return false;
        }
    }

    // Event listener per la validazione in tempo reale della password
    passwordInput.on("input", validatePassword);
    confirmPasswordInput.on("input", validateConfirmPassword);

    // Event listener per la visualizzazione delle password
    $("#view_password").on("change", function() {
        var type = this.checked ? "text" : "password";
        passwordInput.attr("type", type);
        confirmPasswordInput.attr("type", type);
    });

    // Validazione al submit del form
    $("#registrationForm").on("submit", function(event) {
        if (!validatePassword() || !validateConfirmPassword()) {
            event.preventDefault();
        }
    });
});
</script>

</body>
</html>
