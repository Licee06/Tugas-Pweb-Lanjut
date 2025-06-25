<?php
session_start();
require_once 'db.php';

$errors = [];
$ip = $_SERVER['REMOTE_ADDR'];
$pdo = getPDO();

// Rate limiting
$stmt = $pdo->prepare(
  "SELECT COUNT(*) AS cnt
     FROM login_attempts
    WHERE ip_address = :ip
      AND attempt_time > (NOW() - INTERVAL :minutes MINUTE)"
);
$stmt->execute([
  'ip'      => $ip,
  'minutes'=> LOGIN_TIMEOUT_MINUTES
]);
$cnt = (int)$stmt->fetchColumn();

if ($cnt >= MAX_LOGIN_ATTEMPTS) {
    $errors[] = "Terlalu banyak percobaan. Coba lagi setelah " . LOGIN_TIMEOUT_MINUTES . " menit.";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';
    if (!$u || !$p) {
        $errors[] = 'Username & password wajib diisi.';
    } else {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->execute([$u]);
        $row = $stmt->fetch();
        if ($row && password_verify($p, $row['password'])) {
            $del = $pdo->prepare("DELETE FROM login_attempts WHERE ip_address = ?");
            $del->execute([$ip]);
            $_SESSION['user'] = $u;
            header('Location: dashboard.php');
            exit;
        } else {
            $ins = $pdo->prepare("INSERT INTO login_attempts (ip_address, attempt_time) VALUES (?, NOW())");
            $ins->execute([$ip]);
            $errors[] = 'Username atau password salah.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Keamanan Lanjutan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Login</h3>
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
              <button type="submit" class="btn btn-success w-100">Login</button>
            </form>
            <p class="text-center mt-3">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
