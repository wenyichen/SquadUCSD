<?php

function logout()
{
    // destroys the session and logs the user out
    session_destroy();

    // redirects the user to the homepage
    header("Location: http://www.squaducsd.com/index.php");
}

