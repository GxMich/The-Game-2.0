<?php
    // Configuration parameters for the database connection
    $hostname="localhost";
    $dbname="the_game2";
    $username="root";
    $password="";

    try {
        // Creating a new PDO connection to the database
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        // Handling database connection error
        echo "Database connection error: " . $e->getMessage() . "<br>";
    }

    // Function for user login
    function login(string $username, string $password) {
        global $dbh;
        try {
            // Query to select the user from the database based on the username
            $sql = "SELECT * FROM utenti WHERE username = :username";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                // Password verification
                if (password_verify($password, $result['password'])) {
                    // Return user data if the password is correct
                    return $result;
                } else {
                    // Return false if the password is incorrect
                    return false;
                }
            } else {
                // Return false if the username is not found
                return false;
            }
        } catch (PDOException $e) {
            // Log the error for debugging
            return false;
        }
    }
    
    // Function to check if the username is already in use
    function checkUser(string $username) {
        global $dbh;
        try {
            // Query to count the users with the specified username
            $sql_check_user = "SELECT COUNT(*) FROM utenti WHERE username = :username";
            $stmt = $dbh->prepare($sql_check_user);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            if ($result != 0) {
                // Return false if the username is already in use
                return false;
            } else {
                // Return true if the username is not in use
                return true;
            }
        } catch (PDOException) {
            // Handling PDO errors
            return false;
        }
    }

    // Function to add a new user to the database
    function addUser(string $username, string $password) {
        global $dbh;
        try {
            // Password hashing
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            // Query to insert a new user into the database
            $sql = "INSERT INTO utenti (username, password, score) VALUES (:username, :password, 0)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password_hash, PDO::PARAM_STR);
            $stmt->execute();
            // Return true if the user was successfully added
            return true;
        } catch (PDOException) {
            // Handling PDO errors
            return false;
        }
    }
?>