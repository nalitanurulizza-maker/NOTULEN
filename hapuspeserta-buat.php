<?php
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM daftar_peserta WHERE id='$id'");

header("Location: buat-notulen.php");
exit;
?>
