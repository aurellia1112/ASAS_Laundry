# 🧺 ASAS Laundry (Laundry Aurel)

Aplikasi Web Manajemen dan Pemesanan Laundry Berbasis **Laravel 12** dan **Tailwind CSS**. Sistem ini dirancang untuk mempermudah pelanggan dalam melakukan pemesanan layanan laundry secara online serta mempermudah admin dalam mengelola paket layanan dan antrean pesanan.

---

## 🌟 Fitur Utama

### 1. 👥 Pelanggan (Customer)
- **Katalog Layanan**: Menampilkan daftar paket laundry (kiloan, satuan, reguler, express, superkilat) lengkap dengan harga dan foto layanan.
- **Pemesanan Fleksibel**: Pelanggan dapat memilih beberapa paket layanan sekaligus dengan menentukan jumlah (Kg / Pcs).
- **Kalkulasi Otomatis & Modal Konfirmasi**: Rincian pesanan dan total biaya dihitung secara instan sebelum checkout.
- **Validasi Data**: Memastikan nama dan nomor WhatsApp terisi valid sebelum pesanan dikirim.

### 2. 🛡️ Administrator
- **Dashboard Rekap & Statistik**: Pemantauan jumlah total transaksi, pesanan berstatus **Proses**, dan **Selesai**.
- **Antrean Pesanan**: Tabel antrean pesanan masuk lengkap dengan tanggal, identitas pelanggan, detail layanan, dan total tagihan.
- **Update Status Pesanan**: Kemudahan mengubah status pesanan dari *Proses* menjadi *Selesai* secara langsung.
- **Kelola Layanan (CRUD Services)**:
  - Tambah paket layanan baru lengkap dengan foto, kategori, jenis satuan (Kg/Pcs), dan deskripsi.
  - Ubah informasi atau harga paket layanan.
  - Hapus paket layanan yang sudah tidak aktif (otomatis membersihkan file foto terkait).

### 3. 🔐 Autentikasi & Multi-Role
- Sistem login & register menggunakan Laravel Breeze.
- Pembagian hak akses terproteksi (**Admin** vs **Pelanggan**).
- User biasa yang mencoba mengakses dashboard admin akan diarahkan ke halaman pemesanan dengan proteksi role.

---

## 🔑 Akun Default (Seeder)

Setelah menjalankan database seeder, Anda dapat langsung login menggunakan akun Administrator berikut:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@gmail.com` | `password123` |

---

## 🚀 Panduan Instalasi & Menjalankan Proyek

### 1. Prasyarat
- **PHP** >= 8.3 (dengan ekstensi `pdo_sqlite`, `mbstring`, `fileinfo`)
- **Composer** >= 2.x
- **Node.js & NPM** (untuk build Tailwind CSS & assets)

### 2. Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/aurellia1112/ASAS_Laundry.git
cd ASAS_Laundry

# 2. Install dependensi PHP
composer install

# 3. Buat file .env dan generate application key
cp .env.example .env
php artisan key:generate

# 4. Jalankan migrasi dan isi data awal (seeder)
php artisan migrate --seed

# 5. Buat symlink storage untuk upload foto layanan
php artisan storage:link

# 6. Install dependensi JavaScript dan build assets
npm install
npm run build

# 7. Jalankan local server
php artisan serve
```

Aplikasi dapat diakses melalui browser di: `http://localhost:8000`

---

## 🧪 Pengujian Otomatis (Automated Testing)

Proyek ini telah dilengkapi dengan rangkaian Feature Test dan Unit Test yang mencakup:
- Alur pemesanan pelanggan & validasi checkout.
- Proteksi akses & hak akses dashboard admin.
- Operasi CRUD Layanan laundry beserta upload/delete gambar.
- Autentikasi login, register, update profile, dan password.

Untuk menjalankan seluruh tes:

```bash
php artisan test
```

*Semua 41 tes berjalan sukses (100% Passed).*

---

## 🛠️ Tech Stack
- **Framework**: [Laravel 12](https://laravel.com)
- **Bahasa**: PHP 8.5
- **Styling**: [Tailwind CSS](https://tailwindcss.com)
- **Database**: SQLite (dapat diganti ke MySQL di `.env`)
- **Template Engine**: Blade Components
- **Bundler**: Vite
