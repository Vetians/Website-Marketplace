<p align="center">
  <img src="public/assets/images/logo.png" alt="Preloved Ukrida Logo" width="180">
</p>

<h1 align="center">Preloved Ukrida</h1>

<p align="center">
  <b>Marketplace barang preloved khusus mahasiswa Universitas Kristen Krida Wacana</b><br>
  Jual beli barang bekas layak pakai dengan aman, murah, dan ramah lingkungan.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/CodeIgniter-4-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white" alt="CodeIgniter 4">
  <img src="https://img.shields.io/badge/MySQL-8-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5.3">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License MIT">
</p>

---

## 📖 Tentang Project

**Preloved Ukrida** adalah website marketplace yang dibuat untuk membantu mahasiswa UKRIDA membeli dan menjual barang preloved (bekas) berkualitas — mulai dari buku kuliah, elektronik, pakaian, aksesoris, hingga furniture. Website ini memiliki halaman publik untuk pengunjung dan panel administrator untuk mengelola seluruh konten secara mandiri.

Project ini dibangun menggunakan **CodeIgniter 4** dengan pola **MVC**, dilengkapi **REST API JSON**, sistem autentikasi berbasis session, serta tampilan responsif dengan **Bootstrap 5.3** yang mendukung **mode terang/gelap**.

---

## ✨ Fitur Utama

### 🌐 Halaman Publik
- 🏠 **Beranda** — hero section, carousel gambar, dan daftar produk terbaru yang dimuat secara dinamis via AJAX.
- 🛍️ **Marketplace Produk** — menampilkan produk aktif beserta kategori, harga, kondisi, dan stok.
- 🔎 **Pencarian Produk** — cari produk berdasarkan nama atau deskripsi melalui kolom search di navbar.
- 🏷️ **Filter Kategori** — jelajahi produk berdasarkan kategori (Buku Cetak, Elektronik, Pakaian, Aksesoris, Furniture).
- 📄 **Detail Produk** — halaman detail dengan deskripsi lengkap, harga, kondisi, dan rekomendasi produk lainnya.
- 📰 **Berita & Artikel** — daftar berita berstatus *publish* serta halaman detail berbasis slug.
- 🖼️ **Galeri Foto** — grid dokumentasi kegiatan dengan **modal lightbox** untuk melihat foto lebih besar.
- ℹ️ **Tentang Kami** — informasi visi, misi, dan nilai platform.
- ✉️ **Form Kontak** — validasi sisi server, pesan error/sukses, dan data tersimpan ke database.

### 🔐 Autentikasi & Keamanan
- Login dan registrasi akun administrator.
- Password disimpan menggunakan **`password_hash()`** dan diverifikasi dengan **`password_verify()`**.
- **Session-based authentication** dengan filter `AuthFilter` yang melindungi seluruh halaman administrator dan API admin.
- **CSRF protection** pada form kontak.
- Validasi input server-side (nama, email, subjek, pesan, produk, berita, dll).
- Validasi upload gambar: tipe `jpg/jpeg/png`, ukuran maksimal 2 MB.
- Proteksi agar admin tidak dapat menghapus akunnya sendiri yang sedang login.

### 🛠️ Panel Administrator
- 📊 **Dashboard** — statistik total produk, berita, pesan masuk, dan user.
- 📦 **Kelola Produk** — tambah, edit, hapus, upload gambar, atur kategori, harga, kondisi, stok, dan status.
- 🗂️ **Kelola Kategori** — tambah, edit, dan hapus kategori produk.
- 📰 **Kelola Berita** — CRUD berita dengan status *publish/draft*, slug otomatis, dan gambar.
- 🖼️ **Kelola Galeri** — tambah dan hapus foto dokumentasi.
- 📨 **Pesan Masuk** — lihat dan hapus pesan dari form kontak.
- 👥 **Kelola User** — daftar admin terdaftar dan hapus akun (kecuali akun sendiri).
- 📱 **Sidebar offcanvas responsif**, dropdown profil, dan tombol kembali ke website.

### 🎨 UI / UX
- Desain responsif untuk desktop, tablet, dan mobile.
- **Dark / Light mode** dengan penyimpanan preferensi di `localStorage`.
- Navbar sticky berbentuk *pill* dengan indikator halaman aktif.
- Animasi hover pada kartu produk dan galeri.
- Loading state & empty state saat data dimuat via AJAX.
- Notifikasi flash message untuk aksi berhasil/gagal.
- Font **Poppins** dan ikon **Bootstrap Icons**.

### 🔌 REST API JSON
Tersedia endpoint publik untuk konsumsi data dan endpoint admin yang dilindungi autentikasi.

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `GET` | `/api/produk` | Semua produk aktif |
| `GET` | `/api/produk?kategori_id=2` | Filter produk berdasarkan ID kategori |
| `GET` | `/api/produk?kategori_slug=elektronik` | Filter produk berdasarkan slug kategori |
| `GET` | `/api/produk/detail/{slug}` | Detail produk berdasarkan slug |
| `GET` | `/api/kategori` | Semua kategori |
| `GET` | `/api/berita` | Semua berita berstatus publish |
| `GET` | `/api/berita/detail/{slug}` | Detail berita berdasarkan slug |
| `GET` | `/api/galeri` | Semua foto galeri |
| `GET` | `/api/admin/dashboard` | Statistik dashboard 🔒 |
| `GET` | `/api/admin/produk` | Data produk admin 🔒 |
| `GET` | `/api/admin/kategori` | Data kategori admin 🔒 |
| `GET` | `/api/admin/berita` | Data berita admin 🔒 |
| `GET` | `/api/admin/galeri` | Data galeri admin 🔒 |
| `GET` | `/api/admin/pesan` | Data pesan masuk 🔒 |
| `GET` | `/api/admin/user` | Data user 🔒 |

🔒 = memerlukan login administrator.

Contoh respons:

```json
{
  "status": 200,
  "message": "Data produk berhasil diambil",
  "data": [
    {
      "id": 1,
      "nama": "Laptop Bekas",
      "slug": "laptop-bekas",
      "harga": 3500000,
      "kondisi": "bekas",
      "nama_kategori": "Elektronik"
    }
  ]
}
```

---

## 🧰 Teknologi yang Digunakan

| Kategori | Teknologi |
|----------|-----------|
| Bahasa | PHP 8.2+ |
| Framework | CodeIgniter 4 |
| Database | MySQL / MariaDB |
| Frontend | Bootstrap 5.3, Bootstrap Icons, jQuery 3.7 |
| Font | Google Fonts — Poppins |
| Web Server | Apache / Laragon / XAMPP |
| Tools | Composer, Git, PHPUnit |

---

## 🗄️ Struktur Database

Database: `20222_wp2_412024003`

| Tabel | Fungsi |
|-------|--------|
| `users` | Akun administrator (nama, email, password, role) |
| `kategori` | Kategori produk |
| `produk` | Data produk marketplace |
| `berita` | Berita/artikel dengan status publish/draft |
| `galeri` | Foto dokumentasi kegiatan |
| `pesan` | Pesan masuk dari form kontak |

Relasi: `produk.kategori_id → kategori.id` (`ON DELETE CASCADE`).

---

## 📁 Struktur Project

```text
.
├── app/
│   ├── Config/              # Konfigurasi aplikasi, routes, database
│   ├── Controllers/
│   │   ├── Api.php          # REST API publik
│   │   ├── Api/Admin.php    # REST API admin (protected)
│   │   ├── Auth.php         # Login, register, logout
│   │   ├── Berita.php       # Halaman berita publik
│   │   ├── Galeri.php       # Halaman galeri publik
│   │   ├── Kontak.php       # Form kontak
│   │   ├── Produk.php       # Marketplace & detail produk
│   │   ├── Tentang.php      # Halaman tentang
│   │   └── Administrator/   # Controller panel admin
│   ├── Filters/             # AuthFilter
│   ├── Models/              # Model untuk setiap tabel
│   └── Views/
│       ├── administrator/   # Tampilan panel admin
│       ├── public/          # Tampilan halaman publik
│       └── templates/       # Header, footer, sidebar
├── public/
│   ├── assets/
│   │   ├── css/             # Style custom
│   │   ├── js/              # theme.js (dark mode)
│   │   ├── images/          # Logo & gambar statis
│   │   └── uploads/         # Gambar hasil upload admin
│   └── index.php            # Entry point aplikasi
├── system/                  # Framework CodeIgniter 4
├── tests/                   # Unit testing
├── writable/                # Cache, logs, session
├── 20222_wp2_412024003.sql  # Dump database
├── composer.json
└── README.md
```

---

## 🚀 Cara Menjalankan Project

### Prasyarat
- PHP **8.2** atau lebih baru
- Ekstensi PHP: `intl`, `mbstring`, `mysqli`
- MySQL / MariaDB
- Composer
- Laragon / XAMPP (opsional)

### Langkah Instalasi

1. **Clone repository**

   ```bash
   git clone https://github.com/Vetians/Website-Marketplace.git
   cd Website-Marketplace
   ```

2. **Install dependency**

   ```bash
   composer install
   ```

3. **Siapkan file environment**

   Salin file `env` menjadi `.env` (Windows):

   ```bash
   copy env .env
   ```

   Atau di Linux/macOS:

   ```bash
   cp env .env
   ```

4. **Buat database dan import data**

   Buat database dengan nama `20222_wp2_412024003`, lalu import file SQL:

   ```bash
   mysql -u root -p 20222_wp2_412024003 < 20222_wp2_412024003.sql
   ```

   Atau melalui **phpMyAdmin** → **Import** → pilih file `20222_wp2_412024003.sql`.

5. **Sesuaikan konfigurasi**

   Edit `.env` (hilangkan tanda `#` pada baris yang diperlukan):

   ```ini
   app.baseURL = 'http://localhost:8080/'

   database.default.hostname = localhost
   database.default.database = 20222_wp2_412024003
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

6. **Jalankan aplikasi**

   ```bash
   php spark serve
   ```

7. **Buka di browser**

   ```text
   http://localhost:8080
   ```

   Panel admin: `http://localhost:8080/login`

> Jika memakai Laragon/XAMPP, arahkan document root ke folder `public/` atau akses melalui virtual host.

---

## 🔑 Akun Administrator

Registrasi akun baru dapat dilakukan melalui halaman:

```text
http://localhost:8080/register
```

Akun hasil registrasi otomatis memiliki role `admin` dan dapat langsung login ke panel administrator. Untuk penggunaan produksi, segera ganti kredensial bawaan dari file SQL.

---

## 🖼️ Halaman Website

| Halaman | URL |
|---------|-----|
| Beranda | `/` |
| Marketplace | `/produk` |
| Detail Produk | `/produk/{slug}` |
| Filter Kategori | `/produk/kategori/{slug}` |
| Berita | `/berita` |
| Detail Berita | `/berita/{slug}` |
| Galeri | `/galeri` |
| Tentang | `/tentang` |
| Kontak | `/kontak` |
| Login Admin | `/login` |
| Registrasi Admin | `/register` |
| Dashboard Admin | `/administrator/dashboard` |

---

## 📌 Catatan Pengembangan

- Folder `public/assets/uploads/` harus memiliki izin tulis untuk proses upload gambar.
- Folder `writable/` harus dapat ditulis oleh web server.
- Ubah `app.baseURL` pada `.env` sesuai domain saat deployment.
- Untuk produksi, set `CI_ENVIRONMENT = production` dan nonaktifkan mode debug.
- Jangan commit file `.env` yang berisi kredensial database.

---

## 👤 Author

**Christian Melhan** — NIM `412024003`
Program Studi Teknik Informatika, Universitas Kristen Krida Wacana (UKRIDA)

---

## 📄 License

Project ini dilisensikan di bawah [MIT License](LICENSE).

<p align="center">
  <sub>Dibuat dengan ❤️ untuk mendukung gaya hidup hemat dan ramah lingkungan di kalangan mahasiswa.</sub>
</p>
