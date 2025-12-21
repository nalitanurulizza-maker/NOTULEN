<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM isi_notulen WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Data tidak ditemukan.");
}

// === UPDATE DATA ===
if (isset($_POST['update'])) {
    

    $judul   = $_POST['judul'];
    $tanggal = $_POST['tanggal'];
    $waktu   = $_POST['waktu'];
    $status  = $_POST['status'];
    $isi     = $_POST['isi'];

    // --- PROSES LAMPIRAN ---
    $lampiranBaru = $row['lampiran']; // default pakai yg lama

    if (!empty($_FILES['lampiran']['name'])) {

        // hapus file lama jika ada
        if (!empty($row['lampiran']) && file_exists("lampiran/" . $row['lampiran'])) {
            unlink("lampiran/" . $row['lampiran']);
        }

        $namaFile = time() . "_" . basename($_FILES['lampiran']['name']);
        $upload = move_uploaded_file($_FILES['lampiran']['tmp_name'], "lampiran/" . $namaFile);

        if ($upload) {
            $lampiranBaru = $namaFile;
        }
    }

    // UPDATE ke database
    mysqli_query($koneksi, "
        UPDATE isi_notulen SET 
            judul='$judul',
            tanggal='$tanggal',
            waktu='$waktu',
            status='$status',
            isi='$isi',
            lampiran='$lampiranBaru'
        WHERE id='$id'
    ");

    header("Location: daftar-notulen.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Notulen</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Edit Notulen</h2>
<hr>

<form method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control"
               value="<?= htmlspecialchars($row['judul']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control"
               value="<?= $row['tanggal']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Waktu</label>
        <input type="time" name="waktu" class="form-control"
               value="<?= $row['waktu']; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="aktif" <?= $row['status']=="aktif" ? "selected" : ""; ?>>Aktif</option>
            <option value="diarsipkan" <?= $row['status']=="diarsipkan" ? "selected" : ""; ?>>Diarsipkan</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Isi Rapat</label>
        <textarea name="isi" class="form-control" rows="6" required><?= htmlspecialchars($row['isi']); ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Lampiran</label><br>

        <?php if (!empty($row['lampiran'])): ?>
            <p>Lampiran saat ini: 
                <a href="lampiran/<?= $row['lampiran']; ?>" target="_blank">
                    <?= $row['lampiran']; ?>
                </a>
            </p>
        <?php else: ?>
            <p><i>Tidak ada lampiran.</i></p>
        <?php endif; ?>

        <input type="file" name="lampiran" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengganti lampiran.</small>
    </div>

    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
    <a href="daftar-notulen.php" class="btn btn-secondary">Kembali</a>

</form>

</body>
</html>
