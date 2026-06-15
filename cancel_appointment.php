<?php
include("authentication.php");
include("db.php");

// Get appointment ID
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid request: No appointment ID provided.");
}

// Update status to Cancelled
$stmt = $conn->prepare("UPDATE appointments SET status = 'Cancelled' WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: appointments.php");
    exit();
} else {
    echo "Failed to cancel appointment.";
}
?>