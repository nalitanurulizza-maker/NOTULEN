<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = $_GET['id'];

$sql = "SELECT * FROM isi_notulen WHERE id = $id";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data tidak ditemukan!");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Notulen</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2>Detail Notulen</h2>
    <hr>

    <p><strong>Judul:</strong> <?= $data['judul'] ?></p>

    <p><strong>Tanggal:</strong> <?= $data['tanggal'] ?></p>

    <p><strong>Waktu:</strong> 
        <?= !empty($data['waktu']) ? $data['waktu'] : "<i>Tidak ada waktu</i>" ?>
    </p>

    <p><strong>Status:</strong> <?= $data['status'] ?></p>

    <p><strong>Isi Notulen:</strong><br>
        <?= nl2br($data['isi']) ?>
    </p>

    <hr>

    <h4>Lampiran</h4>

    <?php if (!empty($data['lampiran'])): ?>
        <a class="btn btn-primary" href="lampiran/<?= $data['lampiran'] ?>" target="_blank">
            Download Lampiran
        </a>
    <?php else: ?>
        <p><i>Tidak ada lampiran.</i></p>
    <?php endif; ?>

    <hr>

    <a href="daftar-notulen.php" class="btn btn-secondary">Kembali</a>

</body>
</html>
