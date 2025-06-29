<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
require __DIR__ . '/../db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form Pemesanan</title>
</head>
<body>
  <h2>Form Pemesanan Barang</h2>
  <form id="orderForm">
    <label>Nama Barang:<br><input type="text" name="nama_barang" required></label><br>
    <label>Berat (gram):<br><input type="number" name="berat" required></label><br>
    <label>Provinsi Tujuan:<br><select name="provinsi" id="provinsi"></select></label><br>
    <label>Kota Tujuan:<br><select name="kota" id="kota"></select></label><br>
    <button type="submit">Hitung Ongkir & Bayar</button>
  </form>

  <script>
    const prov = document.getElementById('provinsi');
    const kota = document.getElementById('kota');

    // Fetch provinces
    fetch('../api/get_provinces.php')
      .then(res => res.json())
      .then(j => {
        prov.innerHTML = '<option value="">--Pilih Provinsi--</option>';
        j.rajaongkir.results.forEach(p => {
          const o = document.createElement('option');
          o.value = p.province_id;
          o.textContent = p.province;
          prov.appendChild(o);
        });
      });

    // Fetch cities
    prov.addEventListener('change', () => {
      fetch(`../api/get_cities.php?province_id=${prov.value}`)
        .then(res => res.json())
        .then(j => {
          kota.innerHTML = '<option value="">--Pilih Kota--</option>';
          j.rajaongkir.results.forEach(c => {
            const o = document.createElement('option');
            o.value = c.city_id;
            o.textContent = c.city_name;
            kota.appendChild(o);
          });
        });
    });

    // Handle form submission as JSON request
    document.getElementById('orderForm').addEventListener('submit', async e => {
      e.preventDefault();
      const form = e.target;
      const data = new FormData(form);
      const resp = await fetch('../checkout.php', {
        method: 'POST',
        body: data
      });
      const { token } = await resp.json();
      // Jika menggunakan Midtrans Snap
      window.snap.pay(token);
    });
  </script>
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= MIDTRANS_CLIENT_KEY ?>"></script>
</body>
</html>