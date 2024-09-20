<?php
    // Start session and regenerate session ID for security
    session_start();
    session_regenerate_id();
    // Set the 'username' cookie with the value from session and a 1-day expiration
    setcookie('username', $_SESSION['username'], time() + (86400 * 1), "/");
    // Redirect to login page if 'username' is not set in session or cookie
    if(!isset($_SESSION['username']) || !isset($_COOKIE['username'])) {
        header('Location: /index.php');
        exit;
    }
    // Unset specific session variables related to the game state
    unset($_SESSION['answers_correct']);
    unset($_SESSION['mess_endGame']);
    unset($_SESSION['current_answer']);
    unset($_SESSION['index']);
    unset($_SESSION['current_question']);
    unset($_SESSION['questions']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/navbar.css">
    <link rel="stylesheet" href="/style/home.css">
    <title>The Game 2.0 - Home</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    </style>
</head>
<body>
    <?php require __DIR__ . '/navbar.php';?>
    <main>
        <div class="header">
            <h2>Ciao <?php echo $_SESSION['username']; ?>!<br>Pronto a metterti alla prova?</h2>
            <p style="color:black">Scegli un gioco e inizia a guadagnare punti!</p>
        </div>
        <div class="game">
            <h2>LE DOMANDE</h2>
            <p>Il Gioco è un quiz a risposta aperta dove ti verrà presentata una domanda alla volta. Se rispondi correttamente, verrà mostrata una nuova domanda. Ogni risposta giusta ti farà guadagnare 10 punti. Il gioco termina se sbagli una risposta. Se rispondi correttamente a tutte le domande, otterrai un bonus di 100 punti in aggiunta al tuo punteggio totale.</p>
            <a href="game_the_questions.php">Gioca</a>
        </div>
    </main>
</body>
</html>