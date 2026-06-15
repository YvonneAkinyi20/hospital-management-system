<?php
include("authentication.php"); // protect page
include("db.php");             // database connection

$message = "";

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $age = trim($_POST['age']);
    $gender = trim($_POST['gender']);
    $contact = trim($_POST['contact']);

    // Basic validation
    if (empty($name) || empty($age) || empty($gender) || empty($contact)) {
        $message = "All fields are required!";
    } else {

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO patients (name, age, gender, contact) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $name, $age, $gender, $contact);

        if ($stmt->execute()) {
            // Redirect after success
            header("Location: patients.php");
            exit();
        } else {
            $message = "Failed to add patient!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Patient</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            margin: 0;
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

        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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

    <h2>Add Patient</h2>

    <?php if (!empty($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="name" placeholder="Patient Name">

        <input type="number" name="age" placeholder="Age">

        <select name="gender">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <input type="text" name="contact" placeholder="Contact Number">

        <button type="submit" name="submit">Add Patient</button>
    </form>

    <a href="patients.php">← Back to Patients</a>

</div>

</body>
</html>