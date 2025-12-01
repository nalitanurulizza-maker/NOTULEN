<?php
// include database connection file
include 'koneksi.php';
    $nama= $_POST['namapeserta'];
    $email=$_POST['emailpeserta'];
    $result = mysqli_query($koneksi, "UPDATE `tambah notulen` SET namapeserta='$nama', emailpeserta='$email'
    ,WHERE nim='$nim'");
// Redirect to homepage to display updated user in list
header("Location: `tambah notulen`.php");
?>