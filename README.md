# Aplikasi Gallery Ujikom

Aplikasi Gallery ini adalah aplikasi yang digunakan untuk ujian komprehensif (Ujikom) untuk tujuan pembelajaran dan evaluasi. Aplikasi ini memungkinkan pengguna untuk melakukan transaksi penjualan produk, mengelola data produk, dan memproses pembayaran.

## Persyaratan

Sebelum memulai, pastikan Anda memiliki:

-   **PHP** (Disarankan versi terbaru)

-   **Composer**

-   **Node.js** dan **NPM**

-   **Tailwind CSS**

-   **XAMPP** (atau server lokal dengan PHP dan MySQL)

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal aplikasi:

-   Clone repositori ini ke komputer Anda:

```bash
git clone https://github.com/jyadim/RakanGallery.git
```

-   Masuk ke direktori proyek:

```bash
cd RakanGallery
```

-   Buka file php.ini pada XAMPP dan aktifkan ekstensi berikut dengan menghapus tanda titik koma ( ; ) :

```bash
extension=gd
extension=zip
```

-   Buka Xampp lalu klik admin pada menu mysql setelah itu buat database dengan nama sesuai di **.env**

```bash
DB_DATABASE=rakan_gallery
```

-   Install dependencies dengan Composer dan NPM:

```bash
composer install
npm install
npm install tailwindcss @tailwindcss/vite
```

-   Migrasi database dan seeding data:

```bash
php artisan migrate 
```
-   Pindahkan Folder Photo dan Profiles pada public/storage ke folder lain selain public/storage

-   Lakukan rm storage

```bash
cd public
rm storage
```

-   Buat symbolic link untuk storage:

```bash
php artisan storage:link
```
-   Pindahkan kembali Folder Photo dan Profiles pada public/storage

-   Jalankan Vite untuk membangun asset frontend:

```bash
npm run dev
```

-   Jalankan server Laravel:

```bash
php artisan serve
```

## Login

Gunakan kredensial berikut untuk masuk ke aplikasi:

-   **User**

-   User 1
-   **Email** : aselole@gmail.com 

-   **Password** : 12345678
-   User 2
-   **Email** : asikjos@gmail.com 

-   **Password** : 12345678

-   **Admin**
-   **Email** : admin@KennGallery.com 

-   **Password** : 12345678

Setelah berhasil login, Anda akan diarahkan ke halaman utama aplikasi kasir.

## Fitur Utama

-   Like dan Comment: Pengguna dapat memberikan like maupun comment pada photo orang lain maupun diri sendiri.

-   Notifikasi: Pengguna mendapatkan notifikasi apabila pengguna lain like ataupun comment pada photo yang dia unggah.

-   Laporan: Menampilkan laporan like terbanyak dan comment terbanyak untuk pengguna dan admin.

-   Pengunggahan Photo: Pengguna dapat mengunggah photo untuk ditampilkan pada dashboard dan diunggah berdasarkan album.

-   Login Sistem: Pengguna dapat login untuk mengakses aplikasi dan melakukan transaksi.

## Lisensi

Proyek ini dibuat untuk keperluan pembelajaran dan ujian komprehensif (Ujikom).
