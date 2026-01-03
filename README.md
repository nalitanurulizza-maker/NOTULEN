# NOTULEN

Aplikasi Notulen Rapat berbasis Web menggunakan PHP dan MySQL.
Aplikasi ini digunakan untuk mencatat, mengelola, dan mengunduh notulen rapat.

## Fitur
- Login & Register Pengguna
- Dashboard Admin dan Peserta
- Manajemen Notulen (Tambah, Edit, Hapus)
- Manajemen Peserta
- Download Notulen
- Arsip Notulen

## Teknologi
- PHP
- MySQL
- Bootstrap
- CSS & JavaScript

## Struktur Folder
NOTULEN/
│── src/ # Source code aplikasi
│── assets/ # File CSS & JavaScript
│── uploads/ # File upload
│── database/ # File database (.sql)
│── README.md

## Cara Instalasi
1. Clone repository ini atau download sebagai ZIP
2. Pindahkan folder project ke direktori `www` pada Laragon
3. Jalankan Laragon dan pastikan Apache & MySQL aktif
4. Buat database melalui phpMyAdmin
5. Import file database dari folder `database/notulen.sql`
6. Atur koneksi database di file `koneksi.php`

## Cara Menjalankan
Buka browser dan akses:
http://localhost/NOTULEN

## Catatan
Pastikan Apache dan MySQL sudah berjalan sebelum menjalankan aplikasi.
