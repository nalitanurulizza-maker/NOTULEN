<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buat / Edit Notulen</title>

  <!-- Bootstrap -->
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
    <a href="buat-notulen.php" style="background-color: rgba(255,255,255,0.2);">📝 Buat Notulen</a>
    <a href="tambah_peserta.php">👥 Tambah Peserta</a>
    <a href="daftar-notulen.php">📁 Daftar Notulen</a>
    <a href="arsip.php">📂 Arsip</a>
    <a href="pengaturan.php">⚙️ Pengaturan</a>

     <a class="logout-btn btn-danger" onclick="logout()">🚪 Keluar</a> 
  </div>

  <!-- ========== CONTENT AREA ========= -->
  <div class="content">
    <header>
      <h1>📝 Buat / Edit Notulen</h1>
    </header>

    <div class="form-card">

      <form id="notulenForm" method="POST" action="simpan-notulen.php" enctype="multipart/form-data">

        <div class="mb-3">
          <label class="form-label">Judul Rapat</label>
          <input type="text" class="form-control"
            placeholder="Contoh: Rapat Koordinasi Minggu" name="judul">
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Rapat</label>
            <input type="date" class="form-control" name="tanggal">
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Waktu Rapat</label>
            <input type="time" class="form-control" name="waktu">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Isi Notulen</label>
          <textarea rows="5" class="form-control" name="isi"
            placeholder="Poin penting 1&#10;Poin penting 2&#10;Keputusan: ..."></textarea>
        </div>

        <h3><i class="fas fa-user-graduate me-2"></i> Daftar Peserta</h3>
        <hr/>

        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>NO</th>
              <th>NAMA</th>
              <th>EMAIL</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
          
            <?php
            include 'koneksi.php';
            $query = mysqli_query($koneksi, "SELECT * FROM daftar_peserta");
            $no = 1;
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($data['nama']); ?></td>
                <td><?= htmlspecialchars($data['email']); ?></td>
                <td class="text-center">
                  <input type="checkbox" name="hadir[]" value="<?= $data['id']; ?>">
                </td>
              </tr>
            <?php } ?>
              
          </tbody>
        </table>

        <h4>Lampiran</h4>
        <input type="file" class="form-control" id="lampiran" name="lampiran" >
            </div>

        <div class="d-flex gap-2">
          <button type="submit" name="aksi" value="simpan" class="btn btn-primary">💾 Simpan</button>
          <button type="submit" name="aksi" value="terbit" class="btn btn-success">📤 Terbitkan</button>
          <button type="submit" name="aksi" value="arsip" class="btn btn-warning">🗂 Arsipkan</button>
        </div>

      </form>

    </div>
  </div>



    </div>
  </div>
</div>

  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    function logout() {
      alert("Anda telah keluar dari dashboard admin.");
      window.location.href = "menu home.php";
    }
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function () {
          document.getElementById('edit-id').value = this.dataset.id;
          document.getElementById('edit-nama').value = this.dataset.nama;
          document.getElementById('edit-email').value = this.dataset.email;
        });
      });
    });

    
  </script>

</body>
</html>