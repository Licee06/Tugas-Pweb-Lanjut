<?php
include 'config.php';
$id = (int) $_GET['id']; // Casting to int for security
$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $passw = password_hash($_POST['passw'], PASSWORD_DEFAULT); // Hash password

  if ($conn->query("UPDATE users SET name='$name', email='$email', passw='$passw' WHERE id=$id")) {
    header("Location: index.php");
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
  <h2>Edit Pengguna</h2>
  <form method="POST">
    Nama: <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>
    Password: <input type="password" name="passw" required><br>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</body>

</html>