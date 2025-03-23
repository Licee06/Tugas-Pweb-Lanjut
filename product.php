<?php
include 'config.php';
$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>

<head>
  <title>CRUD PHP MySQL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
  <h2>Daftar Produk</h2>
  <button type="button" class="btn btn-success" onclick="window.location.href='createproduct.php'">Tambah produk</button>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nama</th>
        <th scope="col">Harga</th>
        <th scope="col">Stok</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tbody>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['nama_produk'] ?></td>
          <td><?= $row['harga'] ?></td>
          <td><?= $row['stok'] ?></td>
          <td>
            <a href="editproduct.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="hapusproduct.php?id=<?= $row['id'] ?>" onclick="return
            confirm('Hapus data?')">Hapus</a>
          </td>
        </tr>
      </tbody>
    <?php endwhile; ?>
  </table>
</body>

</html>