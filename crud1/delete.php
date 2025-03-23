<?php
include 'config.php';
$id = (int) $_GET['id']; // Casting to int for security
if ($conn->query("DELETE FROM users WHERE id=$id")) {
  header("Location: index.php");
  exit();
} else {
  echo "Error: " . $conn->error;
}
?>