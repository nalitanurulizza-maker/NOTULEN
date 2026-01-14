<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buat / Edit Notulen</title>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />

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
      background-color: rgba(255, 255, 255, 0.2);
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
  <a href="buat-notulen.php" style="background-color: rgba(255,255,255,0.2);">
    📝 Buat Notulen
  </a>
  <a href="tambah_peserta.php">👥 Tambah Peserta</a>
  <a href="daftar-notulen.php">📁 Daftar Notulen</a>
  <a href="arsip.php">📂 Arsip</a>
  <a href="pengaturan.php">⚙️ Pengaturan</a>

  <a class="logout-btn btn-danger" onclick="logout()">🚪 Keluar</a>
</div>

<!-- ========== CONTENT ========= -->
<div class="content">

  <header>
    <h1>📝 Buat / Edit Notulen</h1>
  </header>

  <div class="form-card">

    <form
      id="notulenForm"
      method="POST"
      action="simpan-notulen.php"
      enctype="multipart/form-data"
    >

      <!-- Judul -->
      <div class="mb-3">
        <label class="form-label">Judul Rapat</label>
        <input
          type="text"
          name="judul"
          class="form-control"
          placeholder="Contoh: Rapat Koordinasi Minggu"
        >
      </div>

      <!-- Tanggal & Waktu -->
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Tanggal Rapat</label>
          <input type="date" name="tanggal" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Waktu Rapat</label>
          <input type="time" name="waktu" class="form-control">
        </div>
      </div>

      <!-- Isi -->
      <div class="mb-3">
        <label class="form-label">Isi Notulen</label>
        <textarea
          name="isi"
          rows="5"
          class="form-control"
          placeholder="Poin penting 1&#10;Poin penting 2&#10;Keputusan: ..."
        ></textarea>
      </div>

      <!-- Peserta -->
      <h3>👥 Daftar Peserta</h3>
      <hr>

      <table class="table table-striped table-bordered">
        <thead class="text-center">
          <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>EMAIL</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $queryPeserta = mysqli_query($koneksi, "SELECT * FROM daftar_peserta");
          $no = 1;
          while ($peserta = mysqli_fetch_assoc($queryPeserta)) :
          ?>
            <tr>
              <td class="text-center"><?= $no++; ?></td>
              <td><?= htmlspecialchars($peserta['nama']); ?></td>
              <td><?= htmlspecialchars($peserta['email']); ?></td>
              <td class="text-center">
                <a
                  href="hapuspeserta-buat.php?id=<?= $peserta['id']; ?>"
                  class="btn btn-danger btn-sm"
                  onclick="return confirm('Yakin ingin menghapus peserta ini?')"
                >
                  🗑 Hapus
                </a>
              </td>
            </tr>
          <?php endwhile; ?>

        </tbody>
      </table>

      <!-- Lampiran -->
      <div class="mb-4">
  <label class="form-label fw-semibold">Lampiran</label>
  <input
    type="file"
    name="lampiran"
    class="form-control"
    accept=".pdf,.doc,.docx"
  >
  <small class="text-muted">
    Format yang diperbolehkan: PDF, DOC, DOCX. Ukuran maksimal 2 MB.
  </small>
</div>

      <!-- Tombol -->
      <div class="d-flex gap-2">
        <button type="submit" name="aksi" value="simpan" class="btn btn-primary">
          💾 Simpan
        </button>
        <button type="submit" name="aksi" value="arsip" class="btn btn-warning">
          🗂 Arsipkan
        </button>
      </div>

    </form>

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
