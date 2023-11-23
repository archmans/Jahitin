<?php 
// get data from rest api
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://rest-app:4000/tailor');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
$tailor = json_decode($result, true);
include 'controller/functions.php';
$tailor2 = $tailor["data"];
?>
<div class="premium-tailor-list" id="search-results-list">
    <?php $i = 1; ?>
    <?php foreach( $tailor2 as $row ) { ?>
        <div class="premium-tailor" >
            <h4 class="tailor-name"><?= $row["username"]; ?></h4>
            <a class="button-see-gallery" href="galleryPage.php?id=<?php echo $row["id"]; ?>">See Gallery</a>
        </div>
        <?php $i++; ?>
    <?php } ?>
</div>
