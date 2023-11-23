<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("location: loginPage.php");
	exit;
}
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://rest-app:4000/tailor');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
$tailor = json_decode($result, true);

include 'controller/functions.php';

$idPenjahit = $_GET["id"];
$tailor2 = $tailor["data"];
$penjahit = array_filter($tailor2, function ($var) use ($idPenjahit) {
    return ($var['id'] == $idPenjahit);
});
$penjahit = array_values($penjahit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Halaman Review</title>
	<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles\homepage.css">
    <link rel="stylesheet" href="styles\galleryPage.css">
</head>

<body>
	<div class="container">
		<div class="bangs">
			<p class="title"> Hi, <?php echo $_SESSION['username']; ?>! </p>
		</div>
		<nav>
			<div class="nav-left">
                <a href="premiumPage.php" class="arrow-left-button">
                    <img src="assets\arrow-left-32.png" alt="arrow-left"/>
                </a>
			</div>
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
                <p><?php echo $tailor2[$idPenjahit]["username"]; ?>'s Gallery</p>
			</div>
			<div class="line-right"></div>
		</div>
	</div>

    <div class="container-gallery">
        <div class="container-media-gallery">
            <div class="container-image">
                <h2>Image</h2>
                <div class="line"></div>
                <?php $i = 1; ?>
                <?php foreach( $penjahit as $row ) { ?>
                    <div class="image-grid">
                        <div class="image-item">
                            <?php
                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_URL, 'http://rest-app:4000/' . $row["imageNameExt"]);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
                            $imageResult = curl_exec($curl);
                            curl_close($curl);
                            ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($imageResult); ?>" alt="<?php echo $row["imageNameExt"]; ?>" class="image-gallery">
                            <p class="image-title"><?php echo $row["imageName"]; ?></p>
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
