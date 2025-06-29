<IfModule mod_rewrite.c>
  RewriteEngine Off
</IfModule>


// =========================
// 3. config.php (project root)
// =========================
<?php
require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

Dotenv::createImmutable(__DIR__)->load();

// Database
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASS', $_ENV['DB_PASS']);

// Midtrans
define('MIDTRANS_SERVER_KEY', $_ENV['MIDTRANS_SERVER_KEY']);
define('MIDTRANS_CLIENT_KEY', $_ENV['MIDTRANS_CLIENT_KEY']);

// RajaOngkir
define('RAJAONGKIR_API_KEY',   $_ENV['RAJAONGKIR_API_KEY']);
define('RAJAONGKIR_BASE_URL',  rtrim($_ENV['RAJAONGKIR_BASE_URL'], '/') . '/');

// Rate limiting
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_TIMEOUT_MINUTES', 2);
?>