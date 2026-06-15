<?php
include("authentication.php");
include("db.php");

// Get patient ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid request: No patient ID provided.");
}

// Prepare delete query
$stmt = $conn->prepare("DELETE FROM patients WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Redirect back to patients list after deletion
    header("Location: patients.php");
    exit();
} else {
    echo "Error deleting patient record.";
}
?>