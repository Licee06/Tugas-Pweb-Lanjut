<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';
require __DIR__ . '/db.php';

// Ambil data form
$nama   = $_POST['nama_barang'] ?? '';
$berat  = (int)($_POST['berat'] ?? 0);
$city   = $_POST['kota'] ?? '';

// Hitung ongkir via RajaOngkir cost API
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL            => RAJAONGKIR_BASE_URL . "cost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST           => true,
  CURLOPT_POSTFIELDS     => http_build_query([
    'origin'      => 501,
    'destination' => $city,
    'weight'      => $berat,
    'courier'     => 'jne'
  ]),
  CURLOPT_HTTPHEADER     => ['key: '.RAJAONGKIR_API_KEY],
]);
$cost = json_decode(curl_exec($curl), true);
curl_close($curl);

$ongkir = $cost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'] ?? 0;
$total  = $ongkir + 10000; // misal harga barang tetap 10k

// Konfigurasi Midtrans Snap
\Midtrans\Config::$serverKey = MIDTRANS_SERVER_KEY;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds       = true;

$transaction = [
  'transaction_details' => [
    'order_id'     => rand(100000,999999),
    'gross_amount' => $total
  ],
  'item_details' => [[
    'id'       => 'item1',
    'price'    => 10000,
    'quantity' => 1,
    'name'     => $nama
  ]],
  'customer_details' => []
];

header('Content-Type: application/json');
echo json_encode(['token' => \Midtrans\Snap::getSnapToken($transaction)]);
?>
