<?php
session_start();
if ($_SESSION["role"] != "user") {
    header("location: loginPage.php");
    exit;
}
if (!isset($_SESSION["login"])) {
    header("location: loginPage.php");
    exit;
}
include 'controller/soap.php';
$statusSoap = getStatus($_SESSION["id"]);

if (isset($_POST["subscribe"])) {
    $response = newSubscription($_SESSION["id"]);
    header("location: premiumPage.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles\homepage.css">
    <link rel="stylesheet" href="styles\premium.css">
    <title>Premium Tailor</title>
</head>
<div class="container">
        <div class="bangs">
            <p class="title"> Hi, <?php echo $_SESSION['username']; ?>! </p>
        </div>
        <nav>
            <div class="logo">
                <img src="assets\logo.png" alt="logo jahitin"/>
            </div>
            <div class="nav-right">
                <ul>
                    <li><a href="homepageUser.php">Home</a></li>
                    <li><a href="premiumPage.php" style="color: #279864">Premium</a></li>
                    <li><a href="profilPage.php">Profile</a></li>
                    <li><a href="controller/logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="container-title">
            <div class="line-left"></div>
            <div class="title">
                <p>Premium Tailor</p>
            </div>
            <div class="line-right"></div>
        </div>
    </div>
<body>
    <?php if ($statusSoap == "NOT FOUND") { ?>
        <?php include 'view/newuser.php'; ?>
    <?php } else if ($statusSoap == "PENDING") { ?>
        <?php include 'view/pending.php'; ?>
    <?php } else if ($statusSoap == "REJECTED") { ?>
        <?php include 'view/rejected.php'; ?>
    <?php } else if ($statusSoap == "ACCEPTED") { ?>
        <?php include 'view/accepted.php'; ?>
    <?php } ?>
</body>
<style>
    .logo {
        padding-left: 3rem;
    }
</style>
</html>   