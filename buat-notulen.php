<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat / Edit Notulen</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* ===== SIDEBAR ===== */
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

    .sidebar a:hover {
      background-color: rgba(255,255,255,0.2);
    }

    .sidebar .logout-btn {
      margin-top: auto;
      background-color: #dc3545 !important;
      font-weight: bold;
      text-align: center;
      border-radius: 6px;
    }

    /* ===== CONTENT AREA ===== */
    .content {
      margin-left: 260px;
      padding: 30px;
    }

    .form-card {
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    header h1 {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>

  <!-- ========== SIDEBAR ========= -->
  <div class="sidebar">
    <h2>📝 NOTUDEKS</h2>

    <a href="dashboard_admin.php">📊 Dashboard</a>
    <a href="buat-notulen.php" style="background-color: rgba(255,255,255,0.2);">📝 Buat Notulen</a>
    <a href="daftar-notulen.php">📁 Daftar Notulen</a>
    <a href="arsip.php">📂 Arsip</a>
    <a href="pengaturan.php">⚙️ Pengaturan</a>

    <a class="logout-btn" href="logout.html">🚪 Keluar</a>
  </div>

  <!-- ========== CONTENT AREA ========= -->
  <div class="content">
    <header>
      <h1>📝 Buat / Edit Notulen</h1>
    </header>

    <div class="form-card">
      <form id="notulenForm">

        <!-- Judul -->
        <div class="mb-3">
          <label class="form-label">Judul Rapat</label>
          <input type="text" class="form-control"
            placeholder="Contoh: Rapat Koordinasi Minggu">
        </div>

        <!-- Tanggal & Waktu -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Rapat</label>
            <input type="date" class="form-control" value="2025-09-12">
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Waktu Rapat</label>
            <input type="time" class="form-control" value="10:30">
          </div>
        </div>

        <!-- Isi Notulen -->
        <div class="mb-3">
          <label class="form-label">Isi Notulen</label>
          <textarea rows="5" class="form-control"
          placeholder="Poin penting 1&#10;Poin penting 2&#10;Keputusan: ..."></textarea>
        </div>

        <!-- Tabel Peserta -->
        <h5 class="mt-4 mb-2">Daftar Peserta</h5>
        <div class="table-responsive">
          <table class="table table-bordered align-middle" id="tabelPenanggungJawab">
            <thead class="table-light">
              <tr>
                <th>Nama</th>
                <th>Tugas</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="text" class="form-control" placeholder="Nama"></td>
                <td><input type="text" class="form-control" placeholder="Tugas"></td>
                <td class="aksi">
                    <button class="btn btn-sm btn-warning me-1">Edit</button>
               <a href="data di hapus.html" class="btn btn-sm btn-danger me-1">Hapus</a>               
              </tr>
            </tbody>  
          </table>
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-success px-3" id="tambahBtn">+ Tambah</button>
        </div>

        <!-- Lampiran -->
        <h4>Lampiran</h4>
        <input type="file" class="form-control mb-3">

        <!-- Buttons -->
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">💾 Simpan</button>
          <button type="button" class="btn btn-success">📤 Terbitkan</button>
          <button type="button" class="btn btn-warning">🗂 Arsipkan</button>
        </div>

      </form>
    </div>
  </div>

  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
