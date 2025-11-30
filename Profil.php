<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Profil Peserta — Notulen</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
 <!-- Sidebar Kiri -->
<aside class="sidebar">
  <div class="logo">Notudesk</div>

  <nav class="side-menu">
      <a href="dashboardpeserta.html" class="side-link">Beranda</a>
      <a href="notulen.html" class="side-link">Daftar Notulen</a>
      <a href="favoritList.html" class="side-link">Favorit</a>
      <a href="profil.html" class="side-link">Profil</a>
  </nav>
  <button class="btn-logout" onclick="logout()">Keluar</button>
</aside>

<div class="content-area">
<!-- 🔹 Konten Utama -->
  <main class="page-container">
    <div class="profile-grid">

      <!-- Kiri -->
      <aside class="profile-left card">
        <h3>Profil Peserta</h3>
        <div class="profile-info">
          <img class="avatar" src="https://i.pravatar.cc/160?img=12" alt="avatar">
          <div class="profile-text">
            <h2>Dody Sinaga </h2>
            <div class="chips">
              <button class="chip">Peserta Rapat</button>
              <button class="chip pink">Read-only</button>
            </div>
          </div>
        </div>

        <div class="info-section">
          <label>Email</label>
          <div class="info-row">
            <input type="text" value="Dody@students.polibatam.com" readonly>
            <button class="btn small ghost">Salin</button>
          </div>

          <label>Nomor Kontak</label>
          <div class="info-row">
            <input type="text" value="62+ 82123456" readonly>
            <button class="btn small secondary">Ubah</button>
          </div>
        </div>
      </aside>

      <!-- Kanan -->
      <section class="profile-right">
        <div class="card stat-row">
          <div class="stat-item">
            <small>Total Notulen Dibintangi</small>
            <h1>12</h1>
          </div>
          <div class="stat-item">
            <small>Unduhan Bulan Ini</small>
            <h1>8</h1>
          </div>
          <div class="stat-item">
            <small>Preferensi</small>
            <ul class="prefs">
              <li>Tema antarmuka: <span class="muted-sm">Sistem</span></li>
              <li>Bahasa aplikasi: <span class="muted-sm">Indonesia</span></li>
              <li>Notifikasi email: <span class="muted-sm">Ringkasan harian</span></li>
            </ul>
          </div>
        </div>

        <div class="card">
          <h3>Aktivitas Terbaru</h3>
          <ul class="activity-list">
            <li>
              <div>
                <strong>Menandai notulen "Weekly PMM" sebagai favorit</strong>
                <p class="muted-sm">06 Sep 2025 • 09:10</p>
              </div>
              <button class="chip">Favorit</button>
            </li>
            <li>
              <div>
                <strong>Mengunduh notulen "Evaluasi Proyek X"</strong>
                <p class="muted-sm">08 Sep 2025 • 11:05</p>
              </div>
              <button class="chip">Unduh</button>
            </li>
            <li>
              <div>
                <strong>Bergabung ke tim "Brand"</strong>
                <p class="muted-sm">01 Sep 2025 • 14:22</p>
              </div>
              <button class="chip">Tim</button>
            </li>
          </ul>
        </div>

        <div class="card">
          <h3>Akses Cepat</h3>
          <div class="quick-actions">
            <button class="btn secondary full">Kelola perangkat terhubung</button>
            <button class="btn secondary full"onclick="logout()">Keluar dari sesi</button>

          </div>
        </div>
      </section>

    </div>
  </main>

  <footer class="footer-note">
    <span>© 2025 NotulenApp</span>
    <span>Dibuat oleh Dody Sinaga</span>
  </footer>
  <script>
    const user = localStorage.getItem("username") || "Admin";
    document.getElementById("username").textContent = user;

    function logout() {
      alert("Anda telah keluar dari dashboard peserta.");
      localStorage.removeItem("username");
      window.location.href = "menu home.html";
    }
  </script>
</body>
</html>
