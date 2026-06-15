<?php
include("authentication.php");
include("db.php");

// Get appointment ID
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid appointment ID");
}

// Fetch appointment details
$stmt = $conn->prepare("SELECT * FROM appointments WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$appointment = $result->fetch_assoc();

if (!$appointment) {
    die("Appointment not found");
}

// Fetch patients & doctors for dropdowns
$patients = $conn->query("SELECT id, name FROM patients ORDER BY name ASC");
$doctors = $conn->query("SELECT id, name FROM doctors ORDER BY name ASC");

$message = "";

// Update logic
if (isset($_POST['update'])) {

    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];

    if (empty($patient_id) || empty($doctor_id) || empty($appointment_date) || empty($status)) {
        $message = "All fields are required!";
    } else {

        $update = $conn->prepare("
            UPDATE appointments 
            SET patient_id = ?, doctor_id = ?, appointment_date = ?, status = ?
            WHERE id = ?
        ");

        $update->bind_param("iissi", $patient_id, $doctor_id, $appointment_date, $status, $id);

        if ($update->execute()) {
            header("Location: appointments.php");
            exit();
        } else {
            $message = "Failed to update appointment!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointment</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
        }

        .container {
            width: 450px;
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
            background: orange;
            color: white;
            border: none;
            border-radius: 5px;
        }

        button:hover {
            background: darkorange;
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

    <h2>Edit Appointment</h2>

    <?php if (!empty($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">

        <!-- Patient -->
        <select name="patient_id">
            <?php while ($p = $patients->fetch_assoc()): ?>
                <option value="<?php echo $p['id']; ?>"
                    <?php if ($p['id'] == $appointment['patient_id']) echo "selected"; ?>>
                    <?php echo $p['name']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- Doctor -->
        <select name="doctor_id">
            <?php while ($d = $doctors->fetch_assoc()): ?>
                <option value="<?php echo $d['id']; ?>"
                    <?php if ($d['id'] == $appointment['doctor_id']) echo "selected"; ?>>
                    <?php echo $d['name']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- Date -->
        <input type="datetime-local" name="appointment_date"
               value="<?php echo date('Y-m-d\TH:i', strtotime($appointment['appointment_date'])); ?>">

        <!-- Status -->
        <select name="status">
            <option value="Pending" <?php if ($appointment['status'] == "Pending") echo "selected"; ?>>Pending</option>
            <option value="Completed" <?php if ($appointment['status'] == "Completed") echo "selected"; ?>>Completed</option>
            <option value="Cancelled" <?php if ($appointment['status'] == "Cancelled") echo "selected"; ?>>Cancelled</option>
        </select>

        <button type="submit" name="update">Update Appointment</button>
    </form>

    <a href="appointments.php">← Back to Appointments</a>

</div>

</body>
</html>