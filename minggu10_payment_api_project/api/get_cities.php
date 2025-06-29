<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
require __DIR__ . '/../db.php';

$province_id = $_GET['province_id'] ?? '';
if (!$province_id) {
    http_response_code(400);
    echo json_encode(['error' => 'province_id required']);
    exit;
}

header('Content-Type: application/json');

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL            => RAJAONGKIR_BASE_URL . "city?province=$province_id",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ['key: ' . RAJAONGKIR_API_KEY],
]);
echo curl_exec($curl);
curl_close($curl);
?>