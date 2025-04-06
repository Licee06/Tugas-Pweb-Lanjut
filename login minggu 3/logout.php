<?php
session_start();
session_unset(); // Menghapus semua session
session_destroy(); // Menghancurkan session

// Hapus cookie jika ada
if (isset($_COOKIE["username"])) {
    setcookie("username", "", time() - 3600, "/");
}
if (isset($_COOKIE["role"])) {
    setcookie("role", "", time() - 3600, "/");
}

// Redirect ke halaman login
header("Location: login.php");
exit();
?>