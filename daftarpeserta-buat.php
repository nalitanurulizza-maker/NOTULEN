<?php
include 'koneksi.php';
$nama = $_POST['namapeserta'];
$email = $_POST['emailpeserta'];
$input = mysqli_query($koneksi,"INSERT INTO `tambah notulen` (namapeserta, emailpeserta) VALUES('$nama', '$email')") or die(mysqli_error($koneksi));

if($input){
    echo "<script>
        alert('Data Berhasil Disimpan');
        window.location.href = '`tambah notulen`.php';
        </script>"; 

} else {
    echo "<script>
            alert('Gagal Menyimpan Data');
            window. location.href = '`tambah notulen`.php';
        </script>";

}
?>