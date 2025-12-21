<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "notulen");

$data = mysqli_query($koneksi, "SELECT * FROM pengaturan WHERE id=1");
$set  = mysqli_fetch_assoc($data);

// PROSES SIMPAN
if (isset($_POST['simpan'])) {

    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $pass  = $_POST['password'];

    if ($pass != "") {
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "UPDATE pengaturan SET 
                email_admin='$email',
                password_admin='$pass'
                WHERE id=1";
    } else {
        $sql = "UPDATE pengaturan SET 
                email_admin='$email'
                WHERE id=1";
    }

    mysqli_query($conn, $sql);
    $_SESSION['notif'] = "Pengaturan berhasil diperbarui!";
    header("Location: pengaturan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pengaturan Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      width: 100%;
    }

    /* Card hover */
    .card-custom {
      transition: 0.2s;
    }

    .card-custom:hover {
      transform: translateY(-4px);
    }

    .btn-simpan {
      background: linear-gradient(135deg, #0d6efd, #00c6ff);
      border: none;
      color: white;
      font-weight: 600;
    }
  </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>📝 NOTUDEKS</h2>

    <a href="dashboard_admin.php">📊 Dashboard</a>
    <a href="buat-notulen.php">📝 Buat Notulen</a>
    <a href="tambah_peserta.php">👥 Tambah Peserta</a>
    <a href="daftar-notulen.php">📁 Daftar Notulen</a>
    <a href="arsip.php">📂 Arsip</a>
    <a href="pengaturan.php" class="active">⚙️ Pengaturan</a>

   <a class="logout-btn" onclick="logout()">🚪 Keluar</a>
</div>
<!-- MAIN CONTENT -->
<main class="main-content">

  <h1 class="fw-bold mb-2">Pengaturan Admin ⚙️</h1>
  <p class="text-secondary mb-4">Kelola email dan keamanan akun admin Anda.</p>

  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card p-4 shadow-sm card-custom">
        <h4 class="text-primary mb-4">Pengaturan Akun</h4>

        <form method="post">

          <div class="mb-3">
            <label class="form-label fw-semibold">Email Admin</label>
            <input type="email" name="email" value="<?= $set['email_admin']; ?>" class="form-control" required>
          </div>

          <div class="mb-4">
            <label class="form-label fw-semibold">Password Baru</label>
            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
          </div>

          <button type="submit" name="simpan" class="btn btn-simpan w-100 py-2">
            💾 Simpan Perubahan
          </button>

        </form>
      </div>

    </div>
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
