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

function uploadGambar($parameter) {
	$namaFile = $_FILES[$parameter]['name'];
	$ukuranFile = $_FILES[$parameter]['size'];
	$error = $_FILES[$parameter]['error'];
	$tmpName = $_FILES[$parameter]['tmp_name'];

	if( $error === 4 ) {
		echo "<script>
				alert('Pilih gambar terlebih dahulu!');
			</script>";
		return false;
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('Upload gambar dengan format jpg, jpeg, atau png!');
			</script>";
		return false;
	}

	if( $ukuranFile > 5 * 1024 * 1024 ) {
		echo "<script>
				alert('Ukuran gambar terlalu besar!, maksimal 5MB');
			</script>";
		return false;
	}

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	var_dump($namaFileBaru);

	move_uploaded_file($tmpName, '../img/' . $namaFileBaru);
	return $namaFileBaru;
}

function uploadVid($parameter) {
	$namaFile = $_FILES[$parameter]['name'];
	$ukuranFile = $_FILES[$parameter]['size'];
	$error = $_FILES[$parameter]['error'];
	$tmpName = $_FILES[$parameter]['tmp_name'];

	if( $error === 4 ) {
		echo "<script>
				alert('Pilih video terlebih dahulu!');
			</script>";
		return false;
	}

	$ekstensiVideoValid = ['mp4', 'mkv', 'avi'];
	$ekstensiVideo = explode('.', $namaFile);
	$ekstensiVideo = strtolower(end($ekstensiVideo));
	if( !in_array($ekstensiVideo, $ekstensiVideoValid) ) {
		echo "<script>
				alert('Upload video dengan format mp4, mkv, atau avi!');
			</script>";
		return false;
	}

	if( $ukuranFile > 10 * 1024 * 1024 ) {
		echo "<script>
				alert('Ukuran video terlalu besar!, maksimal 10MB');
			</script>";
		return false;
	}

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiVideo;
	var_dump($namaFileBaru);

	move_uploaded_file($tmpName, '../vid/' . $namaFileBaru);
	return $namaFileBaru;
}

function deleteReview($id) {
	global $conn;

	mysqli_query($conn, "delete from review where reviewID = $id");
	return mysqli_affected_rows($conn);
}

function addReview($data) {
    global $conn;

    $id = $data["id"];
    $ulasan = htmlspecialchars($data["ulasan"]);
    $foto = 'foto_ulasan';
    $foto_ulasan = uploadGambar($foto);
    $video = 'video_ulasan';
    $video_ulasan = uploadVid($video);

    if (!$foto_ulasan || !$video_ulasan) {
        return false;
    }

    $query = "insert into review (penjahitID, ulasan, foto_ulasan, video_ulasan) values ('$id', '$ulasan', '$foto_ulasan', '$video_ulasan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateReview($data) {
    global $conn;

    $id = $data["id"];
    $penjahitID = $data["penjahitID"];
    $ulasan = htmlspecialchars($data["ulasan"]);
	$oldFoto = htmlspecialchars($data["oldFoto"]);
	$oldVideo = htmlspecialchars($data["oldVideo"]);

    if ($_FILES['foto_ulasan']['error'] === 4) {
        $foto_ulasan = $oldFoto;
    } else {
        $foto = 'foto_ulasan';
        $foto_ulasan = uploadGambar($foto);

        if ($foto_ulasan === false) {
            return false;
        }
    }

	if ($_FILES['video_ulasan']['error'] === 4) {
        $video_ulasan = $oldVideo;
    } else {
        $video = 'video_ulasan';
        $video_ulasan = uploadVid($video);

        if ($video_ulasan === false) {
            return false;
        }
    }

    $query = "UPDATE review SET penjahitID = '$penjahitID', ulasan = '$ulasan', foto_ulasan = '$foto_ulasan', video_ulasan = '$video_ulasan' WHERE reviewID = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

?>