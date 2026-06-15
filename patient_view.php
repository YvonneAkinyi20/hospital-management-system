<?php
include("authentication.php");
include("db.php");

// Get patient ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid request: No patient ID provided.");
}

// Fetch patient data
$stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();

if (!$patient) {
    die("Patient not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Details</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
        }

        .container {
            width: 500px;
            margin: 80px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #0d6efd;
        }

        .info {
            margin: 15px 0;
            font-size: 16px;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background: #0b5ed7;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Patient Details</h2>

    <div class="info">
        <span class="label">ID:</span> <?php echo $patient['id']; ?>
    </div>

    <div class="info">
        <span class="label">Name:</span> <?php echo $patient['name']; ?>
    </div>

    <div class="info">
        <span class="label">Age:</span> <?php echo $patient['age']; ?>
    </div>

    <div class="info">
        <span class="label">Gender:</span> <?php echo $patient['gender']; ?>
    </div>

    <div class="info">
        <span class="label">Contact:</span> <?php echo $patient['contact']; ?>
    </div>

    <div class="info">
        <span class="label">Registered On:</span> <?php echo $patient['created_at']; ?>
    </div>

    <a href="patients.php" class="btn">← Back to Patients</a>

</div>

</body>
</html>