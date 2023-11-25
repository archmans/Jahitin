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
                <div class="image-grid">
                <?php foreach( $penjahit as $row ) { ?>
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
                    <?php $i++; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
.container-gallery{
    display: flex;
    justify-content: space-around;
    margin-top: 3rem;
}

.image-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-top: 2rem;
}

.image-item {
    display: flex;
    flex-direction: column;
    width: calc(33.3% - 1rem);
    margin-bottom: 1rem;
}

.image-gallery {
    width: 100%;
    object-fit: cover;
}

.image-title {
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
    margin-top: 1rem;
}


.container-media-gallery{
    width: 90%;
    padding: 0.5rem;

}

.line {
    width: 100%;
    height: 0.2rem;
    background-color: black;
    margin: 0.5rem 0rem;
}

@media (max-width: 750px) {
    .container-gallery {
        flex-direction: column;
        align-items: center;
    }
    
    .container-media-gallery {
        height: auto;
        width: 90%;
        padding: 0.5rem;
    }
    .image-grid {
        gap: 0.5rem;
    }
    .image-item {
        width: calc(50% - 0.5rem);
    }
}
</style>

</html>
