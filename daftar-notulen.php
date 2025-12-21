<?php
include 'koneksi.php';

// ===============================
//   AMBIL NOTULEN AKTIF SAJA
// ===============================
$data = mysqli_query($koneksi,
    "SELECT * FROM isi_notulen WHERE status='aktif' ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Notulen Admin</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f5f7fa;
      font-family: "Segoe UI", sans-serif;
    }

    /* SIDEBAR */
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
      display: block;
      text-decoration: none;
      padding: 12px 15px;
      color: white;
      border-radius: 6px;
      margin-bottom: 10px;
      font-size: 16px;
      transition: 0.2s;
    }

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

    /* MAIN CONTENT */
    .main-content h1 {
    font-size: 25px !important;
    font-weight: 700;
    }


    .main-content {
      margin-left: 260px;
      padding: 30px;
    }

    /* TABEL NOTULEN */
    .notulen-table {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .notulen-table th {
      background: #1476e7;
      color: white;
    }

    .notulen-table tr:hover {
      background: #f1f5f9;
    }

    /* STATUS */
    .status {
      padding: 5px 10px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 0.85rem;
    }
    .status.aktif { background:#e6f7f1; color:#2a9d8f; }
    .status.diarsipkan { background:#fdecea; color:#d62828; }

  </style>


</head>
<body>
<script>
    function konfirmasiHapus(id) {
      if (confirm("Yakin ingin menghapus notulen ini?")) {
        window.location = "hapus-notulen.php?id=" + id;
      }
    }
  </script>

</head>
<body>

<div class="sidebar">
  <h2>📝 NOTUDEKS</h2>

  <a href="dashboard_admin.php">📊 Dashboard</a>
  <a href="buat-notulen.php">📝 Buat Notulen</a>
  <a href="tambah_peserta.php">👥 Tambah Peserta</a>
  <a href="daftar-notulen.php" style="background:rgba(255,255,255,0.2);">📁 Daftar Notulen</a>
  <a href="arsip.php">📂 Arsip</a>
  <a href="pengaturan.php">⚙️ Pengaturan</a>
  <a class="logout-btn" onclick="logout()">🚪 Keluar</a>
</div>

<main class="main-content">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Daftar Notulen</h1>

    <div>
      <button class="btn btn-secondary">📅 Rentang Tanggal</button>
      <a href="buat-notulen.php" class="btn btn-success">＋ Buat Notulen</a>
    </div>
  </div>

  <input type="text" class="form-control mb-3" placeholder="Cari judul, tanggal, kata kunci">

  <table class="table notulen-table">
    <thead>
      <tr>
        <th>Judul</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>
    <?php
      
      if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
          $statusClass = ($row['status'] ?? 'aktif') == 'aktif' ? "aktif" : "diarsipkan";
    ?>

      <tr>
        <td><?= htmlspecialchars($row['judul']); ?></td>
        <td><?= $row['tanggal']; ?></td>

        <td>
          <span class="status <?= $statusClass ?>">
            <?= ucfirst($statusClass); ?>
          </span>
        </td>

        <td>
          <a href="detailnotulen.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Lihat</a>
          <a href="edit-notulen.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
          <button onclick="konfirmasiHapus(<?= $row['id']; ?>)" class="btn btn-sm btn-danger">
            Hapus
          </button>
        </td>
      </tr>

    <?php
        }
      } else {
    ?>
      <tr>
        <td colspan="4" class="text-center py-4 text-muted">Belum ada notulen.</td>
      </tr>
    <?php } ?>
    </tbody>
  </table>

</main>

 <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    function logout() {
      alert("Anda telah keluar dari dashboard admin.");
      window.location.href = "menu home.php";
    }
  </script>
</body>
</html>