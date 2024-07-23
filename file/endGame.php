<?php 
// Start session
session_start();
session_regenerate_id();
// Include the file for database connection
require('connDb.php');
// Increment the matches count in session
$_SESSION['matches']++;
// Update the matches count in the database
addMatches($_SESSION['matches'], $_SESSION['username']);
// Calculate the new statisticsPP value
$_SESSION['statisticsPP'] = (float)$_SESSION['score'] / $_SESSION['matches'];
// Save the new statisticsPP value in the database
$salva = statisticsPP($_SESSION['statisticsPP'], $_SESSION['username']);
// Check if the save was successful
if($salva === true) {
    echo "saved";
} else {
    // Output the error message if save was unsuccessful
    echo $salva;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/navbar.css">
    <link rel="stylesheet" href="/style/end_game.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    </style>
</head>
<body>
    <?php require 'file/navbar.php';?>
    <main>
        <div class="card_end_game">
            <h2><?php echo $_SESSION['mess_endGame'] ?></h2>
            <h4>Ecco i dati della partita:</h4>
            <p><?php echo "Domande risposte correttamente: ".$_SESSION['answers_correct'];?></p>
            <p><?php echo "Punti guadagnati: ".($_SESSION['answers_correct']*10); ?></p>
            <p><?php echo "Hai giocato ".$_SESSION['matches']." partite"; ?></p>
            <p><?php echo "Il tuo punteggio totale è: ".$_SESSION['score']; ?></p>
            <p><?php echo "Il tuo rapporto partite/punti attuale e di: ".number_format($_SESSION['statisticsPP'], 2); ?></p>
        </div>
    </main>
</body>