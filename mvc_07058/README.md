
# Program Sederhana CRUD Mahasiswa Menggunakan Pola MVC

## 1. Penjelasan Flow Program (Alur Kerja Model-View-Controller)

- `index.php` berperan sebagai entry point aplikasi yang menerima semua request dari user.
- Berdasarkan parameter **action** pada URL, `index.php` memanggil method yang sesuai di **MahasiswaController**.
- **Controller (MahasiswaController.php)** bertugas mengendalikan alur aplikasi, memanggil Model untuk operasi data, dan memilih View yang akan ditampilkan.
- **Model (Mahasiswa.php)** bertanggung jawab melakukan query ke database dan memanipulasi data.
- Setelah Model selesai, Controller meneruskan data ke **View** (file PHP di folder `views/`) untuk diproses dan ditampilkan ke user.
- User berinteraksi melalui halaman View (misal: tambah, edit, hapus data).
- Request user diterima kembali di `index.php` dan siklus ini berulang sesuai action yang diminta.

## 2. Struktur Folder Proyek

<p align="left">
  <img src="images/WhatsApp Image 2025-05-16 at 7.15.55 PM.jpeg" width="20%">
</p>
