<?php
session_start();
include "config.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password'] && $row['role'] == 'admin') {
            $_SESSION['role'] = $row['role'];
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header("location: ../homepageAdmin.php");
            exit;
        } else if ($password == $row['password'] && $row['role'] == 'user') {
            $_SESSION['role'] = $row['role'];
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header("location: ../homepageUser.php");
            exit;
        } else {
            echo "<script>
                    alert('Password is Incorrect!')
                    document.location.href = '../loginPage.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Username is Incorrect!')
                document.location.href = '../loginPage.php';
            </script>";
    }
}
?>
