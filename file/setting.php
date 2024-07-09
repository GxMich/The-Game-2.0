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
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
    require 'file/navbar.php';
    ?>
    <h2>setting</h2>
    
</body>
</html>