<?php
// Start session and regenerate session ID for security
session_start();
session_regenerate_id();
// Set the 'username' cookie with the value from session and a 1-day expiration
setcookie('username', $_SESSION['username'], time() + (86400 * 1));
// Redirect to login page if 'username' is not set in session or cookie
if (!isset($_SESSION['username']) || !isset($_COOKIE['username'])) {
    header('Location: /index.php');
    exit;
}
// Include the file for database connection
require('connDb.php');
// Initialize quiz data if not already set in session
if (!isset($_SESSION['questions']) || !isset($_SESSION['current_question']) || !isset($_SESSION['index']) || !isset($_SESSION['current_answer'])) { 
    // Fetch questions from the database
    $questions = getQuestions();
    if ($questions === false) {
        // Redirect to home if there is an error fetching questions
        header('Location: home.php');
        exit;
    }
    // Shuffle questions and set them in session
    shuffle($questions);
    $_SESSION['questions'] = $questions;
    $_SESSION['index'] = 0;
    $_SESSION['current_question'] = $_SESSION['questions'][$_SESSION['index']]['domande'];
    $_SESSION['current_answer'] = $_SESSION['questions'][$_SESSION['index']]['risposte'];
    $_SESSION['answers_correct'] = 0;
}
// Handle POST requests (answers submitted by the user)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['answer_user']) && strtolower(trim($_POST['answer_user'])) === strtolower(trim($_SESSION['current_answer']))) {
        // If the answer is correct, update session data
        $_SESSION['answers_correct']++;
        $_SESSION['index']++;
        $_SESSION['score'] += 10;
        addScore($_SESSION['score'], $_SESSION['username']); 
        // Check if all questions have been answered
        if ($_SESSION['index'] >= count($_SESSION['questions'])) {
            $_SESSION['score'] += 100;
            addScore($_SESSION['score'], $_SESSION['username']);
            $_SESSION['mess_endGame'] = "Complimenti hai risposto a tutte le domande in modo corretto.<br>Hai guadagnato 100 punti in più!";
            header('Location: endGame.php');
            exit();
        } else {
            // Load the next question
            $_SESSION['current_question'] = $_SESSION['questions'][$_SESSION['index']]['domande'];
            $_SESSION['current_answer'] = $_SESSION['questions'][$_SESSION['index']]['risposte'];
        }
    } else {
        // Handle incorrect answer
        $_SESSION['mess_endGame'] = "Purtroppo hai sbagliato la risposta,<br>Se vuoi puoi riprovarci. <br>Vai nella home e ricomincia a giocare";
        header('Location: endGame.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/navbar.css">
    <link rel="stylesheet" href="/style/game_the_questions.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php require 'file/navbar.php'; ?>
    <div class="questions-answers">
    <h2>Pronto? Si inizia!!</h2>
        <form method="post">
            <label for="question"><?php echo $_SESSION['current_question']; ?></label><br>
            <input id="question" type="text" name="answer_user" placeholder="Risposta.."><br>
            <input class="btn" type="submit" value="Invia risposta">
        </form>
    </div>
</body>
</html>