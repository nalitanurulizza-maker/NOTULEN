<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($koneksi, "DELETE FROM isi_notulen WHERE id='$id'");

    header("Location: daftar-notulen.php");
    exit();
} else {
    echo "ID tidak ditemukan.";
}
?>
