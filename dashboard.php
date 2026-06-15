<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hospital Management System - Login</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    height: 100vh;
    background: #f4f7ff;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    width: 900px;
    height: 520px;
    background: #fff;
    display: flex;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
}

/* LEFT PANEL */
.left {
    width: 45%;
    background: linear-gradient(135deg, #dfe9ff, #f5f8ff);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 30px;
    text-align: center;
}

.left img {
    width: 120px;
    margin-bottom: 20px;
}

.left h1 {
    color: #2b5cff;
    margin-bottom: 10px;
}

.left p {
    font-size: 14px;
    color: #555;
    margin-top: 10px;
}

/* RIGHT PANEL */
.right {
    width: 55%;
    padding: 50px;
}

.right h2 {
    margin-bottom: 5px;
}

.right p {
    color: #777;
    margin-bottom: 25px;
    font-size: 14px;
}

.input-box {
    margin-bottom: 15px;
}

.input-box label {
    font-size: 13px;
    color: #333;
}

.input-box input {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

.options {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    margin: 10px 0 20px;
}

button {
    width: 100%;
    padding: 12px;
    background: #2b5cff;
    border: none;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    font-size: 15px;
}

button:hover {
    background: #1f45d8;
}

.admin {
    text-align: center;
    margin-top: 15px;
    font-size: 13px;
    color: #2b5cff;
    cursor: pointer;
}
</style>
</head>

<body>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="left">
        <!-- Replace with your own image -->
        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966488.png" alt="Hospital">
        <h1>HOSPITAL</h1>
        <h3>MANAGEMENT SYSTEM</h3>
        <p>Efficiently manage patients, appointments, doctors and hospital information.</p>
    </div>

    <!-- RIGHT SIDE -->
    <div class="right">
        <h2>WELCOME BACK</h2>
        <p>Please login to your account</p>

        <form onsubmit="return loginUser()">

            <div class="input-box">
                <label>Username</label>
                <input type="text" id="username" placeholder="Enter your username">
            </div>

            <div class="input-box">
                <label>Password</label>
                <input type="password" id="password" placeholder="Enter your password">
            </div>

            <div class="options">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit">LOGIN</button>

            <div class="admin">
                Login as Admin
            </div>

        </form>
    </div>

</div>

<script>
function loginUser() {
    let user = document.getElementById("username").value;
    let pass = document.getElementById("password").value;

    if(user === "" || pass === "") {
        alert("Please fill in all fields");
        return false;
    }

    alert("Login successful (demo)");
    return false; // prevent reload
}
</script>

</body>
</html>