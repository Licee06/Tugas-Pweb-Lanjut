<?php
// config.php
// Sesuaikan dengan setting MySQL Anda
define('DB_HOST', 'localhost');
define('DB_NAME', 'securitypwlminggu11');
define('DB_USER', 'root');
define('DB_PASS', '');

// Rate limiting
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_TIMEOUT_MINUTES', 2);
