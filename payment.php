<?php
include("authentication.php");
include("db.php");

// Get bill ID
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid request: No bill ID provided.");
}

// Fetch bill details with patient name
$stmt = $conn->prepare("
    SELECT b.*, p.name AS patient_name
    FROM billing b
    JOIN patients p ON b.patient_id = p.id
    WHERE b.id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$bill = $result->fetch_assoc();

if (!$bill) {
    die("Bill not found.");
}

// Handle payment update
$message = "";

if (isset($_POST['pay'])) {

    $status = "Paid";

    $update = $conn->prepare("UPDATE billing SET status = ? WHERE id = ?");
    $update->bind_param("si", $status, $id);

    if ($update->execute()) {
        header("Location: billing.php");
        exit();
    } else {
        $message = "Payment update failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment - Hospital Management System</title>

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

        .info {
            margin: 10px 0;
            font-size: 16px;
        }

        .label {
            font-weight: bold;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            background: #218838;
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

        .paid {
            color: green;
            font-weight: bold;
        }

        .pending {
            color: orange;
            font-weight: bold;
        }

        .unpaid {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Process Payment</h2>

    <?php if (!empty($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <div class="info">
        <span class="label">Patient:</span> <?php echo $bill['patient_name']; ?>
    </div>

    <div class="info">
        <span class="label">Amount:</span> KES <?php echo $bill['amount']; ?>
    </div>

    <div class="info">
        <span class="label">Current Status:</span> 
        <span class="<?php echo strtolower($bill['status']); ?>">
            <?php echo $bill['status']; ?>
        </span>
    </div>

    <?php if ($bill['status'] != "Paid"): ?>
        <form method="POST">
            <button type="submit" name="pay">Mark as Paid</button>
        </form>
    <?php else: ?>
        <p style="text-align:center; color:green;">This bill is already paid.</p>
    <?php endif; ?>

    <a href="billing.php">← Back to Billing</a>

</div>

</body>
</html>