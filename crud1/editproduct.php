<?php
include 'config.php';
$id = (int) $_GET['id']; // Casting to int for security
$produk = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $conn->real_escape_string($_POST['nama_produk']);
  $harga = $conn->real_escape_string($_POST['harga']);
  $stok = $conn->real_escape_string($_POST['stok']);

  if ($conn->query("UPDATE products SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id=$id")) {
    header("Location: product.php");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
  <h2>Edit Produk</h2>
  <form method="POST">
    <div class="row mb-3">
      <label for="inputEmail3" class="col-sm-1 col-form-label">Nama</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']) ?>"required>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputEmail3" class="col-sm-1 col-form-label">Harga</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($produk['harga']) ?>"required>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-1 col-form-label">Stok</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="stok" name="stok" value="<?= htmlspecialchars($produk['stok']) ?>"required>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</body>

</html>