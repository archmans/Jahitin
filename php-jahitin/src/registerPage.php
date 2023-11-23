<?php
    include "controller/registerBackend.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles\loginRegister.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
    <form action="controller/registerBackend.php" method="POST" class='login-email'>
            <div class="logo-container">
                <img src="assets\logo.png" alt="Logo">
            </div>
            <div class="title">REGISTER
            </div>
            <div class="input-group">
                <input type="text" placeholder="Username" id='username' name="username" required>
                <span id="errorUsername"></span>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" id='email' required>
                <span id="errorEmail"></span>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" id='password' name="password" required>
                <span id="errorPassword"></span>
            </div>
            <div class="input-group">
                <button type="submit" id='submit' name="register" class="btn" disabled>Register</button>
            </div>
            <p class="login-register-text">Already Have an Account? <a href="loginPage.php">Login Here</a>.</p>
        </form>
    </div>
    <script src="js/register.js"></script>
</body>
</html>