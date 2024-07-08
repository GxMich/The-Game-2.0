<?php
    session_start();
    session_regenerate_id();

    unset($_SESSION['error_login']);
    unset($_SESSION['error_signUp']);
    setcookie( 'username' , "" , time() - (86400 * 1) );
    setcookie( 'score' , "" , time() - (86400 * 1) );

    require 'file/connDb.php';

    if(isset($_POST['name_user']) && isset($_POST['password_user'])){

        $username=$_POST['name_user'];
        $password=$_POST['password_user'];

        $dati_user=login($username,$password);

        if($dati_user==false){
            $_SESSION['error_login']="<strong>Login non Effetuato</strong><br>Credenziali Errate. Riprova";
            header('Location: /index.php');
            exit;
        }else{
            setcookie( 'username' , $dati_user['username'] , time() + (86400 * 1) );
            setcookie( 'score' , (int)$dati_user['score'] , time() + (86400 * 1) );

            $_SESSION['username']=$dati_user['username'];
            $_SESSION['score']=(int)$dati_user['score'];

            header('Location: home.php');
            exit;
        }  

    }elseif(isset($_POST['name_user_signUp']) && isset($_POST['password_user_signUp'])){
                
        $password=$_POST['password_user_signUp'];
        $username=$_POST['name_user_signUp'];

        if(checkUser($username)){
            if(addUser($username,$password)){
                setcookie( 'username' , $username , time() + (86400 * 1) );
                setcookie( 'score' , 0 , time() + (86400 * 1) );

                $_SESSION['username']=$username;
                $_SESSION['score']=0;

                header('Location: home.php');
                exit;
            }else{
                $_SESSION['error_signUp']="<strong>Reggistrazione non Effetuata:</strong><br>Si è verificato un errore durante la reggistrazione. Riprovare";
                header('Location:: /index.php');
                exit;
            }
        }else{
            $_SESSION['error_signUp']="<strong>Reggistrazione non Effetuata:</strong><br>Username già in uso. Cambia username";
            header('Location: /index.php');
            exit;
        }
    }
?>