$(document).ready(function(){


    // When the button with ID "btn_signUp" is clicked
    $('#change-username').click(function(){
        $(this).addClass('change-setting-select');
        $('#change-password').removeClass('change-setting-select');
        // Hide the div with ID "login"
        $('#form-change-password').hide();
        // Show the div with ID "signUp"
        $('#form-change-username').show();
    });

    // When the button with ID "btn_login" is clicked
    $('#change-password').click(function(){
        $(this).addClass('change-setting-select');
        $('#change-username').removeClass('change-setting-select');
        // Show the div with ID "login"
        $('#form-change-password').show();
        // Hide the div with ID "signUp"
        $('#form-change-username').hide();
    });

















    
    // Retrieve the entered password
    var passwordInput = $('#new_password');

    // Retrieve the entered password confirmation
    var confirmPassword = $('#confirm_new_password');

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
        if (target === "change_username") {
            $("#password_change_username").attr("type", type);
        } else if (target === "change_password") {
            $("#old_password, #new_password, #confirm_new_password").attr("type", type);
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