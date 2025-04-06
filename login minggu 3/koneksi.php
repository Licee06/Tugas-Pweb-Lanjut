<?php
//membuat koneksi ke database mysql
$conn = mysqli_connect('localhost', 'root', '', 'test');

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>