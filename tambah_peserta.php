<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Peserta</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style>
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

    .sidebar a {
      text-decoration: none;
      color: white;
      padding: 12px 15px;
      display: block;
      border-radius: 6px;
      margin-bottom: 10px;
      transition: 0.3s;
    }

    .sidebar a.active,
    .sidebar a:hover {
      background-color: rgba(255,255,255,0.3);
    }

    .sidebar h2 {
      font-size: 22px;
      margin-bottom: 40px;
    }

    .content {
      margin-left: 260px;
      padding: 30px;
    }

    .form-card {
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar .logout-btn {
     margin-top: auto;
      background-color: #dc3545;
      padding: 12px;
      border-radius: 8px;
      cursor: pointer;
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>

<body>

<!-- ✅ SIDEBAR -->
<div class="sidebar">
    <h2>📝 NOTUDEKS</h2>

    <a href="dashboard_admin.php" class="<?= $currentPage == 'dashboard_admin.php' ? 'active' : '' ?>">📊 Dashboard</a>
    <a href="buat-notulen.php" class="<?= $currentPage == 'buat-notulen.php' ? 'active' : '' ?>">📝 Buat Notulen</a>
    <a href="tambah_peserta.php" class="<?= $currentPage == 'tambah_peserta.php' ? 'active' : '' ?>">👥 Tambah Peserta</a>
    <a href="daftar-notulen.php" class="<?= $currentPage == 'daftar-notulen.php' ? 'active' : '' ?>">📁 Daftar Notulen</a>
    <a href="arsip.php" class="<?= $currentPage == 'arsip.php' ? 'active' : '' ?>">📂 Arsip</a>
    <a href="pengaturan.php" class="<?= $currentPage == 'pengaturan.php' ? 'active' : '' ?>">⚙️ Pengaturan</a>

     <a class="logout-btn btn-danger" onclick="logout()">🚪 Keluar</a>    
</div>


<!-- ✅ CONTENT -->
<div class="content">
  <h3>👥 Tambah Peserta</h3>

  <div class="form-card mt-3">

    <form action="tambahpeserta-buat.php" method="POST">

      <div class="mb-3">
        <label>Nama Peserta</label>
        <input type="text" class="form-control" name="nama" required>
      </div>

      <div class="mb-3">
        <label>Email Peserta</label>
        <input type="email" class="form-control" name="email" required>
      </div>

      <button type="submit" class="btn btn-primary">✅ Simpan</button>

    </form>

    <hr>

    </table>

  </div>
</div>

 <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    function logout() {
      alert("Anda telah keluar dari dashboard admin.");
      window.location.href = "menu home.php";
    }
  </script>
</body>
</html>
