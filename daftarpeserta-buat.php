<?php
include 'koneksi.php';
$nama = $_POST['nama'];
$email = $_POST['email'];
$input = mysqli_query($koneksi,"INSERT INTO daftar_peserta(nama, email) VALUES('$nama', '$email')") or die(mysqli_error($koneksi));

if($input){
    echo "<script>
        alert('Data Berhasil Disimpan');
        window.location.href = 'buat-notulen.php';
        </script>"; 

} else {
    echo "<script>
            alert('Gagal Menyimpan Data');
            window. location.href = 'buat-notulen.php';
        </script>";

}
?>