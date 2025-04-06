<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Tampilkan dashboard berdasarkan role
if ($_SESSION["role"] === 'admin') {
    echo "<h2>Selamat datang, Admin!</h2>";
    echo "<p>Anda memiliki akses penuh ke sistem.</p>";
    // Tambahkan fitur admin di sini, misalnya:
    echo "<ul>
            <li><a href='manage_users.php'>Kelola Pengguna</a></li>
            <li><a href='view_reports.php'>Lihat Laporan</a></li>
          </ul>";
} else {
    echo "<h2>Selamat datang, User!</h2>";
    echo "<p>Anda memiliki akses terbatas.</p>";
    // Tambahkan fitur user di sini, misalnya:
    echo "<ul>
            <li><a href='view_profile.php'>Lihat Profil</a></li>
          </ul>";
}

// logout
echo "<a href='logout.php'>Logout</a>";
?>