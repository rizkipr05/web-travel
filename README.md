# Safa Marwa - Travel & Tour Booking Portal

Safa Marwa adalah platform pemesanan paket wisata (tour) yang modern, dirancang untuk memberikan pengalaman pengguna yang mulus dalam mencari dan memesan perjalanan impian mereka. Aplikasi ini dilengkapi dengan sistem manajemen admin yang komprehensif dan integrasi pembayaran otomatis.

## 🚀 Fitur Utama

### Pengguna (Pelanggan)
- **Pencarian Paket Wisata**: Mencari paket wisata berdasarkan kata kunci.
- **Detail Paket**: Informasi lengkap mengenai rute, harga, dan jadwal.
- **Sistem Reservasi**: Alur pemesanan yang mudah untuk paket wisata pilihan.
- **Pembayaran Digital**: Integrasi dengan Midtrans untuk pembayaran aman.
- **Manajemen Profil & Pesanan**: Melacak riwayat pemesanan dan mengelola data diri.
- **Tiket Digital**: Akses tiket setelah pembayaran dikonfirmasi.

### Admin
- **Dashboard**: Ringkasan data operasional.
- **Manajemen Paket Wisata**: CRUD (Create, Read, Update, Delete) paket tour.
- **Manajemen Jadwal**: Mengelola tanggal keberangkatan dan ketersediaan.
- **Manajemen Pesanan**: Memantau status pembayaran dan mengelola reservasi pelanggan.
- **Akses Keamanan**: Autentikasi khusus admin.

## 🛠️ Tech Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Blade Templating, TailwindCSS, Vite
- **Database**: MySQL / SQLite
- **Payment Gateway**: Midtrans (Snap & Callback)

## 📋 Prasyarat

Sebelum memulai, pastikan Anda telah menginstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL atau MariaDB (opsional jika menggunakan SQLite)

## ⚙️ Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk setup projek di lingkungan lokal Anda:

1. **Clone Repositori**
   ```bash
   git clone <repository-url>
   cd safa-marwa-laravel
   ```

2. **Instal Dependensi PHP**
   ```bash
   composer install
   ```

3. **Instal Dependensi Frontend**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```

5. **Generate App Key**
   ```bash
   php artisan key:generate
   ```

6. **Konfigurasi Database**
   Buka file `.env` dan sesuaikan pengaturan database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

7. **Konfigurasi Midtrans (Penting)**
   Tambahkan API Key Midtrans Anda di file `.env`:
   ```env
   MIDTRANS_SERVER_KEY=your_server_key_here
   MIDTRANS_CLIENT_KEY=your_client_key_here
   MIDTRANS_IS_PRODUCTION=false
   ```

8. **Jalankan Migrasi & Seeder**
   ```bash
   php artisan migrate --seed
   ```

9. **Link Storage**
   ```bash
   php artisan storage:link
   ```

## 🏃 Cara Menjalankan

Jalankan server pengembangan Laravel:
```bash
php artisan serve
```

Di terminal terpisah, jalankan Vite untuk aset frontend:
```bash
npm run dev
```

Sekarang Anda dapat mengakses aplikasi di `http://127.0.0.1:8000`.

---
*Dibuat dengan ❤️ oleh Antigravity untuk Safa Marwa.*
