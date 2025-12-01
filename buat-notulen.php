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
        <h3><i class="fas fa-user-graduate me-2"></i> Daftar Peserta</h3><hr> 
<button type="button" class="btn btn-primary mb-2" 
        data-bs-toggle="modal" 
        data-bs-target="#tambahDataModal">
    <i class="fas fa-plus-circle me-2"></i>TAMBAH DATA PESERTA
</button>

<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataLabel">Tambah Data Peserta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="tambahpeserta-buat.php" method="POST">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NAMA</label>
                        <input type="text" class="form-control" id="nim" name="nim" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">EMAIL</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data --> 
    <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true"> 
      <div class="modal-dialog"> 
        <div class="modal-content"> 
          <div class="modal-header"> 
            <h5 class="modal-title" id="editDataLabel">Edit Data Peserta</h5> 
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          </div> 
          <div class="modal-body"> 
            <form action="ubahpeserta-buat.php" method="POST"> 
              <div class="mb-3"> 
                <label for="edit-nama" class="form-label">Nama</label> 
                <input type="text" class="form-control" id="edit-nama" name="namapeserta" required> 
              </div> 
              <div class="mb-3"> 
                <label for="edit-email" class="form-label">email</label> 
                <input type="text" class="form-control" id="edit-email" name="emailpeserta" required> 
              </div> 
              <button type="submit" class="btn btn-primary">Update</button> 
            </form> 
          </div> 
        </div> 
      </div> 
    </div> 

<table class="table table-striped table-bordered"> 
<thead> 
<tr> 
<th scope="col">NO</th> 
<th scope="col">NAMA</th> 
<th scope="col">EMAIL</th> 
<th scope="col">AKSI</th> 
</tr> 
</thead> 
<tbody> 
<?php 
include 'koneksi.php'; 
$query = mysqli_query($koneksi, "SELECT * FROM `tambah notulen`"); 
$no = 1; 
while ($data = mysqli_fetch_assoc($query)) { 
?> 
<tr> 
<td><?php echo $no++; ?></td> 
<td><?php echo $data['namapeserta']; ?></td> 
<td><?php echo $data['emailpeserta']; ?></td> 
<td>
    <button class= "btn btn-success btn-sm me-l edit-button"
            data-bs-toggle="modal"
            data-bs-target="#editDataModal"
            data-nim="<?php echo $data['namapeserta']; ?>"
            data-nama="<?php echo $data['emailpeserta']; ?>">
    <i class="fas fa-edit"></i> Edit
    </button>
    <a href="hapus_peserta.php?nim=<?php echo $data['namapeserta']; ?>"class="btn btn-danger btn-sm">
        <i class="fas fa-trash-alt"></i> Delete</a>
</td>
</tr>
<?php 
} 
?> 
</tbody>
</table>

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
