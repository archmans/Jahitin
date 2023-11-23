<?php
include "controller/loginBackend.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/loginRegister.css">
    <title>Login Page</title>
</head>
<body>
    <div class='container'>
        <form action="controller/loginBackend.php" method="POST" class='login-email'>
            <div class="logo-container">
                <img src="assets/logo.png" alt="Logo">
            </div>
            <div class="title">LOGIN</div>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button type="submit" id='submit' name="login" class="btn">LOGIN</button>
            </div>
            <p class="login-register-text">Don't Have an Account? <a href="registerPage.php">Register Here</a>.</p>
        </form>
    </div>
</body>
</html>
