<?php
include("authentication.php");
include("db.php");

// Fetch all doctors
$sql = "SELECT * FROM doctors ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctors - Hospital Management System</title>

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

        .view-btn {
            background: #17a2b8;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Doctors Management</h2>
</div>

<div class="container">

    <a href="add_doctor.php" class="btn">+ Add New Doctor</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Specialization</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['specialization']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td>
                        <a class="view-btn" href="doctor_view.php?id=<?php echo $row['id']; ?>">View</a>
                        <a class="edit-btn" href="edit_doctor.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="delete-btn" href="delete_doctor.php?id=<?php echo $row['id']; ?>" 
                           onclick="return confirm('Are you sure you want to delete this doctor?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">No doctors found</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>