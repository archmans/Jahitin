<?php
include '../controller/functions.php';

if (isset($_GET["data"])) {
    $username = $_GET["data"];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(array("isAvailable" => false));
    } else {
        echo json_encode(array("isAvailable" => true));
    }
}
?>
