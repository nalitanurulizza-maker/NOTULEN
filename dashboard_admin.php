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
      background-color: #0d6efd;
      position: fixed;
      left: 0;
      top: 0;
      color: white;
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
  <aside class="sidebar d-flex flex-column">
    <h2 class="fw-bold mb-4">📝 NOTUDEKS</h2>

    <a href="#" class="active">📊 Dashboard</a>
    <a href="buat-notulen.php">📝 Buat Notulen</a>
    <a href="daftar-notulen.php">📁 Daftar Notulen</a>
    <a href="arsip.php">📂 Arsip</a>
    <a href="pengaturan.php">⚙️ Pengaturan</a>

    <div class="logout-btn mt-auto" onclick="logout()">🚪 Keluar</div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    
    <h1 class="fw-bold">Selamat Datang, Admin 👋</h1>
    <p class="text-secondary">Ini adalah halaman utama untuk mengelola sistem Anda.</p>

    <!-- Cards -->
    <div class="row g-4 my-4">
      <div class="col-md-4">
        <div class="card p-3 shadow-sm card-custom">
          <h3 class="h5 text-success">👥 Pengguna</h3>
          <p>Jumlah pengguna terdaftar: <b>25</b></p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow-sm card-custom">
          <h3 class="h5 text-success">🗒️ Notulen</h3>
          <p>Total notulen tersimpan: <b>12</b></p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow-sm card-custom">
          <h3 class="h5 text-success">📊 Laporan</h3>
          <p>Laporan minggu ini: <b>5</b></p>
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
          <tr><td>Dody</td><td>Menambahkan notulen rapat</td><td>06 Okt 2025</td></tr>
          <tr><td>Nalita</td><td>Memperbarui laporan mingguan</td><td>05 Okt 2025</td></tr>
          <tr><td>Andi</td><td>Menambah anggota tim</td><td>04 Okt 2025</td></tr>
        </tbody>
      </table>
    </div>

  </main>

  <script>
    function logout() {
      alert("Anda telah keluar dari dashboard admin.");
      window.location.href = "menu home.php";
    }
  </script>

</body>
</html>
