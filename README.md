# 🍽️ Restoran Burger FJ — Aplikasi Pemesanan Menu Restoran

Aplikasi web pemesanan menu restoran berbasis **Laravel**, aplikasi ini memiliki Home page publik yang menampilkan profil restoran & menu unggulan, serta memungkinkan **pelanggan** untuk mendaftar, memesan menu, mengunggah bukti pembayaran, dan melihat pengumuman, sementara **admin** dapat memverifikasi pendaftaran akun, pesanan, pembayaran, serta mengelola menu dan pengumuman.

---

## Fitur Utama

### Halaman Publik (Tanpa Login)
- Home page dengan hero section profil restoran
- Menampilkan menu unggulan/rekomendasi
- Akses ke halaman Login & Registrasi

### Pelanggan
- Registrasi akun baru
- Melihat status verifikasi akun (menunggu / diterima / ditolak)
- Login & logout
- Melihat daftar menu makanan yang tersedia
- Melakukan pemesanan menu (multi-item dalam satu pesanan)
- Melihat status pesanan (menunggu / diterima / ditolak / selesai)
- Mengunggah bukti pembayaran
- Melihat pengumuman dari restoran

### Admin
- Login & logout
- Memverifikasi pendaftaran akun pelanggan (terima/tolak)
- Memverifikasi pesanan pelanggan (terima/tolak beserta catatan alasan)
- Memverifikasi bukti pembayaran (terima/tolak)
- CRUD data menu makanan (termasuk menandai menu sebagai "Unggulan" untuk ditampilkan di landing page)
- CRUD pengumuman (dengan dukungan gambar dan link video)

---

## Teknologi yang Digunakan

| Kategori | Teknologi |
|---|---|
| Backend Framework | Laravel 9.52 |
| Bahasa Pemrograman | PHP 8.0 |
| Database | MySQL |
| Frontend Framework | Bootstrap 5.3 |
| Template Engine | Blade (bawaan Laravel) |

---

## Spesifikasi Sistem

Sebelum instalasi, pastikan environment berikut sudah terpasang:

- PHP >= 8.0
- Composer
- MySQL / MariaDB
- Node.js & NPM (opsional, jika ingin compile asset)
- Web server (bawaan `php artisan serve`, atau Apache/Nginx)

---

## Struktur Database

Aplikasi ini menggunakan 6 tabel utama:

| Tabel | Keterangan |
|---|---|
| `users` | Menyimpan data admin & pelanggan (kolom `role`: admin/customer), termasuk `status` verifikasi pendaftaran (pending/accepted/rejected), nomor telepon, dan alamat |
| `menus` | Menyimpan data menu makanan/minuman (nama, harga, kategori, gambar, ketersediaan, status unggulan) |
| `orders` | Menyimpan data pesanan pelanggan beserta status verifikasinya (pending/diterima/ditolak/selesai) |
| `order_items` | Menyimpan detail item per pesanan (menu + jumlah + subtotal) |
| `payments` | Menyimpan bukti pembayaran per pesanan beserta status verifikasinya |
| `announcements` | Menyimpan data pengumuman restoran (judul, isi, gambar, link video) |

---

