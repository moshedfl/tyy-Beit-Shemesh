<?php
    
    session_start();// start the session in each page for all session data
    //ini_set("display_errors", 0); // disable view errors in production
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE); // enable view all errors in development

// Disconnect the user In every call
function User_logout()
{
    setcookie('old_user', '', time() -3600, "/tyybeitshemesh");// deletes cookie 
    unset($_SESSION['tyy_User'], $_SESSION['history']);// deletes session
    header("Location:http://$_SERVER[HTTP_HOST]/tyybeitshemesh");// returns to login page
}

?>