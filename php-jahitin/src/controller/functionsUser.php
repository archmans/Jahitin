<?php
include 'config.php';

function query($sql) {
	global $conn;
	$result = mysqli_query($conn, $sql);

	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}

function updateProfil($data) {
	global $conn;

	$id = $data["id"];
	$email = htmlspecialchars($data["email"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);


	$sql = "UPDATE users SET
                email = '$email',
                username = '$username',
                password = '$password'
			WHERE
				id = $id
			";

	mysqli_query($conn, $sql);
	return mysqli_affected_rows($conn);
}

function deleteUser($id) {
	global $conn;
	if ($id == $_SESSION["id"]) {
		return false;
	}
	mysqli_query($conn, "DELETE FROM users WHERE id = $id");
	return mysqli_affected_rows($conn);
}
?>