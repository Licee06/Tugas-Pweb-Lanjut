<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "pics/";
    $file_name = uniqid() . "_" . time(); // Ubah nama file
    $target_file = $target_dir . basename($file_name);
    $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));

    // Validasi ukuran file
    if ($_FILES["gambar"]["size"] > 1 * 1024 * 1024) { // max 1MB
        echo "Ukuran file terlalu besar.";
        exit;
    }

    // Validasi tipe file
    $allowed = ['jpg', 'jpeg', 'png'];
    if (!in_array($imageFileType, $allowed)) {
        echo "Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
        exit;
    }

    // Upload file
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Resize dan simpan thumbnail
        if ($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
            $src = imagecreatefromjpeg($target_file);
        } elseif ($imageFileType == 'png') {
            $src = imagecreatefrompng($target_file);
        } else {
            echo "Tipe file tidak didukung.";
            exit;
        }

        $width = imagesx($src);
        $height = imagesy($src);
        $new_width = 150; // Ukuran thumbnail
        $new_height = floor($height * ($new_width / $width));
        $thumbpath = "pics/thumbs/" . basename($file_name) . ".jpg"; // Simpan thumbnail sebagai JPG
        $tmp = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($tmp, $thumbpath, 80); // Simpan thumbnail

        // Simpan ke database
        $sql = "INSERT INTO gambar (filename, filepath, thumbpath, width, height) VALUES ('$file_name', '$target_file', '$thumbpath', $width, $height)";
        if ($conn->query($sql) === TRUE) {
            echo "File berhasil diupload.";
        } else {
            echo "Gagal menyimpan ke database: " . $conn->error;
        }
    } else {
        echo "Gagal mengupload file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Gambar Profil</title>
</head>
<body>
    <h2>Upload Gambar Profil</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Pilih gambar yang ingin diupload:
        <input type="file" name="gambar" required>
        <input type="submit" name="upload" value="Upload">
    </form>
</body>
</html>