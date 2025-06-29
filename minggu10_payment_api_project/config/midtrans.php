<?php
// Autoload composer, load .env config dan koneksi DB
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
require __DIR__ . '/../db.php';

// Konfigurasi Midtrans
define("MIDTRANS_SERVER_KEY", "Mid-server-oeTVl5U5At_aijoJWbl3Yfp4");
define("MIDTRANS_CLIENT_KEY", "Mid-client-NeF3OrL1dwv9Lw9Z");
?>