<?php
include 'koneksi.php';

/* ===============================
   VALIDASI ID
================================ */
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

/* ===============================
   AMBIL DATA NOTULEN
================================ */
$queryNotulen = mysqli_query(
    $koneksi,
    "SELECT * FROM isi_notulen WHERE id='$id'"
);

$notulen = mysqli_fetch_assoc($queryNotulen);

if (!$notulen) {
    die("Data tidak ditemukan.");
}

/* ===============================
   PROSES UPDATE
================================ */
if (isset($_POST['update'])) {

    $judul   = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $waktu   = mysqli_real_escape_string($koneksi, $_POST['waktu']);
    $status  = mysqli_real_escape_string($koneksi, $_POST['status']);
    $isi     = mysqli_real_escape_string($koneksi, $_POST['isi']);

    /* ===== LAMPIRAN ===== */
    $lampiranBaru = $notulen['lampiran']; // default pakai lampiran lama

    if (!empty($_FILES['lampiran']['name'])) {

        // Hapus lampiran lama jika ada
        if (
            !empty($notulen['lampiran']) &&
            file_exists("uploads/" . $notulen['lampiran'])
        ) {
            unlink("uploads/" . $notulen['lampiran']);
        }

        $namaFile = time() . "_" . basename($_FILES['lampiran']['name']);
        $pathUpload = "uploads/" . $namaFile;

        if (move_uploaded_file($_FILES['lampiran']['tmp_name'], $pathUpload)) {
            $lampiranBaru = $namaFile;
        }
    }

    /* ===== UPDATE DATABASE ===== */
    mysqli_query(
        $koneksi,
        "UPDATE isi_notulen SET
            judul='$judul',
            tanggal='$tanggal',
            waktu='$waktu',
            status='$status',
            isi='$isi',
            lampiran='$lampiranBaru'
         WHERE id='$id'"
    );

    header("Location: daftar-notulen.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Notulen</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body class="p-4">

<h2>Edit Notulen</h2>
<hr>

<form method="POST" enctype="multipart/form-data">

    <!-- Judul -->
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input
            type="text"
            name="judul"
            class="form-control"
            value="<?= htmlspecialchars($notulen['judul']); ?>"
            required
        >
    </div>

    <!-- Tanggal -->
    <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input
            type="date"
            name="tanggal"
            class="form-control"
            value="<?= htmlspecialchars($notulen['tanggal']); ?>"
            required
        >
    </div>

    <!-- Waktu -->
    <div class="mb-3">
        <label class="form-label">Waktu</label>
        <input
            type="time"
            name="waktu"
            class="form-control"
            value="<?= htmlspecialchars($notulen['waktu']); ?>"
        >
    </div>

    <!-- Status -->
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="aktif" <?= $notulen['status'] === 'aktif' ? 'selected' : ''; ?>>
                Aktif
            </option>
            <option value="diarsipkan" <?= $notulen['status'] === 'diarsipkan' ? 'selected' : ''; ?>>
                Diarsipkan
            </option>
        </select>
    </div>

    <!-- Isi -->
    <div class="mb-3">
        <label class="form-label">Isi Rapat</label>
        <textarea
            name="isi"
            rows="6"
            class="form-control"
            required
        ><?= htmlspecialchars($notulen['isi']); ?></textarea>
    </div>

    <!-- Lampiran -->
    <div class="mb-3">
        <label class="form-label">Lampiran</label><br>

        <?php if (!empty($notulen['lampiran'])): ?>
            <p>
                Lampiran saat ini:
                <a
                    href="uploads/<?= htmlspecialchars($notulen['lampiran']); ?>"
                    target="_blank"
                >
                    <?= htmlspecialchars($notulen['lampiran']); ?>
                </a>
            </p>
        <?php else: ?>
            <p><i>Tidak ada lampiran.</i></p>
        <?php endif; ?>

        <input type="file" name="lampiran" class="form-control">
        <small class="text-muted">
            Kosongkan jika tidak ingin mengganti lampiran.
        </small>
    </div>

    <!-- Tombol -->
    <button type="submit" name="update" class="btn btn-primary">
        Simpan Perubahan
    </button>
    <a href="daftar-notulen.php" class="btn btn-secondary">
        Kembali
    </a>

</form>

</body>
</html>
