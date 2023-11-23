<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("location: loginPage.php");
	exit;
}

include 'functionsReview.php';

$reviewID = $_GET["id"];
$review = query("SELECT * FROM review WHERE reviewID = $reviewID")[0];
$penjahitID = $review["penjahitID"];

if( isset($_POST["update"]) ) {
	if( updateReview($_POST) > 0 ) {
		echo "<script>
				alert('data berhasil diupdate!');
				document.location.href = '../reviewPage.php?id=$penjahitID';
			</script>";
	} else {
		echo "<script>
				alert('masukkan data dengan benar, data gagal diupdate!');
				document.location.href = 'updateReview.php?id=$reviewID';
			</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update Review</title>
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
				<a href="..\reviewPage.php?id=<?= $penjahitID; ?>" class="arrow-left-button">
					<img src="..\assets\arrow-left-32.png" alt="arrow-left"/>
				</a>
			</div>
			<div class="logo">
				<img src="..\assets\logo.png" alt="logo jahitin"/>
			</div>
			<div class="nav-right">
				<ul>
					<?php if ($_SESSION['role'] == "admin") { ?>
						<li><a href="..\homepageAdmin.php">Tailor</a></li>
						<li><a href="..\manageUser.php">User</a></li>
						<li><a href="..\controller\logout.php">Logout</a></li>
					<?php } else { ?>
						<li><a href="..\homepageUser.php">Home</a></li>
						<li><a href="..\premiumPage.php">Premium</a></li>
						<li><a href="..\profilPage.php">Profile</a></li>
						<li><a href="..\controller\logout.php">Logout</a></li>
					<?php } ?>
				</ul>
			</div>
		</nav>
		<div class="container-title">
			<div class="line-left"></div>
			<div class="title">
				<p>Update Review</p>
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
					<div class="form-input">
						<li>
							<label for="ulasan">Ulasan : </label>
							<textarea type="text" name="ulasan" id="ulasan" value="<?php echo $review["ulasan"]; ?>"></textarea>
						</li>
						<div class="form-media">
							<li>
								<label for="foto_ulasan">Picture : </label>
								<img src="../img/<?= $review["foto_ulasan"]; ?>" width="100" alt="foto-ulasan"></img>
								<br>
								<input type="file" name="foto_ulasan" id="foto_ulasan">
							</li>
							<br>
							<li>
								<label for="video_ulasan">Video : </label>
								<video src="../vid/<?= $review["video_ulasan"]; ?>" width="100">
								</video><br>
								<input type="file" name="video_ulasan" id="video_ulasan">
							</li>
							<li>
						</div>
					</div>
						<button type="submit" id="submit" name="update" onclick="return confirm('Are you sure to update the review?')">Update Review</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
</body>

<style>
	@media (max-width: 830px) {
		.form-input {
			flex-direction: column;
		}
		.form-media {
			padding-left: 0;
		}
	}

	@media (max-width: 500px) {
		textarea {
			width: 18rem;

		}
		.form-media {
			padding-left: 0;
		}
		.card-form {
			padding: 1rem 0rem 2rem 0rem;
		}
		.logo img {
			padding-left: 2rem;
		}
	}
</style>
</html>