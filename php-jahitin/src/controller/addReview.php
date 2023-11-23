<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("location: loginPage.php");
	exit;
}

include 'functionsReview.php';

$id = $_GET["id"];

if( isset($_POST["tambah"]) ) {
	if( addReview($_POST) > 0 ) {
		echo "<script>
				alert('data berhasil ditambahkan!');
				document.location.href = '../reviewPage.php?id=$id';
            </script>";
	} else {
		echo "<script>
				alert('data gagal ditambahkan!');
				document.location.href = '../reviewPage.php?id=$id';
		</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Review Tailor</title>
	<meta charset="UTF-8">
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
				<a href="..\reviewPage.php?id=<?= $id; ?>" class="arrow-left-button">
					<img src="..\assets\arrow-left-32.png" alt="arrow-left"/>
				</a>
			</div>
			<div class="logo">
				<img src="..\assets\logo.png" alt="logo jahitin"/>
			</div>
			<div class="nav-right">
				<ul>
					<?php if ($_SESSION['role'] == 'admin') { ?>
						<li><a href="../homepageAdmin.php">Tailor</a></li>
						<li><a href="../manageUser.php">User</a></li>
						<li><a href="../controller/logout.php">Logout</a></li>
					<?php } else { ?>
						<li><a href="../homepageUser.php">Home</a></li>
						<li><a href="../premiumPage.php">Premium</a></li>
						<li><a href="../profilPage.php">Profile</a></li>
						<li><a href="../controller/logout.php">Logout</a></li>
					<?php } ?>
				</ul>
			</div>
		</nav>
		<div class="container-title">
			<div class="line-left"></div>
			<div class="title">
				<p>Add Review</p>
			</div>
			<div class="line-right"></div>
		</div>
	</div>
	<div class="container-form">
        <div class="card-form">
			<form action="" method="post" enctype="multipart/form-data">
				<ul>
					<input type="hidden" name="id" id="id" value="<?= $id; ?>">
					<div class="form-input">
						<li>
							<label for="ulasan">Ulasan : </label>
							<textarea type="text" name="ulasan" id="ulasan"></textarea>
						</li>
						<div class="form-media">
							<li>
								<label for="foto_ulasan">Foto : </label>
								<input type="file" name="foto_ulasan" id="foto_ulasan">
							</li>
							<li>
								<label for="video_ulasan">Video : </label>
								<input type="file" name="video_ulasan" id="video_ulasan">
							</li>
							<li>
						</div>
					</div>
						<button type="submit" id="submit" name="tambah" onclick="return confirm('Are you sure to add the review?')">Add Review</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
</body>

<style>
	@media (max-width: 840px) {
		.form-input {
			flex-direction: column;
		}
	}
	@media (max-width: 520px) {
		.card-form {
			padding: 1rem 0rem 2rem 0rem;
		}
		textarea {
			width: 16rem;
		}
		.form-media {
    		padding: 0;
		}
	}
</style>

</html>