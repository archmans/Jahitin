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

include 'controller/functions.php';
$tailor = query("select * from tailor");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles\homepage.css">
    <link rel="stylesheet" href="styles\listTailor.css">

    <title>Homepage Admin</title>
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
                    <li><a href="homepageAdmin.php" style="color: #279864">Tailor</a></li>
                    <li><a href="manageUser.php">User</a></li>
                    <li><a href="controller/logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="search">
            <input type="text" class="search-input" id="search-term" placeholder="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>">
            <div class="buttons-container">
                <div class="sort-filter">
                    <label for="sort-Alphabet"></label>
                    <select class="sort-option" id="sort-Alphabet">
                        <option disabled selected value>Sort</option>
                        <option value="asc">Ascending (A to Z)</option>
                        <option value="desc">Descending (Z to A)</option>
                    </select>
                    <label for="filter-tailor"></label>
                    <select class="filter-option" id="filter-tailor">
                        <option disabled selected value>Filter</option>
                        <option value="Custom">Custom Tailors</option>
                        <option value="Service">Service Tailor</option>
                    </select>
                </div>
                <div class="buttons">
                    <button class="btn" id="search-btn" onclick="debounceSearchTailorAdmin(1);">Search</button>
                    <button class="btn" id="reset-btn" onclick="resetSearchAdmin();">Reset</button>
                </div>
            </div>
        </div>
        <div class="container-title">
            <div class="line-left"></div>
            <div class="title">
                <p>Our Tailor</p>
            </div>
            <div class="line-right"></div>
        </div>
    </div>
    <div class="add">
		<a href="controller/addTailor.php"> + Add Tailor</a>
	</div>
    <div class="search-results-list" id="search-results-list">
        <ul class="tailor-list">
            <?php $i = 1; ?>
            <?php foreach( $tailor as $row ) { ?>
                <div class="tailor-card-actions">
                    <div class="tailor-card-number">
                        <li class="tailor-item" style="flex-direction: column">
                            <div class="tailor-card">
                                <div class="tailor-media">
                                    <img src="img/<?= $row["foto_tailor"]; ?>" alt="<?= $row["nama"]; ?>" class="tailor-photo">
                                </div>
                                <div class="tailor-info">
                                    <h1 class="tailor-name"><?= $row["nama"]; ?></h1>
                                    <h2>Address</h2>
                                    <p class="tailor-address"><?= $row["alamat"]; ?></p>
                                    <h2>Category</h2>
                                    <p class="tailor-category"><?= $row["jenis"]; ?></p>
                                    <h2>Review</h2>
                                    <a class="button" href="reviewPage.php?id=<?php echo $row["tailorID"]; ?>">Tailor's Review</a>
                                    <h2>Karya</h2>
                                    <a class="button" href="#popupVid<?= $i ?>">Video Karya Penjahit</a>
                                    <div id="popupVid<?= $i ?>" class="overlay">
                                        <div class="container-popUp">
                                            <div class="close">
                                                <a class="x" href="" onclick="closePopupVid(<?= $i ?>)">&times;</a>
                                            </div>
                                            <div class="popup">
                                                <h1><?= $row["nama"]; ?></h1>
                                                <div class="content">
                                                    <video src="vid/<?= $row["video_tailor"]; ?>" id="vid<?= $i ?>" style="max-height: 450px;" controls></video>
                                                </div>
                                            </div>
                                        </div>
                                    </div>     
                                </div>  
                            </div>
                            <div class="tailor-actions">
                                <a class="update" href="controller/updateTailor.php?id=<?php echo $row["tailorID"]; ?>">Update</a>
                                <a class="review" href="reviewPage.php?id=<?php echo $row["tailorID"]; ?>">Review</a>
                                <a class="delete" href="controller/deleteTailor.php?id=<?php echo $row["tailorID"]; ?>" onclick="return confirm('Are you sure you want to delete the tailor?')">Delete</a></td>
                            </div>
                        </li>
                    </div>
                </div>
            <?php $i++; ?>
            <?php } ?>
        </ul>
    </div>

<style>
    .logo {
        padding-left: 3rem;
    }

</style>
        <script src="js\popUpVideo.js"></script>
        <script src="js\searchAdmin.js"></script>
</body>
</html>