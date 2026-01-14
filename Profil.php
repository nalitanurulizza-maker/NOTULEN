<?php
session_start();
include 'koneksi.php';

/* =====================
   CEK LOGIN
===================== */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* =====================
   DATA USER
===================== */
$qUser = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$user_id'");
$user = mysqli_fetch_assoc($qUser);

if (!$user) {
    die("User tidak ditemukan");
}

$inisial = strtoupper(substr($user['username'], 0, 1));

/* =====================
   TOTAL NOTULEN DIIKUTI
   tabel: notulen_peserta
===================== */
$qTotalNotulen = mysqli_query($koneksi, "
    SELECT COUNT(DISTINCT notulen_id) AS total
    FROM favorite
    WHERE user_id = '$user_id'
");
$totalNotulen = mysqli_fetch_assoc($qTotalNotulen)['total'];

/* =====================
   TOTAL UNDUHAN
   tabel: aktivitas
===================== */
$qUnduhan = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total
    FROM aktivitas_peserta
    WHERE user_id = '$user_id'
    AND jenis = 'unduhan'
");
$totalUnduhan = mysqli_fetch_assoc($qUnduhan)['total'];

/* =====================
   AKTIVITAS TERBARU
   tabel: aktivitas
   kolom: kegiatan, tanggal
===================== */
$qAktivitas = mysqli_query($koneksi, "
    SELECT keterangan, created_at
    FROM aktivitas_peserta
    WHERE user_id = '$user_id'
    ORDER BY created_at DESC
    LIMIT 1
");
$aktivitas = mysqli_fetch_assoc($qAktivitas);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Profil Peserta — Notulen</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<!-- Sidebar Kiri -->
<aside class="sidebar">
  <div class="logo">Notudesk</div>

  <nav class="side-menu">
      <a href="dashboardpeserta.php" class="side-link">Beranda</a>
      <a href="notulen.php" class="side-link">Daftar Notulen</a>
      <a href="favoritList.php" class="side-link">Favorit</a>
      <a href="profil.php" class="side-link active">Profil</a>
  </nav>

  <button class="btn-logout" onclick="logout()">Keluar</button>
</aside>

<div class="content-area">

<main class="page-container">
  <div class="profile-grid">

    <!-- KIRI -->
    <aside class="profile-left card">
      <h3>Profil Peserta</h3>

      <div class="profile-info">
        <div class="avatar-initial"><?= $inisial; ?></div>

        <div class="profile-text">
          <h2><?= htmlspecialchars($user['username']); ?></h2>
          <div class="chips">
            <span class="chip">Peserta Rapat</span>
            <span class="chip pink">Read-only</span>
          </div>
        </div>
      </div>

      <div class="info-section">
        <label>Email</label>
        <div class="info-row">
          <input type="text" value="<?= htmlspecialchars($user['email']); ?>" readonly>
          <button class="btn small ghost"
            onclick="navigator.clipboard.writeText('<?= $user['email']; ?>')">
            Salin
          </button>
        </div>

        <label>Nomor Kontak</label>
        <div class="info-row">
          <input type="text" value="<?= htmlspecialchars($user['no_hp']); ?>" readonly>
          <button class="btn small secondary" disabled>Ubah</button>
        </div>
      </div>
    </aside>

    <!-- PROFIL KANAN -->
<section class="profile-right">

  <!-- STAT -->
  <div class="card stat-row">
    <div class="stat-item">
      <small>Total Notulen Favorit</small>
      <h1><?= $totalNotulen ?></h1>
    </div>
    <div class="stat-item">
      <small>Total Unduhan</small>
<h1><?= $totalUnduhan ?></h1>

    </div>
  </div>

  <!-- AKTIVITAS -->
  <div class="card">
    <h3>Aktivitas Terbaru</h3>
    <ul class="activity-list">
      <?php if ($aktivitas): ?>
        <li>
          <div>
            <p class="muted-sm">
              <?= htmlspecialchars($aktivitas['keterangan']) ?>
              <?= date('d M Y • H:i', strtotime($aktivitas['created_at'])) ?>
            </p>
          </div>
          <span class="chip">Tim</span>
        </li>
      <?php else: ?>
        <li class="muted-sm">Belum ada aktivitas</li>
      <?php endif; ?>
    </ul>
  </div>

</section>
</div>
</main>
</div>

<script>
function logout() {
  if (confirm("Yakin ingin keluar?")) {
    window.location.href = "logout.php";
  }
}
</script>

</body>
</html>