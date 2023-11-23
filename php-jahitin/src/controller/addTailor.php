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

if( isset($_POST["tambah"]) ) {
	if( addTailor($_POST) > 0 ) {
		echo "<script>
				alert('data berhasil ditambahkan!');
				document.location.href = '../homepageAdmin.php';
            </script>";
	} else {
		echo "<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'addTailor.php';
		</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Add Tailor</title>
	<meta charset="UTF-8" />
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
					<li><a href="..\homepageAdmin.php">Tailor</a></li>
					<li><a href="..\manageUser.php">User</a></li>
					<li><a href="..\controller\logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>
		<div class="container-title">
			<div class="line-left"></div>
			<div class="title">
				<p>Add Tailor</p>
			</div>
			<div class="line-right"></div>
		</div>
	</div>

	<div class="container-form">
        <div class="card-form">
			<form action="" method="post" enctype="multipart/form-data">
				<ul>
					<input type="hidden" name="id" value="<?php echo $review["reviewID"]; ?>">
					<input type="hidden" name="penjahitID" value="<?php echo $review["penjahitID"]; ?>">
					<input type="hidden" name="oldFoto" value="<?php echo $review["foto_ulasan"]; ?>">
					<input type="hidden" name="oldVideo" value="<?php echo $review["video_ulasan"]; ?>">
					<div class="form-input" style="flex-direction: column">
						<div class="form-input-text">
							<li>
								<label for="nama">Nama : </label>
								<input type="text" name="nama" id="nama">
							</li>
							<li>
								<label for="alamat">Alamat : </label>
								<input type="text" name="alamat" id="alamat">
							</li>
							<li>
								<label for="jenis">Jenis : </label>
								<select name="jenis" id="jenis">
									<option disabled selected value>Jenis </option>
									<option value="Custom">Custom</option>
									<option value="Service">Service</option>
								</select>
							</li>
						</div>
						<div class="form-media" style="padding-left: 0">
							<li>
								<label for="foto_tailor">Foto : </label>
								<input type="file" name="foto_tailor" id="foto_tailor">
							</li>
							<li>
								<label for="video_tailor">Video : </label>
								<input type="file" name="video_tailor" id="video_tailor">
							</li>
						</div>
						<div class="form-button">
							<li>
								<button type="submit" name="tambah" onclick="return confirm('Are you sure to add the tailor?')">Add Tailor</button>
							</li>
						</div>
					</div>
				</ul>
			</form>
		</div>
	</div>
</body>

<style>
	@media (max-width: 500px) {
		input#nama, 
		input#alamat, 
		select#jenis {
			width: 17rem;
		}
		.card-form {
			padding: 1rem 0.5rem 2rem 0.5rem;
		}
		.container-form {
			width: auto;
		}
	}

</style>

</html>