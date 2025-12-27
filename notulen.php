<?php
session_start();
include 'koneksi.php';

$user_id = $_SESSION['user_id'];
$data = mysqli_query($koneksi, 
"SELECT * FROM isi_notulen WHERE status='aktif' ORDER BY id DESC");

$data = mysqli_query($koneksi, 
"SELECT * FROM isi_notulen WHERE status = 'aktif' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Notulen — Daftar Notulen</title>
  <link rel="stylesheet" href="style.css">
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
    <section class="notulen-area">
      <div class="card">

        <div class="section-head">
          <h2>Daftar Notulen</h2>
        </div>

        <div class="cards-list">

          <?php if (mysqli_num_rows($data) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($data)) { ?>

              <a href="detailnotulen_peserta.php?id=<?= $row['id']; ?>" 
                 class="card notulen-card"
                 style="display:block; text-decoration:none; color:inherit;">

                <div class="meta">
                  <span class="tag tag-success">Final</span>
                  <h3><?= htmlspecialchars($row['judul']); ?></h3>
                  <p class="muted-sm"><?= substr($row['isi'], 0, 100); ?>...</p>
                </div>

                <div class="right">
                  <p class="muted-sm">
                    <?= $row['tanggal']; ?> • <?= $row['waktu']; ?>
                  </p>

                  <div class="card-actions">

  <!-- TOMBOL FAVORIT -->
  <form action="favorit_add.php" method="POST" style="display:inline;">
    <input type="hidden" name="notulen_id" value="<?= $row['id']; ?>">
    <button type="submit" class="icon-btn" title="Tambah ke favorit">
      ⭐
    </button>
  </form>

  <?php if (!empty($row['lampiran'])) { ?>
    <a href="upload/<?= $row['lampiran']; ?>" 
       class="icon-btn btn-download" download>
       ⬇️
    </a>
  <?php } ?>

</div>

                </div>

              </a>

            <?php } ?>
          <?php } else { ?>
            <p style="padding:20px;color:#777;text-align:center;">
              Belum ada notulen yang diterbitkan.
            </p>
          <?php } ?>

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
