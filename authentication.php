<?php
// Start session on every protected page
session_start();

/*
|--------------------------------------------------------------------------
| AUTHENTICATION CHECK
|--------------------------------------------------------------------------
| This file should be included at the TOP of any page
| that requires the user to be logged in.
*/

if (!isset($_SESSION['user_id'])) {

    // User is NOT logged in → redirect to login page
    header("Location: login.php");
    exit();
}

// Optional: store user info for easy use in pages
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? "User";
?>