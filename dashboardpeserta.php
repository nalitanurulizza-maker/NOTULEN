<?php session_start(); 
include 'koneksi.php';

$keyword = '';
if (isset($_GET['search'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['search']);
}

$sql = "SELECT * FROM isi_notulen 
        WHERE judul LIKE '%$keyword%' 
        OR isi LIKE '%$keyword%'
        ORDER BY tanggal DESC";

$data = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Notulen — Beranda Peserta</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
 
 <!-- Sidebar Kiri -->
<aside class="sidebar">
  <div class="logo">Notudesk</div>

  <nav class="side-menu">
      <a href="dashboardpeserta.php" class="side-link active">Beranda</a>
      <a href="notulen.php" class="side-link">Daftar Notulen</a>
      <a href="favoritList.php" class="side-link">Favorit</a>
      <a href="profil.php" class="side-link">Profil</a>
  </nav>

  <button class="btn-logout" onclick="logout()">Keluar</button>
</aside>

<div class="content-area">
  <!-- 🔹 Main Content -->
  <main class="page-container">
    <!-- Hero Section -->
    <section class="card">
      <h2>Beranda — Peserta Rapat</h2>
      <p>Selamat datang<strong></strong>. Akses notulen rapat Anda.</p>
      <form method="GET" action="">
  <input 
    type="text"
    name="search"
    class="search-input"
    placeholder="Cari notulen, tanggal, atau kata kunci"
    value="<?= htmlspecialchars($keyword); ?>">
</form>

    </section>

    <!-- Notulen Terbaru -->
    
<?php if (isset($_GET['search']) && $_GET['search'] != ''): ?>

<section class="cards-list">

  <?php if (mysqli_num_rows($data) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($data)): ?>

      <div class="notulen-card"
           onclick="window.location.href='detailnotulen_peserta.php?id=<?= $row['id']; ?>'">

        <!-- KIRI -->
        <div class="meta">
          <h3><?= htmlspecialchars($row['judul']); ?></h3>
          <p class="muted-sm">
            <?= substr(strip_tags($row['isi']), 0, 80); ?>...
          </p>
        </div>

        <!-- KANAN -->
        <div class="right">
          <small class="muted-sm">
            <?= date('d M Y', strtotime($row['tanggal'])); ?>
          </small>
        </div>

      </div>

    <?php endwhile; ?>
  <?php else: ?>
    <p class="muted-sm" style="text-align:center;">Notulen tidak ditemukan</p>
  <?php endif; ?>

</section>

<?php endif; ?>


  <footer class="footer-note">
    <p>© 2025 Notudesk </p>
  </footer>
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
