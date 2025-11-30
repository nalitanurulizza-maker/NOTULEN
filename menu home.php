<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notulen Rapat | Kirim</title>
  <link href="css2.css" rel="stylesheet">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
  
  </head>
<body>
 
  <header>
    <h1>Notudesk</h1>
    <nav>
      <a href="#">Beranda</a>
      <a href="#">Tentang</a>
      <a href="#">Kontak</a>
    </nav>
  </header>

  <section class="hero">
  <h2>Selamat Datang di Notudeks</h2>
  <p>
   Catat, Simpan, dan Bagikan Notulen Rapat Anda
  </p>
<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
</section>

    
  </section>

  <footer>
    © 2025 NOTUDEKS — Semua Hak Dilindungi
  </footer>

<!-- ======================== -->
<!-- MODAL LOGIN -->
<!-- ======================== -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="loginModalLabel">Form Login</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form action="dashboard_admin.php" method="POST">
          <div class="text-center mb-4">
            <h3 class="fw-bold">Notudeks</h3>
          </div>

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
              <input type="text" class="form-control" id="username" placeholder="Masukkan username" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
              <input type="password" class="form-control" id="password" placeholder="Masukkan password" required>
            </div>
          </div>

          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Ingat Saya</label>
          </div>

          <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-sign-in-alt"></i> Masuk
          </button>
        </form>

        <p class="text-center mt-3 mb-1">
          <a href="#" class="link-primary">Lupa Password?</a>
        </p>
      </div>

      <div class="modal-footer">
        <p class="text-center w-100 mb-0">
          Belum punya akun?
          <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">
            Daftar Sekarang
          </a>
        </p>
      </div>
    </div>
  </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
<script src=""></script>
</body>
</html>