<?php
include '../controller/functions.php';

$keyword = $_POST["keyword"];
$sort = $_POST["sort"];
$filter = $_POST["filter"];

$sql = "SELECT * FROM tailor WHERE 1=1 "; // "1=1" mempermudah penambahan kondisi

if (!empty($keyword)) {
    $sql .= "AND nama LIKE '%$keyword%' OR alamat LIKE '%$keyword%' ";
}

if (!empty($filter)) {
    $sql .= "AND jenis = '$filter' ";
}

if ($sort === "asc") {
    $sql .= "ORDER BY nama ASC ";
} elseif ($sort === "desc") {
    $sql .= "ORDER BY nama DESC ";
}

$countDataperPage = 1;
$countData = count(query($sql));
$pages = ceil($countData/$countDataperPage);
$activePage = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
$firstData = ($countDataperPage * $activePage) - $countDataperPage;

$tailorPerPage = query($sql . " LIMIT " . $firstData . ", " . $countDataperPage);

?>
<ul class="tailor-list">
    <?php $i = 1; ?>
    <?php foreach( $tailorPerPage as $row ) { ?>
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
                    <a class="delete" href="controller/deleteTailor.php?id=<?php echo $row["tailorID"]; ?>" onclick="return confirm('yakin?')">Delete</a></td>
                </div>
                </li>
            </div>
        </div>
    <?php $i++; ?>
    <?php } ?>
</ul>
<div class="pagination">
    <ul>
        <?php if ($activePage > 1) { ?>
            <li>
                <a href="#" onclick="searchTailorAdmin(<?php echo $activePage - 1; ?>); return false;">&laquo;</a>
            </li>
        <?php } ?>
        <?php for ($i = $activePage - 1; $i <= $activePage + 1; $i++) { ?>
            <?php if ($i >= 1 && $i <= $pages) { ?>
                <?php if ($i == $activePage) { ?>
                    <li class="active">
                        <a href="#" onclick="searchTailorAdmin(<?php echo $i; ?>); return false;"><?= $i; ?></a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="#" onclick="searchTailorAdmin(<?php echo $i; ?>); return false;"><?= $i; ?></a>
                    </li>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <?php if ($activePage < $pages) { ?>
            <li>
                <a href="#" onclick="searchTailorAdmin(<?php echo $activePage + 1; ?>); return false;">&raquo;</a>
            </li>
        <?php } ?>
    </ul>
</div>
