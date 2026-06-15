<?php
include("authentication.php");
include("db.php");

$message = "";

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $specialization = trim($_POST['specialization']);
    $contact = trim($_POST['contact']);

    // Validation
    if (empty($name) || empty($specialization) || empty($contact)) {
        $message = "All fields are required!";
    } else {

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO doctors (name, specialization, contact) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $specialization, $contact);

        if ($stmt->execute()) {
            header("Location: doctors.php");
            exit();
        } else {
            $message = "Failed to add doctor!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Doctor</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
        }

        .container {
            width: 400px;
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

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
    </style>
</head>

<body>

<div class="container">

    <h2>Add Doctor</h2>

    <?php if (!empty($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">

        <input type="text" name="name" placeholder="Doctor Name">

        <input type="text" name="specialization" placeholder="Specialization (e.g. Cardiology)">

        <input type="text" name="contact" placeholder="Contact Number">

        <button type="submit" name="submit">Add Doctor</button>
    </form>

    <a href="doctors.php">← Back to Doctors</a>

</div>

</body>
</html>