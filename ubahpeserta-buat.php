<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];

mysqli_query($koneksi, 
"UPDATE daftar_peserta 
 SET nama='$nama', email='$email' 
 WHERE id='$id'"
);

header("Location: buat-notulen.php");
exit;
?>
