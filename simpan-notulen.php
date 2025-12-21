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

$status   = ($aksi == "arsip") ? "diarsipkan" : "aktif";
$lampiran = ;null // ← PENTING

// SIMPAN NOTULEN
mysqli_query($koneksi, "
    INSERT INTO isi_notulen (judul, tanggal, waktu, isi, lampiran, status)
    VALUES ('$judul', '$tanggal', '$waktu', '$isi', '$lampiran', '$status')
") or die(mysqli_error($koneksi));

// SIMPAN AKTIVITAS
mysqli_query($koneksi, "
    INSERT INTO aktivitas (user_id, kegiatan, tanggal)
    VALUES ($user_id, 'Menambahkan notulen', NOW())
");

header("Location: daftar-notulen.php");
exit();
