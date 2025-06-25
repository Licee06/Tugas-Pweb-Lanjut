<?php
session_start();
require_once 'db.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';
    if (!$u || !$p) {
        $errors[] = 'Username & password wajib diisi.';
    } else {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$u]);
        if ($stmt->fetch()) {
            $errors[] = 'Username sudah terdaftar.';
        } else {
            $hash = password_hash($p, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$u, $hash]);
            $_SESSION['user'] = $u;
            header('Location: dashboard.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar - Keamanan Lanjutan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Daftar Akun</h3>
            <?php if ($errors): ?>
              <div class="alert alert-danger">
                <?php foreach ($errors as $e) echo "<div>$e</div>"; ?>
              </div>
            <?php endif; ?>
            <form method="post">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
            <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>