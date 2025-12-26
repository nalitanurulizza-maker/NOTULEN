<?php
session_start();
include 'koneksi.php'; // tetap sama

// cek login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: menu home.php");
    exit();
}

// ==========================
// JUMLAH PENGGUNA
$qUser = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM user");
$user = mysqli_fetch_assoc($qUser);

// ==========================
// JUMLAH NOTULEN
$qNotulen = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM isi_notulen");
$notulen = mysqli_fetch_assoc($qNotulen);

// ==========================
// LAPORAN MINGGU INI (7 HARI)
$qLaporan = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total 
    FROM isi_notulen 
    WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
");
$laporan = mysqli_fetch_assoc($qLaporan);

$qAktivitas = mysqli_query($koneksi, "
    SELECT 
        u.username, 
        a.kegiatan, 
        a.tanggal
    FROM aktivitas a
    JOIN user u ON a.user_id = u.id
    ORDER BY a.tanggal DESC
    LIMIT 5
");
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f6f8fc;
      display: flex;
      margin: 0;
      font-family: "Segoe UI", sans-serif;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      height: 100vh;
      background: linear-gradient(135deg, #60a5fa, #93c5fd);
      color: #fff;
      position: fixed;
      padding: 25px 20px;
      display: flex;
      flex-direction: column;
    }

    .sidebar h2 {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 40px;
    }

    .sidebar a {
      text-decoration: none;
      color: white;
      padding: 12px 15px;
      display: block;
      border-radius: 6px;
      margin-bottom: 10px;
      font-size: 16px;
      transition: 0.2s;
    }

    .sidebar a.active,
    .sidebar a:hover {
      background-color: rgba(255,255,255,0.2);
    }

    .logout-btn {
      margin-top: auto;
      background-color: #dc3545;
      padding: 12px;
      border-radius: 8px;
      cursor: pointer;
      text-align: center;
      font-weight: bold;
    }

    /* Main */
    .main-content {
      margin-left: 260px;
      padding: 40px;
    }

    /* Card hover */
    .card-custom:hover {
      transform: translateY(-4px);
      transition: 0.2s;
    }
  </style>
</head>

<body>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <h2>📝 NOTUDEKS</h2>

    <a href="dashboard_admin.php" class="active">📊 Dashboard</a>
    <a href="buat-notulen.php">📝 Buat Notulen</a>
    <a href="tambah_peserta.php">👥 Tambah Peserta</a>
    <a href="daftar-notulen.php">📁 Daftar Notulen</a>
    <a href="arsip.php">📂 Arsip</a>
    <a href="pengaturan.php">⚙️ Pengaturan</a>

    <a class="logout-btn btn-danger" href="logout.php">🚪 Keluar</a>
  
</div>
  <!-- MAIN CONTENT -->
  <main class="main-content">
    
    <h1 class="fw-bold">Selamat Datang, Admin 👋</h1>
    <p class="text-secondary">Ini adalah halaman utama untuk mengelola sistem Anda.</p>

    <!-- Cards -->
    <div class="row g-4 my-4">
      <div class="col-md-4">
        <div class="card p-3 shadow-sm card-custom">
          <h3 class="h5 text-success">👥 Pengguna</h3>
          <p>Jumlah pengguna terdaftar: <b><?= $user['total']; ?></b></p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow-sm card-custom">
          <h3 class="h5 text-success">🗒️ Notulen</h3>
          <p>Total notulen tersimpan: <b><?= $notulen['total']; ?></b></p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow-sm card-custom">
          <h3 class="h5 text-success">📊 Laporan</h3>
          <p>Laporan minggu ini: <b><?= $laporan['total']; ?></b></p>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="card p-4 shadow-sm">
      <h2 class="text-primary mb-3">Aktivitas Terbaru</h2>

      <table class="table table-hover align-middle">
        <thead class="table-primary text-white">
          <tr>
            <th>Nama Pengguna</th>
            <th>Kegiatan</th>
            <th>Tanggal</th>
          </tr>
        </thead>
       <tbody>
<?php while ($data = mysqli_fetch_assoc($qAktivitas)) { ?>
<tr>
  <td><?= htmlspecialchars($data['username']) ?></td>
  <td><?= htmlspecialchars($data['kegiatan']) ?></td>
  <td><?= date('d M Y H:i', strtotime($data['tanggal'])) ?></td>
</tr>
<?php } ?>
</tbody>


      </table>
    </div>

  </main>

 
<?php if(isset($_SESSION['notif'])): ?>
<script>
  alert("<?=$_SESSION['notif']?>");
</script>
<?php unset($_SESSION['notif']); endif; ?>

</body>
</html>
