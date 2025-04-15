<?php
session_start();

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <script>
        function validateForm() {
            const username = document.forms["registrationForm"]["username"].value;
            const email = document.forms["registrationForm"]["email"].value;
            const password = document.forms["registrationForm"]["password"].value;

            if (username == "" || email == "" || password == "") {
                alert("All fields must be filled out");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h2>Form Pendaftaran</h2>
    <form name="registrationForm" method="post" action="registration.php" onsubmit="return validateForm();">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="submit" value="Daftar">
    </form>
</body>
</html>