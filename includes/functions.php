<?php
    
session_start();// start the session in each page for all session data

// Required files
require __DIR__.'/class.user.php';
require __DIR__.'/db_connection.php';

ini_set("display_errors", 0); // disable view errors in production
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE); // enable view all errors in development


// Checks connected user and create session with all user data
if (!$_SESSION['tyy_User']) {
    if (isset($_COOKIE['old_user'])) {
        $user = new UserLogin($_COOKIE['old_user']);
        $user->ProveConnectedUser();
    }
}

// Disconnect the user by calling
function User_logout()
{
    setcookie('old_user', '', time() -3600);// deletes cookie 
    unset($_SESSION['tyy_User'], $_SESSION['history']);// deletes session
    header("Location:http://$_SERVER[HTTP_HOST]");// returns to login page
}

?>