<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil data user
$id = $_SESSION['user_id'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$user = mysqli_fetch_assoc($query);

// Validasi data
if (!$user) {
    die("Data user tidak ditemukan!");
}

// Inisial username
$inisial = strtoupper(substr($user['username'], 0, 1));
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

    <!-- KANAN -->
    <section class="profile-right">

      <div class="card stat-row">
        <div class="stat-item">
          <small>Total Notulen Dibintangi</small>
          <h1>0</h1>
        </div>
        <div class="stat-item">
          <small>Unduhan Bulan Ini</small>
          <h1>0</h1>
        </div>
      </div>

      <div class="card">
        <h3>Aktivitas Terbaru</h3>
        <ul class="activity-list">
          <li>
            <div>
              <strong>Pemilihan Ketua OSIS</strong>
              <p class="muted-sm">10 Des 2025 • 14:22</p>
            </div>
            <span class="chip">Tim</span>
          </li>
        </ul>
      </div>

      <div class="card">
        <h3>Akses Cepat</h3>
        <div class="quick-actions">
          <button class="btn secondary full">Kelola perangkat terhubung</button>
          <button class="btn secondary full" onclick="logout()">Keluar dari sesi</button>
        </div>
      </div>

    </section>

  </div>
</main>

<footer class="footer-note">
  <span>© 2025 Notudeks</span>
</footer>

<script>
function logout() {
  if (confirm("Yakin ingin keluar?")) {
    window.location.href = "logout.php";
  }
}
</script>

</body>
</html>
