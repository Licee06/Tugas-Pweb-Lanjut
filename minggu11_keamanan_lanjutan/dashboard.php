<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Keamanan Lanjutan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Keamanan Lanjutan</a>
      <div class="d-flex">
        <span class="navbar-text text-white me-3">
          <?php echo htmlspecialchars($_SESSION['user']); ?>
        </span>
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
      </div>
    </div>
  </nav>
  <div class="container mt-5">
    <div class="alert alert-success text-center">
      Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>!
    </div>
    <p class="text-center">Ini adalah halaman dashboard.</p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>