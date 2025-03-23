<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $passw = password_hash($_POST['passw'], PASSWORD_DEFAULT); // Hash password

  if ($conn->query("INSERT INTO users (name, email, passw) VALUES ('$name', '$email', '$passw')")) {
    header(header: "Location: index.php");
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
  <h2>Tambah Pengguna</h2>
  <form method="POST">
    <div class="row mb-3">
      <label for="inputEmail3" class="col-sm-1 col-form-label">Nama</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="inputEmail3" required>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputEmail3" class="col-sm-1 col-form-label">Email</label>
      <div class="col-sm-2">
        <input type="email" class="form-control" id="inputEmail3" required>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-1 col-form-label">Password</label>
      <div class="col-sm-2">
        <input type="password" class="form-control" id="inputPassword3" required>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</body>

</html>