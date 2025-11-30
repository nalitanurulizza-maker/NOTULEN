<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Notulen — Beranda Peserta</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
 <!-- Sidebar Kiri -->
<aside class="sidebar">
  <div class="logo">Notudesk</div>

  <nav class="side-menu">
      <a href="dashboardpeserta.html" class="side-link active">Beranda</a>
      <a href="notulen.html" class="side-link">Daftar Notulen</a>
      <a href="favoritList.html" class="side-link">Favorit</a>
      <a href="profil.html" class="side-link">Profil</a>
  </nav>

  <button class="btn-logout" onclick="logout()">Keluar</button>
</aside>

<div class="content-area">
  <!-- 🔹 Main Content -->
  <main class="page-container">
    <!-- Hero Section -->
    <section class="card">
      <h2>Beranda — Peserta Rapat</h2>
      <p>Selamat datang, <strong>Rani</strong>. Akses notulen rapat Anda.</p>
      <input type="text" class="search-input" placeholder="Cari notulen, tanggal, atau kata kunci" />
      <div class="chips">
        <button class="chip">Semua</button>
        <button class="chip">7 hari</button>
        <button class="chip">30 hari</button>
        <button class="chip">Aktif</button>
      </div>
    </section>

    <!-- Notulen Terbaru -->
    <section class="card">
      <h3>Notulen Terbaru</h3>
      <div class="grid">
        <article class="mini-card card">
          <h4>Kickoff Proyek Z <span class="tag tag-success">Aktif</span></h4>
          <p class="muted-sm">02 Sep 2025 • 10:00</p>
          <p>Poin: Target Q4 • Keputusan: Form tim inti</p>
          <div class="mini-actions">
            <button class="btn secondary">Lihat</button>
            <button class="btn secondary">Unduh</button>
          </div>
        </article>

        <article class="mini-card card">
          <h4>Review Sprint 12 <span class="tag tag-success">Aktif</span></h4>
          <p class="muted-sm">29 Agt 2025 • 14:00</p>
          <p>Poin: Bug critical • Keputusan: Tambah resource</p>
          <div class="mini-actions">
            <button class="btn secondary">Lihat</button>
            <button class="btn secondary">Unduh</button>
          </div>
        </article>

        <article class="mini-card card empty">
          <p class="muted">Belum ada notulen terbaru.</p>
        </article>
      </div>
    </main>
    <!-- Detail Notulen -->
    <section class="card">
      <h3>Detail Notulen</h3>
      <p><strong>Evaluasi Proyek X</strong> — 08 Sep 2025 • 10:30</p>
      <div class="chips">
        <button class="chip">Unduh Notulen</button>
        <button class="chip">Bagikan</button>
        <button class="chip">Tandai Favorit</button>
        <button class="chip">Konfirmasi Dibaca</button>
      </div>

      <div class="card inner-card">
        <h4>Poin Penting</h4>
        <ul>
          <li>Update progress setiap tim</li>
          <li>Isu kritikal dan solusi</li>
        </ul>
        <h4>Keputusan</h4>
        <p>Menambah resource tim QA</p>
        <h4>Tindak Lanjut</h4>
        <ul>
          <li>Rani — Rancang mitigasi (12 Sep 2025)</li>
          <li>Dika — Tambah resource (14 Sep 2025)</li>
        </ul>
        <h4>Lampiran</h4>
        <ul>
          <li>notulen-evaluasi.pdf (320 KB)</li>
          <li>agenda-rapat.pdf (145 KB)</li>
        </ul>
        <p class="muted-sm">Riwayat distribusi: Dikirim 12 Sep 2025, 10:45</p>
      </div>
    </section>
    

  <footer class="footer-note">
    <p>© 2025 Notudesk </p>
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
