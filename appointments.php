<?php
include("authentication.php");
include("db.php");

// Fetch appointments with patient & doctor details
$sql = "
SELECT 
    a.id,
    p.name AS patient_name,
    d.name AS doctor_name,
    a.appointment_date,
    a.status
FROM appointments a
JOIN patients p ON a.patient_id = p.id
JOIN doctors d ON a.doctor_id = d.id
ORDER BY a.appointment_date DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments - Hospital Management System</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            margin: 0;
        }

        .header {
            background: #0d6efd;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            padding: 20px;
        }

        .btn {
            padding: 10px 15px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background: white;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: #0d6efd;
            color: white;
        }

        .edit-btn {
            background: orange;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .delete-btn {
            background: red;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .status {
            padding: 5px 8px;
            border-radius: 4px;
            color: white;
            font-size: 12px;
        }

        .pending { background: #ffc107; }
        .completed { background: #28a745; }
        .cancelled { background: #dc3545; }
    </style>
</head>

<body>

<div class="header">
    <h2>Appointments Management</h2>
</div>

<div class="container">

    <a href="add_appointment.php" class="btn">+ Book Appointment</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['patient_name']; ?></td>
                    <td><?php echo $row['doctor_name']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td>
                        <span class="status <?php echo strtolower($row['status']); ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </td>
                    <td>
                        <a class="edit-btn" href="edit_appointment.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="delete-btn" href="delete_appointment.php?id=<?php echo $row['id']; ?>" 
                           onclick="return confirm('Are you sure you want to delete this appointment?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">No appointments found</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>