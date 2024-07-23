<?php
    // Configuration parameters for the database connection
    $hostname="";
    $dbname="";
    $username="";
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
            // Bind the parameter
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
            // Bind the parameter
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
            $sql = "INSERT INTO utenti (username, password, score, n_partite, rapporto_PP) VALUES (:username, :password, 0, 0, 0)";
            $stmt = $dbh->prepare($sql);
            // Bind the parameter
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
    function changeUsername($password, $new_username, $old_username) {
        // Use the global database connection
        global $dbh;
        try {
            // prepare the query
            $sql = "SELECT password FROM utenti WHERE username = :old_username";
            $stmt = $dbh->prepare($sql);
            // Bind the parameter
            $stmt->bindParam(':old_username', $old_username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check that the user exists and that the provided password matches the stored hash
            if ($result !== false && password_verify($password, $result['password'])) {
                // If the check is successful, prepare the query to update the username
                $sql = "UPDATE utenti SET username = :new_username WHERE username = :old_username";
                $stmt = $dbh->prepare($sql);
                // Bind the parameter
                $stmt->bindParam(':new_username', $new_username, PDO::PARAM_STR);
                $stmt->bindParam(':old_username', $old_username, PDO::PARAM_STR);
                $stmt->execute();
                return true;
            } else {
                // Return false if the password does not match or the user does not exist
                return false;
            }
        } catch (PDOException) {
            // Handle PDO errors, return false in case of an exception
            return false;
        }
    }
    function changePassword($username, $old_password, $new_password){
        // Use the global database connection
        global $dbh;
        try {
            // Prepare the query to retrieve the current password hash
            $sql = "SELECT password FROM utenti WHERE username = :username";
            $stmt = $dbh->prepare($sql);
            // Bind the parameter
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check that the user exists and that the provided old password matches the stored hash
            if ($result !== false && password_verify($old_password, $result['password'])) {
                // If the check is successful, hash the new password
                $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
                // Prepare the query to update the password
                $sql = "UPDATE utenti SET password = :new_password WHERE username = :username";
                $stmt = $dbh->prepare($sql);
                // Bind the parameters
                $stmt->bindParam(':new_password', $hash_password, PDO::PARAM_STR);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->execute();
                return true;
            } else {
                // Return false if the old password does not match or the user does not exist
                return false;
            }
        } catch (PDOException $e) {
            // Handle PDO errors, return false in case of an exception
            return false;
        }
    }
    function getQuestions() {
        // Use the global database connection
        global $dbh;
        try {
            // Prepare and execute the query to retrieve questions
            $sql = "SELECT id, domande, risposte FROM the_questions";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            // Fetch all results as an associative array
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $questions;
        } catch (PDOException $e) {
            // Log error message and return false in case of an exception
            error_log($e->getMessage());
            return false;
        }
    }
    function addScore($scoreGame, $username){
        // Use the global database connection
        global $dbh;
        try {
            // Prepare the query to update the user's score
            $sql = "UPDATE utenti SET score = :new_score WHERE username = :username";
            $stmt = $dbh->prepare($sql);
            // Bind the parameters
            $stmt->bindParam(':new_score', $scoreGame, PDO::PARAM_INT);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log error message and return false in case of an exception
            error_log($e->getMessage());
            return false;
        }
    }
    function addMatches($numMatches, $username){
        // Use the global database connection
        global $dbh;
        try {
            // Prepare the query to update the user's match count
            $sql = "UPDATE utenti SET n_partite = :new_matches WHERE username = :username";
            $stmt = $dbh->prepare($sql);
            // Bind the parameters
            $stmt->bindParam(':new_matches', $numMatches, PDO::PARAM_INT);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log error message and return false in case of an exception
            error_log($e->getMessage());
            return false;
        }
    }
    function statisticsPP($statisticsPP, $username){
        // Use the global database connection
        global $dbh;
        try {
            // Prepare the query to update the user's statistics
            $sql = "UPDATE utenti SET rapporto_PP = :statisticsPP WHERE username = :username";
            $stmt = $dbh->prepare($sql);
            // Bind the parameters
            $stmt->bindParam(':statisticsPP', $statisticsPP, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log error message and return the error message in case of an exception
            error_log($e->getMessage());
            return $e->getMessage();
        }
    }
    function classification(){
        // Use the global database connection
        global $dbh;
        try {
            // Prepare the query to retrieve the users ordered by score
            $sql = "SELECT username, score FROM `utenti` ORDER BY score DESC;";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            // Fetch all results as an associative array
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                return $result;
            } else {
                return false;
            }
        } catch (PDOException) {
            // Return false in case of an exception
            return false;
        }
    }    
?>