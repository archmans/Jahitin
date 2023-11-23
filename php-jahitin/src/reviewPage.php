<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("location: loginPage.php");
	exit;
}

include 'controller/functions.php';

$idPenjahit = $_GET["id"];
$review = query("select * from review where penjahitID = $idPenjahit");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Halaman Review</title>
	<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles\homepage.css">
    <link rel="stylesheet" href="styles\reviewPage.css">
	<link rel="stylesheet" href="styles\listTailor.css">
</head>

<body>
	<div class="container">
		<div class="bangs">
			<p class="title"> Hi, <?php echo $_SESSION['username']; ?>! </p>
		</div>
		<nav>
			<div class="nav-left">
				<?php if ($_SESSION['role'] == 'admin') { ?>
					<a href="homepageAdmin.php" class="arrow-left-button">
						<img src="assets\arrow-left-32.png" alt="arrow-left"/>
					</a>
				<?php } else { ?>
					<a href="homepageUser.php" class="arrow-left-button">
						<img src="assets\arrow-left-32.png" alt="arrow-left"/>
					</a>
				<?php } ?>
			</div>
			<div class="logo">
				<img src="assets\logo.png" alt="logo jahitin"/>
			</div>
			<div class="nav-right">
				<ul>
				<?php if ($_SESSION['role'] == 'admin') { ?>
					<li><a href="homepageAdmin.php">Tailor</a></li>
					<li><a href="manageUser.php">User</a></li>
					<li><a href="controller/logout.php">Logout</a></li>
				<?php } else { ?>
					<li><a href="homepageUser.php">Home</a></li>
                    <li><a href="premiumPage.php">Premium</a></li>
					<li><a href="profilPage.php">Profile</a></li>
					<li><a href="controller/logout.php">Logout</a></li>
				<?php } ?>
				</ul>
			</div>
		</nav>
		<div class="container-title">
			<div class="line-left"></div>
			<div class="title">
				<p>Tailor's Reviews</p>
			</div>
			<div class="line-right"></div>
		</div>
	</div>

	<div class="add">
		<a href="controller/addReview.php?id=<?php echo $idPenjahit; ?>"> + Add Review</a>
	</div>
	<div class="styled-container">
		<?php if ($review == null) { ?>
			<div class="styled-item" align="center">Review not found</div>
		<?php } ?>
		<?php $i = 1; ?>
		<?php foreach( $review as $row ) { ?>
			<div class="card-review">
				<div class="container-review-all">
					<div class="content">
						<div class="container-profil">
							<img alt="profil-user" src="assets/user.png" style="height: 30px">
						</div>
						<div class="container-review">
							<p class="user"> anonymous </p>
							<div class="isi-ulasan"><?= $row["ulasan"]; ?></div>
							<div class="media-ulasan">
								<!-- Pop-up untuk Gambar -->
								<a class="button" href="#popupPic<?= $i ?>">
									<div class="media-foto">
										<img alt="foto-ulasan" src="img/<?= $row["foto_ulasan"]; ?>">
									</div>
								</a>
								<div id="popupPic<?= $i ?>" class="overlay">
									<div class="container-popUp">
										<div class="close">
											<a class="x" href="#" onclick="closePopupPic(<?= $i ?>)">&times;</a>
										</div>
										<div class="popup">
											<div class="content" style="justify-content: center">
												<img src="img/<?= $row["foto_ulasan"]; ?>" style="max-height: 500px;">
											</div>
										</div>
									</div>
								</div>

								<!-- Pop-up untuk Video -->
								<a class="button" href="#popupVid<?= $i ?>">
									<div class="media-video">
										<video alt="video-ulasan" src="vid/<?= $row["video_ulasan"]; ?>"></video>
									</div>
								</a>
								<div id="popupVid<?= $i ?>" class="overlay">
									<div class="container-popUp">
										<div class="close">
											<a class="x" href="#" onclick="closePopupVid(<?= $i ?>)">&times;</a>
										</div>
										<div class="popup">
											<div class="content" style="justify-content: center">
												<video src="vid/<?= $row["video_ulasan"]; ?>" id="vid<?= $i ?>" style="max-height: 500px;" controls></video>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="aksi">
						<a class="update" href="controller/updateReview.php?id=<?php echo $row["reviewID"]; ?>">Update</a> 
						<a class="delete" href="controller/deleteReview.php?id=<?= $row["reviewID"]; ?>" onclick="return confirm('Are you sure?');">Delete</a>
					</div>
				</div>
			</div>
			<?php $i++; ?>
		<?php } ?>
	</div>
	<script>
		src="js/popUpVideo.js"
		src="js/popUpFoto.js"
	</script>
</body>
</html>