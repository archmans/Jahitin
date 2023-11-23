<?php 
session_start();
if ($_SESSION["role"] != "admin") {
    header("location: loginPage.php");
    exit;
}
if (!isset($_SESSION["login"])) {
    header("location: loginPage.php");
    exit;
}
include 'functions.php';

$tailorID = $_GET["id"];
$tailor = query("SELECT * FROM tailor WHERE tailorID = $tailorID")[0];

if( isset($_POST["update"]) ) {
	if( updateTailor($_POST) > 0 ) {
		echo "<script>
				alert('data berhasil diupdate!');
				document.location.href = '../homepageAdmin.php';
			</script>";
	} else {
		echo "<script>
				alert('masukkan data dengan benar, data gagal diupdate!');
				document.location.href = 'updateTailor.php?id=$tailorID';
			</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update Data Tailor</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="..\styles\homepage.css">
    <link rel="stylesheet" href="..\styles\addUpdateForm.css">
</head>
<body>
	<div class="container">
		<div class="bangs">
			<p class="title"> Hi, <?php echo $_SESSION['username']; ?>! </p>
		</div>
		<nav>
			<div class="nav-left">
				<a href="..\homepageAdmin.php" class="arrow-left-button">
					<img src="..\assets\arrow-left-32.png" alt="arrow-left"/>
				</a>
			</div>
			<div class="logo">
				<img src="..\assets\logo.png" alt="logo jahitin"/>
			</div>
			<div class="nav-right">
				<ul>
					<li><a href="../homepageAdmin.php">Tailor</a></li>
					<li><a href="../manageUser.php">User</a></li>
					<li><a href="../controller/logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>
		<div class="container-title">
			<div class="line-left"></div>
			<div class="title">
				<p>Update Tailor</p>
			</div>
			<div class="line-right"></div>
		</div>
	</div>
	<div class="container-form">
        <div class="card-form">
			<form action="" method="post" enctype="multipart/form-data">
				<ul>
					<input type="hidden" name="id" value="<?php echo $tailor["tailorID"]; ?>">
					<input type="hidden" name="oldFoto" value="<?php echo $tailor["foto_tailor"]; ?>">
					<input type="hidden" name="oldVideo" value="<?php echo $tailor["video_tailor"]; ?>">
					<div class="form-input" style="flex-direction: column">
						<div class="form-input-text">
							<li>
								<label for="nama">Name : </label>
								<input type="text" name="nama" id="nama" value="<?php echo $tailor["nama"]; ?>">
							</li>
							<li>
								<label for="alamat">Address : </label>
								<input type="text" name="alamat" id="alamat" value="<?php echo $tailor["alamat"]; ?>">
							</li>
							<li>
								<label for="jenis">Category : </label>
								<select name="jenis" id="jenis">
									<option disabled selected value> <?php echo $tailor["jenis"]; ?> </option>
									<option value="Custom">Custom</option>
									<option value="Service">Service</option>
								</select>
							</li>
						</div>
						<div class="form-media" style="padding-left: 0">
							<li>
								<label for="foto_tailor">Picture : </label>
								<img src="../img/<?= $tailor["foto_tailor"]; ?>" width="100" alt="foto-tailor"></img>
								<br>
								<input type="file" name="foto_tailor" id="foto_tailor">
							</li>
							<br>
							<li>
								<label for="video_tailor">Video : </label>
								<video src="../vid/<?= $tailor["video_tailor"]; ?>" width="100">
								</video><br>
								<input type="file" name="video_tailor" id="video_tailor">
							</li>
						</div>
						<div class="form-button">
							<li>
								<button type="submit" id="submit" name="update" onclick="return confirm('Are you sure to update the tailor?')">Update Tailor</button>
							</li>
						</div>
					</div>
				</ul>
			</form>
		</div>
	</div>
</body>
</html>