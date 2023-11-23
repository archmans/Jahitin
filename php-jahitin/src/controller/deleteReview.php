<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: loginPage.php");
    exit;
}
include 'functionsReview.php';
$reviewID = $_GET["id"];
$penjahit = query("select * from review where reviewID = $reviewID")[0];
$penjahitID = $penjahit["penjahitID"];

if( deleteReview($reviewID) > 0 ) {
	echo "<script>
			alert('data berhasil dihapus!');
			document.location.href = '../reviewPage.php?id=$penjahitID';
		</script>";
} else {
	echo "<script>
			alert('data gagal dihapus!');
			document.location.href = '../reviewPage.php?id=$penjahitID';
		</script>";
}
?>