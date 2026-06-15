<?php
/*
|--------------------------------------------------------------------------
| DATABASE CONNECTION FILE
|--------------------------------------------------------------------------
| This file connects your PHP project to MySQL database.
| Include it in any file that needs database access.
*/

$host = "localhost";      // Server name (XAMPP default)
$user = "root";           // MySQL username (default in XAMPP)
$password = "";           // MySQL password (empty in XAMPP)
$database = "hospital_db"; // Your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Optional: set character set to avoid encoding issues
$conn->set_charset("utf8mb4");
?>