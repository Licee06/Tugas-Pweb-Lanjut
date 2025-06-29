<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
require __DIR__ . '/../db.php';

header('Content-Type: application/json');

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL            => RAJAONGKIR_BASE_URL . 'province',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ['key: ' . RAJAONGKIR_API_KEY],
]);
echo curl_exec($curl);
curl_close($curl);
?>
