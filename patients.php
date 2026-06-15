<?php
include("authentication.php"); // protect page
include("db.php");            // database connection

// Fetch all patients
$sql = "SELECT * FROM patients ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patients - Hospital Management System</title>

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
            margin-left: 0;
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

        .delete-btn {
            color: white;
            background: red;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .edit-btn {
            color: white;
            background: orange;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Patients Management</h2>
</div>

<div class="container">

    <a href="add_patient.php" class="btn">+ Add New Patient</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td>
                        <a class="edit-btn" href="edit_patient.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="delete-btn" href="delete_patient.php?id=<?php echo $row['id']; ?>" 
                           onclick="return confirm('Are you sure you want to delete this patient?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">No patients found</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>