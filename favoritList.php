<?php
session_start();
include 'koneksi.php';

$user_id = $_SESSION['user_id'];

$data = mysqli_query($koneksi, "
SELECT isi_notulen.*
FROM favorite
JOIN isi_notulen ON favorite.notulen_id = isi_notulen.id
WHERE favorite.user_id = '$user_id'
ORDER BY favorite.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Notulen — Favorit</title>
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
      <a href="profil.php" class="side-link">Profil</a>
  </nav>

  <button class="btn-logout" onclick="logout()">Keluar</button>
</aside>

<!-- KONTEN -->
<div class="content-area">
  <main class="container-wide">

    <section class="notulen-area">
      <div class="card">

        <!-- HEADER -->
        <div class="section-head">
          <h2>Notulen Favorit</h2>
          <div class="right-controls">
            <input type="text" placeholder="Pencarian global" />
            <button class="btn secondary">Urutkan</button>
          </div>
        </div>

       <div class="cards-list">

<?php if (mysqli_num_rows($data) > 0): ?>
  <?php while ($row = mysqli_fetch_assoc($data)): ?>

    <div class="card notulen-card" onclick="window.location.href='detailnotulen_peserta.php?id=<?= $row['id']; ?>'">

  <div class="card-header">
    <h3><?= htmlspecialchars($row['judul']); ?></h3>
  </div>

  <p class="muted-sm">
    <?= substr($row['isi'], 0, 100); ?>...
  </p>

  <!-- INI BAGIAN PENTING -->
  <div class="card-footer">
    <small><?= $row['tanggal']; ?> • <?= $row['waktu']; ?></small>

    <form class="card-actions" action="favorit_remove.php" method="POST"
          onclick="event.stopPropagation();">
      <input type="hidden" name="notulen_id" value="<?= $row['id']; ?>">
      <button type="submit" class="btn secondary">⭐ Hapus</button>
    </form>
  </div>

</div>

  <?php endwhile; ?>
<?php else: ?>

  <div class="empty-state">
    <div class="empty-icon">⭐</div>
    <h3>Belum ada notulen favorit</h3>
    <p>Tandai notulen sebagai favorit agar mudah ditemukan kembali.</p>
    <a href="notulen.php" class="btn primary">Lihat Daftar Notulen</a>
  </div>

<?php endif; ?>

</div>


      </div>
    </section>

  </main>
</div>
<script>
    const user = localStorage.getItem("username") || "Admin";
    document.getElementById("username").textContent = user;

    function logout() {
      alert("Anda telah keluar dari dashboard peserta.");
      localStorage.removeItem("username");
      window.location.href = "menu home.php";
    }
  </script>

  
  <?php if(isset($_SESSION['notif'])): ?>
    <script>
     alert("<?=$_SESSION['notif']?>");
    </script>
  <?php unset($_SESSION['notif']); endif; ?>

</body>
</html>

