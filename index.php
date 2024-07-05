<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Game 2.0 </title>
</head>
<body>
    <header><!-- nome, descrizione sito -->
        <h1>The Game 2.0</h1>
        <h3>Descrizione:</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto vero maxime similique numquam eveniet, <br>voluptatibus odio cumque quis? Esse nesciunt impedit porro quaerat aliquam saepe placeat qui obcaecati exercitationem quia?<br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto vero maxime similique numquam eveniet, <br>voluptatibus odio cumque quis? Esse nesciunt impedit porro quaerat aliquam saepe placeat qui obcaecati exercitationem quia?<br></p>
    </header>
    <div id="swich"><!-- swich per scegliere se accedere o registrarsi -->
        <div><p>Accedi</p></div>
        <div><p>Reggistrati</p></div>
    </div>
    <div id="login"><!-- LOGIN -->
        <form action="login_signUp.php" method="post">
            <label for="nome_utente">Nome utente:</label>
            <input id="nome_utente" type="text" name="nome_utente" placeholder="Inserisci nome utente" required><br>
            <label for="password_utente">Password:</label>
            <input id="password_utente" type="password" name="password_utente" placeholder="Inserisci password" required><br>
            <input type="checkbox" id="view_password" >
            <label for="view_password">Mostra password</label><br>
            <input type="reset" value="CANCELLA" >
            <input type="submit" value="ACCEDI">
        </form>
        <p><strong>Errore:</strong><br>Errore login</p>
    </div>
    <br><br>
    <div id="signUp"><!-- SIGN UP -->
        <form action="login_signUp.php" method="post">
            <label for="nome_utente">Nome utente:</label>
            <input id="nome_utente" type="text" name="nome_utente" placeholder="Inserisci nome utente" required><br>
            <label for="password_utente">Password:</label>
            <input id="password_utente" type="password" name="password_utente" placeholder="Inserisci password" required><br>
            <label for="conferma_password_utente">Conferma password:</label>
            <input id="conferma_password_utente" type="password" name="conferma_password_utente" placeholder="Inserisci password" required><br>
            <label>La password deve essere lunga almeno 8 caratteri e deve comprendere almeno una lettera maiuscola e un numero</label><br>
            <input type="checkbox" id="view_password" >
            <label for="view_password">Mostra password</label><br>
            <input type="reset" value="CANCELLA" >
            <input type="submit" value="ACCEDI">
        </form>
        <p><strong>Errore:</strong><br>Errore sign up</p>
    </div>
</body>
</html>