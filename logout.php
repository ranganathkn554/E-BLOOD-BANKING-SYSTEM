<?php
session_start();

// Check if session exists
if (session_status() === PHP_SESSION_ACTIVE) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Regenerate session ID to invalidate old session
    session_regenerate_id(true);
}

// Redirect to the sign-in page with a logout message
header("Location: signin.html?message=logged_out");
exit;
?>
