<?php
include("authentication.php");
include("db.php");

// Fetch billing records with patient info
$sql = "
SELECT 
    b.id,
    p.name AS patient_name,
    b.amount,
    b.status,
    b.billing_date
FROM billing b
JOIN patients p ON b.patient_id = p.id
ORDER BY b.billing_date DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Billing - Hospital Management System</title>

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

        .paid {
            color: white;
            background: #28a745;
            padding: 5px 8px;
            border-radius: 4px;
        }

        .unpaid {
            color: white;
            background: #dc3545;
            padding: 5px 8px;
            border-radius: 4px;
        }

        .pending {
            color: white;
            background: #ffc107;
            padding: 5px 8px;
            border-radius: 4px;
        }

        .action-btn {
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
        }

        .edit {
            background: orange;
        }

        .delete {
            background: red;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Billing Management</h2>
</div>

<div class="container">

    <a href="add_bill.php" class="btn">+ Create Bill</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['patient_name']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td>
                        <span class="<?php echo strtolower($row['status']); ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </td>
                    <td><?php echo $row['billing_date']; ?></td>
                    <td>
                        <a class="action-btn edit" href="edit_bill.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="action-btn delete" href="delete_bill.php?id=<?php echo $row['id']; ?>"
                           onclick="return confirm('Delete this bill?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">No billing records found</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>