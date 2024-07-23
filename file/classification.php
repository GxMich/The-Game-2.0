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
    <link rel="stylesheet" href="/style/classification.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php
// Include the navbar file
require 'file/navbar.php';
// Include the file for database connection
require 'file/connDb.php';
?>
<div class="card_classification">
    <h2>CLASSIFICA</h2>
    <?php
    // Get the classification data from the database
    $classification = classification();
    $index = 1;
    // Check if classification data is available
    if($classification !== false){
        // Loop through each user in the classification and display their rank, username, and score
        foreach($classification as $user){
            echo "<p>".$index++."º ".$user['username']."  ".$user['score']."</p>";
        }
    }
    ?>
</div>
</body>
</html>