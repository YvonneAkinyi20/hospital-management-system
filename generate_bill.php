
<?php
include("authentication.php");
include("db.php");

$message = "";

// Fetch patients for dropdown
$patients = $conn->query("SELECT id, name FROM patients ORDER BY name ASC");

// Handle form submission
if (isset($_POST['generate'])) {

    $patient_id = $_POST['patient_id'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];

    if (empty($patient_id) || empty($amount) || empty($status)) {
        $message = "All fields are required!";
    } else {

        $stmt = $conn->prepare("
            INSERT INTO billing (patient_id, amount, status)
            VALUES (?, ?, ?)
        ");

        $stmt->bind_param("ids", $patient_id, $amount, $status);

        if ($stmt->execute()) {
            header("Location: billing.php");
            exit();
        } else {
            $message = "Failed to generate bill!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Bill</title>

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

    <h2>Generate Bill</h2>

    <?php if (!empty($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">

        <!-- Patient Selection -->
        <select name="patient_id">
            <option value="">Select Patient</option>
            <?php while ($p = $patients->fetch_assoc()): ?>
                <option value="<?php echo $p['id']; ?>">
                    <?php echo $p['name']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- Amount -->
        <input type="number" name="amount" placeholder="Enter Amount (KES)" step="0.01">

        <!-- Status -->
        <select name="status">
            <option value="">Select Status</option>
            <option value="Pending">Pending</option>
            <option value="Paid">Paid</option>
            <option value="Unpaid">Unpaid</option>
        </select>

        <button type="submit" name="generate">Generate Bill</button>
    </form>

    <a href="billing.php">← Back to Billing</a>

</div>

</body>
</html>