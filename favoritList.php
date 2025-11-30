<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Notulen — Favorit</title>
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
  </header>

  <main class="container-wide page">

    <section class="notulen-area">
      <div class="card">
        <div class="section-head">
          <h2>Notulen Favorit</h2>
          <div class="right-controls">
            <input placeholder="Pencarian global" />
            <button class="btn secondary">Urutkan</button>
          </div>
        </div>

        <div class="cards-list">
          <article class="card notulen-card">
            <div class="meta">
              <span class="tag tag-success">Final</span>
              <h3>Evaluasi Proyek X <span class="label">Prioritas</span></h3>
              <p class="muted-sm">Penanggung jawab: Dika</p>
            </div>
            <div class="right">
              <p class="muted-sm">08 Sep 2025 • 10:30</p>
              <div class="card-actions">
                <button class="icon-btn btn-download">⬇️</button>
                <button class="icon-btn btn-share">🔗</button>
              </div>
            </div>
          </article>

          <article class="card notulen-card">
            <div class="meta">
              <span class="tag tag-warning">Draft</span>
              <h3>Weekly PMM <span class="label">Kampanye</span></h3>
              <p class="muted-sm">Penanggung jawab: Rani</p>
            </div>
            <div class="right">
              <p class="muted-sm">06 Sep 2025 • 09:00</p>
              <div class="card-actions">
                <button class="icon-btn btn-download">⬇️</button>
                <button class="icon-btn btn-share">🔗</button>
              </div>
            </div>
          </article>
        </div>

        <div class="footer-note">
          <p>2 favorit • Diurutkan berdasarkan terbaru</p>
          <div>
            <button class="btn secondary">Kelola tag</button>
            <button class="btn secondary">Lihat semua</button>
          </div>
        </div>
      </div>
    </section>
  </main>

  <div id="modal-root"></div>
  <script src="script.js"></script>
</body>
</html>
