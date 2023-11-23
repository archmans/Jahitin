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

include 'controller/functionsUser.php';

$id = $_SESSION["id"];
$user = query("SELECT * FROM users WHERE id = $id")[0];

if( isset($_POST["save"]) ) {
	if( updateProfil($_POST) > 0 ) {
		echo "<script>
				alert('Profil berhasil disimpan!');
				document.location.href = 'profilPage.php';
			</script>";
	} else {
		echo "<script>
				alert('masukkan data dengan benar, profil gagal diupdate!');
				document.location.href = 'profilPage.php';
			</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles\homepage.css">
    <link rel="stylesheet" href="styles\profilPage.css">

    <title>Homepage User</title>
</head>
<body>
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
                    <li><a href="premiumPage.php">Premium</a></li>
                    <li><a href="profilPage.php" style="color: #279864">Profile</a></li>
                    <li><a href="controller/logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="container-title">
            <div class="line-left"></div>
            <div class="title">
                <p>Your Profile</p>
            </div>
            <div class="line-right"></div>
        </div>
    </div>

    <div class="container-profil">
        <div class="card-profil">
            <div class="foto-profil">
                <img src="assets\user.png" alt="profil">
            </div>
            <form action="" method="post">
            <ul>
                    <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
                    <input type="hidden" name="username" value="<?php echo $user["username"]; ?>">
                <li>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $user["email"]; ?>">
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo $user["password"]; ?>">
                </li>
                <li>
                    <button type="submit" id="submit" name="save" onclick="return confirm('Are you sure?')">Save</button>
                </li>
            </ul>
        </form>
    </div>
</body>

<style>
    .logo {
        padding-left: 3rem;
    }
</style>
</html>