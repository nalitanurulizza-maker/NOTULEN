<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Notulen Admin</title>
  <link rel="stylesheet" href="arsip.css">
</head>
<body>
  <div class="container">
    <!-- SIDEBAR -->
  <div class="sidebar">
    <h2>📝 NOTUDEKS</h2>
    <a href="dashboard_admin.php">📊 Dashboard</a>
    <a href="buat-notulen.php" >📝 Buat Notulen</a>
    <a href="daftar-notulen.php">📁 Daftar Notulen</a>
    <a href="arsip.php"style="background-color: rgba(255,255,255,0.2);">📂 Arsip</a>
    <a href="pengaturan.php">⚙️ Pengaturan</a>

    <a class="logout-btn" href="logout.html">🚪 Keluar</a>
  </div>


    <!-- Main Content -->
    <main class="main-content">
      <header class="header">
        <h1>Arsip Notulen</h1>
        <div class="actions">
        </div>
      </header>

      <div class="search-bar">
      </div>

      <!-- Table -->
      <table class="notulen-table">
        <thead>
          <tr>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" placeholder="Judul"></td>
            <td><input type="date" class="tanggal"></td>
            <td><span class="status diarsipkan"></span></td>
            <td>
              <button class="btn">Lihat</button>
              <button class="btn">Unduh</button>
              <button class="btn">Edit</button>
            </td>
          </tr>
          <tr>
            <td><input type="text" placeholder="Judul"></td>
            <td><input type="date" class="tanggal"></td>
            <td><span class="status aktif"></span></td>
            <td>
              <button class="btn">Lihat</button>
              <button class="btn">Unduh</button>
              <button class="btn">Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </main>
  </div>
</body>
</html>
