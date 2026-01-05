# Source Code Structure

Aplikasi NOTULEN dikembangkan menggunakan PHP native tanpa menggunakan framework.

Untuk menjaga kestabilan dan kemudahan konfigurasi aplikasi,
seluruh file PHP utama diletakkan pada root directory project.
Pendekatan ini dipilih agar aplikasi dapat dijalankan secara langsung
pada server lokal Laragon tanpa konfigurasi tambahan path.

Secara konseptual, pembagian source code dalam aplikasi ini adalah sebagai berikut:

- File autentikasi (login, register, logout)
- File manajemen notulen
- File manajemen peserta
- File konfigurasi (koneksi database)

Struktur folder `src/` dijelaskan sebagai representasi konseptual
praktik pengorganisasian kode sesuai dengan prinsip pengembangan
perangkat lunak, meskipun tidak seluruh file ditempatkan secara fisik
di dalam folder tersebut.

## Catatan Struktur

Struktur folder pada repository ini disesuaikan dengan kebutuhan
aplikasi PHP native tanpa framework.

Beberapa file sengaja diletakkan pada root directory untuk menjaga
kompatibilitas path, kestabilan aplikasi, serta meminimalkan potensi
error akibat perubahan struktur folder.

