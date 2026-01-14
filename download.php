<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    die("Akses ditolak (session hilang)");
}

if (!isset($_GET['file'])) {
    die("File tidak ditemukan");
}

$user_id = $_SESSION['user_id'];
$filename = basename($_GET['file']);
$filepath = 'uploads/' . $filename;

if (!file_exists($filepath)) {
    die("File tidak ada di server");
}

/* CATAT AKTIVITAS */
$insert = mysqli_query($koneksi, "
    INSERT INTO aktivitas_peserta (user_id, jenis, keterangan)
    VALUES ('$user_id','unduhan','Mengunduh notulen: $filename')
");

if (!$insert) {
    die("Gagal mencatat aktivitas: " . mysqli_error($koneksi));
}

/* DOWNLOAD */
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));

readfile($filepath);
exit;
