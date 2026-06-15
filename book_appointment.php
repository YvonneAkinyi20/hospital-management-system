<?php
include("authentication.php");
include("db.php");

$message = "";

// Fetch patients
$patients = $conn->query("SELECT id, name FROM patients ORDER BY name ASC");

// Fetch doctors
$doctors = $conn->query("SELECT id, name FROM doctors ORDER BY name ASC");

// Handle form submission
if (isset($_POST['book'])) {

    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = "Pending";

    if (empty($patient_id) || empty($doctor_id) || empty($appointment_date)) {
        $message = "All fields are required!";
    } else {

        $stmt = $conn->prepare("
            INSERT INTO appointments (patient_id, doctor_id, appointment_date, status)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param("iiss", $patient_id, $doctor_id, $appointment_date, $status);

        if ($stmt->execute()) {
            header("Location: appointments.php");
            exit();
        } else {
            $message = "Failed to book appointment!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
        }

        .container {
            width: 420px;
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

        select, input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #0d6efd;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0b5ed7;
        }

        .message {
            color: red;
            text-align: center;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Book Appointment</h2>

    <?php if (!empty($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">

        <!-- Patient Dropdown -->
        <select name="patient_id">
            <option value="">Select Patient</option>
            <?php while ($p = $patients->fetch_assoc()): ?>
                <option value="<?php echo $p['id']; ?>">
                    <?php echo $p['name']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- Doctor Dropdown -->
        <select name="doctor_id">
            <option value="">Select Doctor</option>
            <?php while ($d = $doctors->fetch_assoc()): ?>
                <option value="<?php echo $d['id']; ?>">
                    <?php echo $d['name']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- Date -->
        <input type="datetime-local" name="appointment_date">

        <button type="submit" name="book">Book Appointment</button>
    </form>

    <a href="appointments.php">← Back to Appointments</a>

</div>

</body>
</html>
