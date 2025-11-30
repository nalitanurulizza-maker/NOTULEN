<?php
// include database connection file
include 'koneksi.php';
    $nama= $_POST['nama'];
    $email=$_POST['email'];
    $result = mysqli_query($koneksi, "UPDATE t SET nama='$nama', tugas=$tugas");
// Redirect to homepage to display updated user in list
header("Location:buat-notolen.php");
?>