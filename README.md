<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 👥 Project Team

| Name                     | NIM       | Role               |
|--------------------------|-----------|--------------------|
| Moh. Rizki Risaleh       | 42422024  | Team Leader        |
| Muhammad Ridwan          | 42422040  | UI/UX Designer     |
| Reza Husnil Khuluqi      | 42422048  | Database Specialist|
| Aditya Bangun Senjaya    | 42422052  | Frontend Developer |
| Ahdi Tri Julianto        | 42422058  | Backend Developer  |
| Safir Al Silmi           | 42421079  | Tester             |

    
### 🚀 Cara Install Project

#### Pastikan sudah menggunakan PHP versi >= 8.3

#### Clone repositori
```bash
git clone https://github.com/rizcvaz/Dkost.git
cd Dkost
```

#### Install dependencies
```bash
composer install
```

#### Salin file konfigurasi environment
```bash
cp .env.example .env
```
#### Generate application key
```bash
php artisan key:generate
```

#### Jalankan migrasi database
```bash
php artisan migrate
```
#### Seed database dengan data awal
```bash
php artisan db:seed
```

#### Jalankan server lokal
```bash
php artisan serve
```

## Fungsi Fitur-Fitur Sistem Kosan

Berikut adalah rincian fungsi-fungsi yang tersedia dalam sistem D’Kost:
1.	Login & Registrasi
Pengguna dapat membuat akun baru dan masuk ke dalam sistem sesuai peran (admin atau user). Sistem akan melakukan validasi data login agar hanya pengguna terdaftar yang dapat mengakses fitur.

2.	Dashboard Admin
Menampilkan ringkasan data kamar, tagihan, penghuni, laporan, dan notifikasi terkait komplain atau pengajuan. Admin dapat mengakses seluruh fitur manajemen sistem.

3.	Dashboard User
Menampilkan informasi tagihan, status kamar yang dihuni, serta menu untuk pengajuan sewa atau pengiriman komplain.

4.	Manajemen Data Kamar
Admin dapat menambahkan, mengedit, dan menghapus data kamar kos, termasuk data fasilitas, harga sewa, dan status ketersediaan.

5.	Manajemen Data Penghuni
Admin dapat melihat daftar penghuni aktif lengkap dengan informasi kamar dan status pembayaran sewa.

6.	Pengelolaan Tagihan
Admin membuat dan mengelola tagihan sewa secara bulanan. Pengguna dapat melihat detail tagihan dan melakukan pembayaran secara online.

7.	Laporan Pembayaran
Admin dapat melihat dan mengunduh laporan pembayaran berdasarkan bulan dan tahun dalam bentuk PDF atau Excel.

8.	Komplain
Pengguna dapat mengirimkan komplain terkait fasilitas kos melalui sistem. Admin dapat membaca, memproses, dan menyelesaikan komplain tersebut.

9.	Pengajuan Sewa Kamar
	Calon penghuni dapat mengajukan permintaan sewa kamar melalui sistem. Admin akan memverifikasi pengajuan dan mengaktifkan tagihan pertama apabila disetujui.


