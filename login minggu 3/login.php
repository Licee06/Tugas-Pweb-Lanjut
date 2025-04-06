<?php
session_start();
include "koneksi.php";

// Cek apakah cookie ada
$username = isset($_COOKIE["username"]) ? $_COOKIE["username"] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $remember = isset($_POST["remember"]); // Cek apakah checkbox di-check

  $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user["password"])) {
      $_SESSION["user_id"] = $user["id"]; // Simpan session
      $_SESSION["role"] = $user["role"]; // Simpan role

      // Jika "Remember Me" dicentang, set cookie
      if ($remember) {
        // Set cookie untuk 30 hari
        setcookie("username", $username, time() + (30 * 24 * 60 * 60), "/"); // 30 hari
        setcookie("role", $user["role"], time() + (30 * 24 * 60 * 60), "/"); // 30 hari
      } else {
        // Hapus cookie jika tidak dicentang
        if (isset($_COOKIE["username"])) {
          setcookie("username", "", time() - 3600, "/");
        }
        if (isset($_COOKIE["role"])) {
          setcookie("role", "", time() - 3600, "/");
        }
      }

      header("Location: dashboard.php");
      exit();
    } else {
      echo "Password salah!";
    }
  } else {
    echo "Username tidak ditemukan!";
  }

  $stmt->close();
  $conn->close();
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<form method="POST">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" name="username" class="form-control" id="username"
      value="<?php echo htmlspecialchars($username); ?>" required>
  </div>
  <div class="mb-4">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password" required>
  </div>
  <div class="mb-3">
    <input type="checkbox" name="remember" id="remember" <?php echo isset($_COOKIE["username"]) ? 'checked' : ''; ?>>
    <label for="remember" class="form-label">Remember Me</label>
  </div>
  <button type="submit" class="btn btn-success">Login</button>
</form>