<?php
include "config.php";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $username = "";
            $email = "";
            $_POST['password'] = "";
            echo "<script>alert('Registration Successful!')
                    document.location.href = '../loginPage.php';
                </script>";
        } else {
            echo "<script>alert('Registration Failed!')
                    document.location.href = '../registerPage.php';
                </script>";
        }
    } else {
        echo "<script>alert('Username or Email Already Exists!')
                document.location.href = '../registerPage.php';       
            </script>";
    }
}
?>