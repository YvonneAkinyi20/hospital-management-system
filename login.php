<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hospital Management System</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f4f6fb;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

/* MAIN CONTAINER */

.container{
    width:950px;
    height:550px;
    background:white;
    border-radius:10px;
    display:flex;
    overflow:hidden;
    box-shadow:0 0 20px rgba(0,0,0,0.15);
}

/* LEFT PANEL */

.left-panel{
    width:40%;
    background:#eef4ff;
    text-align:center;
    padding:40px 30px;
}

.logo i{
    font-size:110px;
    color:#2563eb;
}

.left-panel h1{
    color:#2563eb;
    font-size:42px;
    margin-top:10px;
}

.left-panel h2{
    color:#2563eb;
    font-size:24px;
}

.blue-line{
    width:120px;
    height:4px;
    background:#2563eb;
    margin:20px auto;
}

.left-panel p{
    color:#444;
    line-height:1.8;
    margin-top:15px;
    font-size:18px;
}

.heartbeat{
    font-size:80px;
    color:#c2d6ff;
    margin-top:80px;
}

/* RIGHT PANEL */

.right-panel{
    width:60%;
    display:flex;
    justify-content:center;
    align-items:center;
}

.login-box{
    width:75%;
    border:1px solid #ddd;
    border-radius:10px;
    padding:35px;
}

.login-box h1{
    text-align:center;
    color:#0f172a;
    font-size:38px;
}

.login-box p{
    text-align:center;
    color:gray;
    margin-top:5px;
}

.small-line{
    width:60px;
    height:4px;
    background:#2563eb;
    margin:15px auto 25px;
}

/* FORM */

label{
    font-weight:bold;
    color:#333;
}

.input-box{
    display:flex;
    align-items:center;
    border:1px solid #ddd;
    border-radius:8px;
    padding:12px;
    margin-top:8px;
    margin-bottom:20px;
}

.input-box i{
    color:gray;
    margin-right:10px;
}

.input-box input{
    width:100%;
    border:none;
    outline:none;
    font-size:15px;
}

.options{
    display:flex;
    justify-content:space-between;
    margin-bottom:20px;
    font-size:14px;
}

.options a{
    text-decoration:none;
    color:#2563eb;
}

.login-btn{
    width:100%;
    padding:15px;
    background:#2563eb;
    border:none;
    border-radius:8px;
    color:white;
    font-size:18px;
    cursor:pointer;
    transition:0.3s;
}

.login-btn:hover{
    background:#1d4ed8;
}

.or{
    text-align:center;
    margin:20px 0;
    color:gray;
}

.admin-link{
    text-align:center;
}

.admin-link a{
    text-decoration:none;
    color:#2563eb;
    font-weight:bold;
}

</style>
</head>
<body>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="left-panel">

        <div class="logo">
            <i class="fas fa-hospital"></i>
        </div>

        <h1>HOSPITAL</h1>
        <h2>MANAGEMENT SYSTEM</h2>

        <div class="blue-line"></div>

        <p>
            Efficiently manage patients, appointments,
            doctors and hospital information.
        </p>

        <div class="heartbeat">
            ❤
        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="right-panel">

        <div class="login-box">

            <h1>WELCOME BACK</h1>
            <p>Please login to your account</p>

            <div class="small-line"></div>

            <form id="loginForm">

                <label>Username</label>

                <div class="input-box">
                    <i class="fa fa-user"></i>

                    <input
                    type="text"
                    id="username"
                    placeholder="Enter your username">
                </div>

                <label>Password</label>

                <div class="input-box">
                    <i class="fa fa-lock"></i>

                    <input
                    type="password"
                    id="password"
                    placeholder="Enter your password">
                </div>

                <div class="options">

                    <div>
                        <input type="checkbox">
                        Remember me
                    </div>

                    <a href="#">Forgot password?</a>

                </div>

                <button class="login-btn" type="submit">
                    <i class="fa fa-sign-in-alt"></i>
                    LOGIN
                </button>

                <div class="or">OR</div>

                <div class="admin-link">
                    <a href="#">Login as Admin</a>
                </div>

            </form>

        </div>

    </div>

</div>

<script>

document.getElementById("loginForm")
.addEventListener("submit", function(event){

    event.preventDefault();

    let username =
    document.getElementById("username").value;

    let password =
    document.getElementById("password").value;

    if(username === "" || password === ""){
        alert("Please enter username and password");
    }
    else{
        alert("Login Successful");
    }

});

</script>

</body>
</html>