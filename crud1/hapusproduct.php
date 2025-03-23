<?php
include 'config.php';
$id = (int) $_GET['id']; // Casting to int for security
if ($conn->query("DELETE FROM products WHERE id=$id")) {
  header("Location: product.php");
  exit();
} else {
  echo "Error: " . $conn->error;
}
?>