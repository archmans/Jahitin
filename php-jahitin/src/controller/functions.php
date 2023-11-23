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

function deleteTailor($id) {
	global $conn;

	mysqli_query($conn, "delete from tailor where tailorID = $id");
	return mysqli_affected_rows($conn);
}

function uploadGambar($parameter) {
	$namaFile = $_FILES[$parameter]['name'];
    $ukuranFile = $_FILES[$parameter]['size'];
    $error = $_FILES[$parameter]['error'];
    $tmpName = $_FILES[$parameter]['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Upload gambar dengan format jpg, jpeg, atau png!');
            </script>";
        return false;
    }

    if ($ukuranFile > 5 * 1024 * 1024) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!, maksimal 5MB');
            </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    $path = '../img/' . $namaFileBaru;

    move_uploaded_file($tmpName, $path);

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


function addTailor($data) {
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$alamat = htmlspecialchars($data["alamat"]);
    $jenis = htmlspecialchars($data["jenis"]);

	$foto = 'foto_tailor';
	$foto_tailor = uploadGambar($foto);
	if( !$foto_tailor ) {
		return false;
	}

	$video = 'video_tailor';
	$video_tailor = uploadVid($video);
	if( !$video_tailor ) {
		return false;
	}

	$sql = "INSERT INTO tailor (nama, alamat, jenis, foto_tailor, video_tailor)
			VALUES ('$nama', '$alamat', '$jenis', '$foto_tailor', '$video_tailor')";

	mysqli_query($conn, $sql);
	return mysqli_affected_rows($conn);
}


function updateTailor($data) {
	global $conn;

	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$alamat = htmlspecialchars($data["alamat"]);
    $jenis = htmlspecialchars($data["jenis"]);
	$oldFoto = htmlspecialchars($data["oldFoto"]);
	$oldVideo = htmlspecialchars($data["oldVideo"]);

    if ($_FILES['foto_tailor']['error'] === 4) {
        $foto_tailor = $oldFoto;
    } else {
        $foto = 'foto_tailor';
        $foto_tailor = uploadGambar($foto);

        if ($foto_tailor === false) {
            return false;
        }
    }

    if ($_FILES['video_tailor']['error'] === 4) {
        $video_tailor = $oldVideo;
    } else {
        $video = 'video_tailor';
        $video_tailor = uploadVid($video);

        if ($video_tailor === false) {
            return false;
        }
    }

	$sql = "UPDATE tailor SET
                nama = '$nama',
                alamat = '$alamat',
                jenis = '$jenis',
                foto_tailor = '$foto_tailor',
                video_tailor = '$video_tailor'
			WHERE
				tailorID = $id
			";

	mysqli_query($conn, $sql);
	return mysqli_affected_rows($conn);
}