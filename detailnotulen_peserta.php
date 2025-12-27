<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("Notulen tidak ditemukan.");
}

$id = $_GET['id'];

$query = mysqli_query($koneksi, 
"SELECT * FROM isi_notulen WHERE id = '$id' AND status = 'aktif'");

$row = mysqli_fetch_assoc($query);

if (!$row) {
    die("<h2 style='font-family:sans-serif; padding:20px;'>Notulen tidak ditemukan atau belum diterbitkan.</h2>");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Detail Notulen</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .detail-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-top: 30px;
    }
    .detail-title {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .detail-meta {
        color: #666;
        margin-bottom: 20px;
    }
    .detail-content {
        font-size: 16px;
        line-height: 1.7;
        white-space: pre-line;
    }
    .btn-back {
        display: inline-block;
        margin-top: 25px;
        padding: 10px 18px;
        background: #d0d7ff;
        color: black;
        border-radius: 8px;
        text-decoration: none;
        font-size: 15px;
    }
    .btn-back:hover {
        background: #b8c2ff;
    }
    .lampiran-box {
        margin-top: 25px;
        padding: 12px 18px;
        background: #f4faff;
        border: 1px solid #cbdfff;
        border-radius: 8px;
    }
    .lampiran-box a {
        text-decoration: none;
        color: #007bff;
        font-weight: 600;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
  <div class="logo">Notudesk</div>

  <nav class="side-menu">
      <a href="dashboardpeserta.php" class="side-link">Beranda</a>
      <a href="notulen.php" class="side-link">Daftar Notulen</a>
      <a href="favoritList.php" class="side-link">Favorit</a>
      <a href="profil.php" class="side-link">Profil</a>
  </nav>

  <button class="btn-logout" onclick="logout()">Keluar</button>
</aside>

<div class="content-area">
  <main class="container-wide page">

    <div class="detail-card">

      <h1 class="detail-title"><?= htmlspecialchars($row['judul']); ?></h1>

      <p class="detail-meta">
        📅 <?= $row['tanggal']; ?>  
        &nbsp;&nbsp; ⏰ <?= $row['waktu']; ?>
      </p>

      <hr>

      <h3>Isi Notulen</h3>
      <div class="detail-content">
        <?= nl2br($row['isi']); ?>
      </div>

      <?php if (!empty($row['lampiran'])) { ?>
        <div class="lampiran-box">
          📎 <strong>Lampiran:</strong><br>
          <a href="uploads/<?= htmlspecialchars($row['lampiran']); ?>" download>
            Klik di sini untuk download lampiran
          </a>
        </div>
      <?php } ?>

      <a href="notulen.php" class="btn-back">← Kembali</a>

    </div>

  </main>
</div>

</body>
</html>
