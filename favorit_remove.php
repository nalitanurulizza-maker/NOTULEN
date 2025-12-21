<?php
session_start();
include 'koneksi.php';

$user_id    = $_SESSION['user_id'];
$notulen_id = $_POST['notulen_id'];

// Hapus data favorit sesuai user & notulen
mysqli_query($koneksi, "
  DELETE FROM favorite 
  WHERE user_id = '$user_id' 
    AND notulen_id = '$notulen_id'
");

// Kembali ke halaman favorit
header("Location: favoritList.php");
exit;
