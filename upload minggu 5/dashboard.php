<?php
include 'koneksi.php';

// Hapus gambar jika tombol hapus ditekan
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "SELECT * FROM gambar WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Hapus file dari server
        unlink($row['filepath']);
        unlink($row['thumbpath']);
        // Hapus dari database
        $conn->query("DELETE FROM gambar WHERE id = $id");
    }
}

$sql = "SELECT * FROM gambar";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Galeri Gambar</h2>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<img src='" . $row['thumbpath'] . "' class='card-img-top' alt='Thumbnail'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row['filename'] . "</h5>";
                    echo "<a href='" . $row['filepath'] . "' class='btn btn-primary' target='_blank'>Lihat Asli</a>";
                    echo "<a href='dashboard.php?delete=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus gambar ini?\")'>Hapus</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Belum ada gambar yang diupload.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>