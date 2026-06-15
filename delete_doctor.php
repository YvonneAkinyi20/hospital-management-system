<?php
include("authentication.php");
include("db.php");

// Get doctor ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid request: No doctor ID provided.");
}

// Prepare delete query
$stmt = $conn->prepare("DELETE FROM doctors WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Redirect back to doctors list
    header("Location: doctors.php");
    exit();
} else {
    echo "Error deleting doctor record.";
}
?>