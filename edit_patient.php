<?php
include("authentication.php");
include("db.php");

// Get patient ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid patient ID");
}

// Fetch existing patient data
$stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();

if (!$patient) {
    die("Patient not found");
}

$message = "";

// Update logic
if (isset($_POST['update'])) {

    $name = trim($_POST['name']);
    $age = trim($_POST['age']);
    $gender = trim($_POST['gender']);
    $contact = trim($_POST['contact']);

    if (empty($name) || empty($age) || empty($gender) || empty($contact)) {
        $message = "All fields are required!";
    } else {

        $update = $conn->prepare("UPDATE patients SET name=?, age=?, gender=?, contact=? WHERE id=?");
        $update->bind_param("sissi", $name, $age, $gender, $contact, $id);

        if ($update->execute()) {
            header("Location: patients.php");
            exit();
        } else {
            $message = "Failed to update patient!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Patient</title>

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

        input, select {
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
            cursor: pointer;
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

    <h2>Edit Patient</h2>

    <?php if (!empty($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">

        <input type="text" name="name" value="<?php echo $patient['name']; ?>">

        <input type="number" name="age" value="<?php echo $patient['age']; ?>">

        <select name="gender">
            <option value="Male" <?php if ($patient['gender'] == "Male") echo "selected"; ?>>Male</option>
            <option value="Female" <?php if ($patient['gender'] == "Female") echo "selected"; ?>>Female</option>
        </select>

        <input type="text" name="contact" value="<?php echo $patient['contact']; ?>">

        <button type="submit" name="update">Update Patient</button>
    </form>

    <a href="patients.php">← Back to Patients</a>

</div>

</body>
</html>