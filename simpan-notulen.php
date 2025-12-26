<?php
session_start();
include 'koneksi.php';

$user_id = $_SESSION['user_id'] ?? 0;
if ($user_id == 0) die("Session user tidak ditemukan.");

$judul   = $_POST['judul'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$waktu   = $_POST['waktu'] ?? '';
$isi     = $_POST['isi'] ?? '';
$aksi    = $_POST['aksi'] ?? 'simpan';

if (empty($judul) || empty($tanggal) || empty($waktu) || empty($isi)) {
    die("Form wajib diisi.");
}

$status = ($aksi == "arsip") ? "diarsipkan" : "aktif";

/* ===============================
   PROSES UPLOAD LAMPIRAN
   =============================== */
$lampiran = null;

if (!empty($_FILES['lampiran']['name'])) {

    $nama_file   = $_FILES['lampiran']['name'];
    $ukuran_file = $_FILES['lampiran']['size'];
    $tmp_file    = $_FILES['lampiran']['tmp_name'];

    $ekstensi_diperbolehkan = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
    $x = explode('.', $nama_file);
    $ekstensi = strtolower(end($x));

    if (!in_array($ekstensi, $ekstensi_diperbolehkan)) {
        die("Ekstensi file tidak diizinkan!");
    }

    if ($ukuran_file > 2000000) {
        die("Ukuran file terlalu besar (maks 2MB)");
    }

    $folder_upload = "uploads";

if (!is_dir($folder_upload)) {
    mkdir($folder_upload, 0755, true);
}

$nama_file_baru = time() . "_" . $nama_file;

if (!move_uploaded_file($tmp_file, $folder_upload . "/" . $nama_file_baru)) {
    die("Gagal mengunggah lampiran");
}


    $lampiran = $nama_file_baru;
}

/* ===============================
   SIMPAN NOTULEN (SETELAH UPLOAD)
   =============================== */
mysqli_query($koneksi, "
    INSERT INTO isi_notulen (judul, tanggal, waktu, isi, lampiran, status)
    VALUES ('$judul', '$tanggal', '$waktu', '$isi', '$lampiran', '$status')
") or die(mysqli_error($koneksi));

// ambil id notulen
$notulen_id = mysqli_insert_id($koneksi);

/* ===============================
   SIMPAN PESERTA
   =============================== */
if (isset($_POST['peserta'])) {
    foreach ($_POST['peserta'] as $peserta_id) {
        mysqli_query($koneksi, "
            INSERT INTO notulen_peserta (notulen_id, peserta_id)
            VALUES ('$notulen_id', '$peserta_id')
        ");
    }
}

/* ===============================
   SIMPAN AKTIVITAS
   =============================== */
mysqli_query($koneksi, "
    INSERT INTO aktivitas (user_id, kegiatan, tanggal)
    VALUES ('$user_id', 'Menambahkan notulen', NOW())
");

header("Location: daftar-notulen.php");
exit();
