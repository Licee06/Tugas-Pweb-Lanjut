<?php

// Autoload composer, load .env config dan koneksi DB
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
require __DIR__ . '/../db.php';

// Konfigurasi API Key RajaOngkir
define("RAJAONGKIR_API_KEY", "ZJ9ldi0lc0d96bcd25a137c5Oxqg5vOC");
define("RAJAONGKIR_BASE_URL", "https://api.rajaongkir.com/starter/");
?>