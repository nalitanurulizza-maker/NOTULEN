<?php
session_start();
include 'koneksi.php';

$user_id    = $_SESSION['user_id'];
$notulen_id = $_POST['notulen_id'];

// Cek apakah sudah difavoritkan
$cek = mysqli_query($koneksi, 
"SELECT * FROM favorite 
 WHERE user_id='$user_id' AND notulen_id='$notulen_id'");

if (mysqli_num_rows($cek) == 0) {
    mysqli_query($koneksi, 
    "INSERT INTO favorite (user_id, notulen_id)
     VALUES ('$user_id', '$notulen_id')");
}

header("Location: notulen.php");
exit;
