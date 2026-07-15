# Restoran Burger FJ — studi kasus website pemesanan menu restoran.

 web pemesanan menu restoran berbasis **Laravel**, website ini memiliki Home page publik yang menampilkan profil restoran & menu unggulan, serta memungkinkan **pelanggan** untuk mendaftar, memesan menu, mengunggah bukti pembayaran, dan melihat pengumuman — sementara **admin** dapat memverifikasi pendaftaran akun, pesanan, pembayaran, serta mengelola menu dan pengumuman.
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
- CRUD data menu makanan (termasuk menandai menu sebagai "Unggulan" untuk ditampilkan di Home page)
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
- Web server (bawaan `php artisan serve`)

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

## Instalasi

### 1. Clone repository
```bash
git clone https://github.com/Femmy29/lsp_femmy.git
cd lsp_femmy
```

### 2. Install dependency PHP
```bash
composer install
```

### 3. Salin file environment
```bash
cp .env.example .env
```

### 4. Konfigurasi database
Buka file `.env`, sesuaikan bagian berikut dengan konfigurasi MySQL Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=menu_restoran
DB_USERNAME=root
DB_PASSWORD=
```
Pastikan Anda sudah membuat database kosong dengan nama `menu_restoran` (atau sesuai nama yang Anda tentukan) di MySQL.

### 5. Generate application key
```bash
php artisan key:generate
```

### 6. Jalankan migration
```bash
php artisan migrate
```

### 7. Buat akun admin (seeder)
```bash
php artisan db:seed --class=AdminSeeder
```

### 8. Buat symbolic link untuk storage (upload gambar)
```bash
php artisan storage:link
```

### 9. Siapkan gambar untuk landing page
Taruh gambar berikut di folder `public/images/`:
- `hero-bg.jpg` — foto latar untuk hero section landing page

### 10. Jalankan aplikasi
```bash
php artisan serve
```

Aplikasi dapat diakses di `http://127.0.0.1:8000`.

---

## Akun untuk Demo/Testing

| Role | Email | Password |
|---|---|---|
| Admin | admin@restoran.com | admin12345 |
| Pelanggan | *(daftar mandiri lewat halaman /register)* | - |


## Alur Penggunaan

1. Pelanggan mendaftar akun lewat halaman **Register**
2. Status akun berada di **"Menunggu Verifikasi"**
3. Admin login dan memverifikasi (menerima) akun tersebut di menu **Verifikasi Akun**
4. Pelanggan login kembali dan dapat mengakses halaman **Menu**
5. Pelanggan memilih menu dan jumlahnya, lalu melakukan pemesanan
6. Admin memverifikasi pesanan di menu **Verifikasi Pesanan** (terima/tolak)
7. Jika diterima, pelanggan mengunggah bukti pembayaran di halaman **Pesanan Saya**
8. Admin memverifikasi bukti pembayaran di menu **Verifikasi Pembayaran**
9. Setelah pembayaran diterima, status pesanan otomatis menjadi **Selesai**
10. Admin juga dapat mengelola **Pengumuman** yang dapat dilihat oleh seluruh pelanggan
>
