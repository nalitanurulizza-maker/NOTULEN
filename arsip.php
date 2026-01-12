<?php
require_once 'koneksi.php';

/* ===============================
   PROSES AKSI (ARSIPKAN / PULIHKAN)
   =============================== */
if (isset($_GET['aksi'], $_GET['id'])) {

    $aksi = $_GET['aksi'];
    $id   = (int) $_GET['id'];

    if (in_array($aksi, ['arsipkan', 'pulihkan'], true)) {

        $status = ($aksi === 'arsipkan') ? 'diarsipkan' : 'aktif';

        $stmt = $koneksi->prepare(
            "UPDATE isi_notulen SET status = ? WHERE id = ?"
        );
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();

        $redirect = ($aksi === 'arsipkan')
            ? 'daftar-notulen.php'
            : 'arsip.php';

        header("Location: $redirect");
        exit;
    }
}

/* ===============================
   AMBIL DATA NOTULEN DIARSIPKAN
   =============================== */
$stmt = $koneksi->prepare(
    "SELECT id, judul, tanggal 
     FROM isi_notulen 
     WHERE status = 'diarsipkan' 
     ORDER BY id DESC"
);
$stmt->execute();
$data = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Arsip Notulen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- ================= CSS ASLI (TIDAK DIUBAH) ================= -->
  <style>
    body {
  background: #f5f7fa;
}

/* ================= SIDEBAR ================= */
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
  background-color: rgba(255, 255, 255, 0.2);
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

/* ================= MAIN CONTENT ================= */
.main-content {
  margin-left: 260px;
  padding: 30px;
}

/* ================= STATUS ================= */
.status {
  padding: 4px 10px;
  border-radius: 6px;
  font-weight: bold;
  font-size: 0.85rem;
  display: inline-block;
}

.status.diarsipkan {
  background: #fdecea;
  color: #d62828;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {

  .sidebar {
    position: relative;
    width: 100%;
    height: auto;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
  }

  .main-content {
    margin-left: 0;
  }

}

  </style>
</head>

<body>

<!-- ================= SIDEBAR ================= -->
<div class="sidebar">
  <h2>📝 NOTUDEKS</h2>

  <a href="dashboard_admin.php">📊 Dashboard</a>
  <a href="buat-notulen.php">📝 Buat Notulen</a>
  <a href="tambah_peserta.php">👥 Tambah Peserta</a>
  <a href="daftar-notulen.php">📁 Daftar Notulen</a>
  <a href="arsip.php" class="active">📂 Arsip</a>
  <a href="pengaturan.php">⚙️ Pengaturan</a>

  <a class="logout-btn btn-danger" onclick="logout()">🚪 Keluar</a>  
</div>

<!-- ================= MAIN CONTENT ================= -->
<main class="main-content">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 fw-bold">Arsip Notulen</h1>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover bg-white">
      <thead class="table-primary text-center">
        <tr>
          <th>Judul</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody class="align-middle text-center">

        <?php if ($data->num_rows > 0): ?>
          <?php while ($row = $data->fetch_assoc()): ?>

            <tr>
              <td><?= htmlspecialchars($row['judul']); ?></td>
              <td><?= htmlspecialchars($row['tanggal']); ?></td>
              <td>
                <span class="status diarsipkan">Diarsipkan</span>
              </td>
              <td>
                <a href="detailnotulen.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Lihat</a>
                <a href="edit-notulen.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="arsip.php?aksi=pulihkan&id=<?= $row['id']; ?>"
                   class="btn btn-sm btn-info"
                   onclick="return confirm('Pulihkan notulen ini?')">
                   Pulihkan
                </a>
              </td>
            </tr>

          <?php endwhile; ?>
        <?php else: ?>

          <tr>
            <td colspan="4" class="text-muted py-4">
              Tidak ada notulen yang diarsipkan.
            </td>
          </tr>

        <?php endif; ?>

      </tbody>
    </table>
  </div>

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

<?php
$stmt->close();
?>
