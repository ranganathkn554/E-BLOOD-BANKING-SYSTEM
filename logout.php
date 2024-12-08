<?php
session_start();


if (session_status() === PHP_SESSION_ACTIVE) {
   
    session_unset();

    
    session_destroy();

   
    session_regenerate_id(true);
}


header("Location: index.html");
exit;
?>
