<?php
session_start();

// Validate CSRF token
if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die("CSRF token validation failed.");
}

// Filter input
$username = htmlspecialchars(trim($_POST['username']));
$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));

// Database connection
$conn = new mysqli("localhost", "root", "", "validasi-minggu4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare statement to prevent SQL Injection
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt->bind_param("sss", $username, $email, $hashed_password);

// Execute statement
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>