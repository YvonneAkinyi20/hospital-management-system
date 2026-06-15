<?php
// Start session (useful for login systems)
session_start();

// Example: check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Uncomment this if you want to force login
    // header("Location: login.php");
    // exit();
}

$username = $_SESSION['username'] ?? "Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Management System - Home</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .navbar {
            background-color: #0d6efd;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 20px;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .main {
            margin-left: 220px;
            padding: 20px;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h2 {
            margin: 0;
            color: #0d6efd;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            color: gray;
        }
    </style>
</head>

<body>

<div class="navbar">
    <h1>Hospital Management System</h1>
    <div>Welcome, <?php echo $username; ?></div>
</div>

<div class="sidebar">
    <a href="homepage.php">Dashboard</a>
    <a href="patients.php">Patients</a>
    <a href="doctors.php">Doctors</a>
    <a href="appointments.php">Appointments</a>
    <a href="billing.php">Billing</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">
    <h2>Dashboard Overview</h2>

    <div class="card-container">
        <div class="card">
            <h2>120</h2>
            <p>Total Patients</p>
        </div>

        <div class="card">
            <h2>25</h2>
            <p>Doctors</p>
        </div>

        <div class="card">
            <h2>18</h2>
            <p>Appointments Today</p>
        </div>

        <div class="card">
            <h2>5</h2>
            <p>Pending Bills</p>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Hospital Management System. All Rights Reserved.
    </footer>
</div>

</body>
</html>