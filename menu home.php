<?php
session_start();
include 'koneksi.php'; // tetap sama

$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = mysqli_real_escape_string($koneksi, $_POST['user']);
    $pass = $_POST['pass'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' LIMIT 1");

    if ($row = mysqli_fetch_assoc($query)) {

        if (password_verify($pass, $row['password'])) {

            // ================= SESSION =================
            $_SESSION['login']      = true; 
            $_SESSION['username']   = $row['username']; // penting untuk dashboard
            $_SESSION['user_id']    = $row['id'];
            $_SESSION['role']       = $row['role'];

            if ($row['role'] === 'admin') {
                $_SESSION['notif'] = "Selamat datang Admin!";
                header("Location: dashboard_admin.php");
                exit();
            } elseif ($row['role'] === 'peserta') {
                $_SESSION['peserta_id'] = $row['id'];
                $_SESSION['notif'] = "Login berhasil, selamat datang!";
                header("Location: dashboardpeserta.php");
                exit();
            } else {
                $error = "Role tidak dikenali!";
            }

        } else {
            $error = "Password salah!";
        }

    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notulen Rapat | Kirim</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

:root{
  --primary:#ff8c42;
  --dark:#0f172a;
  --soft:#f8fafc;
  --glass:rgba(255,255,255,.75);
}

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Inter',sans-serif;
}

body{
  background: linear-gradient(135deg,#f8fafc,#eef2ff);
  color:var(--dark);
}

/* ================= HEADER ================= */
header{
  position:sticky;
  top:0;
  z-index:999;
  background:rgba(140, 177, 255, 0.85);
  backdrop-filter: blur(14px);
  border-bottom:1px solid #e5e7eb;
  padding:16px 60px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

header h1{
  font-weight:800;
  font-size:26px;
  color:var(--dark);
}

nav a{
  margin-left:32px;
  text-decoration:none;
  font-weight:600;
  color:#475569;
  transition:.2s;
}
nav a:hover{
  color:var(--primary);
}

/* ================= HERO ================= */
.hero{
  min-height:90vh;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  text-align:center;
  padding:0 20px;
  background:
  radial-gradient(circle at 20% 20%, #8fc3ffff, transparent 40%),
  radial-gradient(circle at 80% 80%, #c7d2fe, transparent 40%);
}

.hero h2{
  font-size:54px;
  font-weight:900;
  line-height:1.2;
  max-width:840px;
}

.hero h2 span{
  color:var(--primary);
}

.hero p{
  margin-top:20px;
  font-size:20px;
  max-width:620px;
  color:#475569;
}

.hero button{
  margin-top:40px;
  padding:16px 48px;
  border:none;
  border-radius:999px;
  background:linear-gradient(135deg, #60a5fa, #93c5fd);
  color:white;
  font-weight:700;
  font-size:17px;
  box-shadow:0 15px 40px rgba(66, 183, 255, 0.35);
  transition:.3s;
}

.hero button:hover{
  transform:translateY(-3px);
  box-shadow:0 25px 55px rgba(66, 148, 255, 0.45);
}

/* ================= MODAL LOGIN ================= */
.modal-content{
  border-radius:22px;
  border:none;
  background:var(--glass);
  backdrop-filter:blur(18px);
  box-shadow:0 30px 80px rgba(77, 151, 255, 0.25);
}

.modal-header{
  background:linear-gradient(135deg, #60a5fa, #93c5fd);
  color:white;
  border:none;
  border-radius:22px 22px 0 0;
}

.modal-body h3{
  font-weight:800;
}

.form-control{
  border-radius:12px;
  height:48px;
}

.btn-primary{
  background: linear-gradient(135deg, #60a5fa, #93c5fd); /* biru muda */
  border: none;
  height: 48px;
  font-weight: 700;
  border-radius: 12px;
  color: white;
}
.alert-login{
  border-radius:14px;
  padding:14px 18px;
  font-weight:600;
  animation: shake .4s ease;
}

/* animasi getar saat error */
@keyframes shake{
  0%{transform: translateX(0);}
  25%{transform: translateX(-6px);}
  50%{transform: translateX(6px);}
  75%{transform: translateX(-6px);}
  100%{transform: translateX(0);}
}


.btn-primary:hover{
  background: linear-gradient(135deg, #3b82f6, #60a5fa); /* biru hover */

}

/* ================= SECTION ================= */
#tentang, #kontak{
  padding:120px 20px;
}

#tentang{
  background:white;
}

#tentang h2,
#kontak h2{
  font-weight:900;
  text-align:center;
}

#tentang p{
  color:#475569;
  max-width:720px;
  margin:auto;
  text-align:center;
}

/* ================= CARD ================= */
.card-animate{
  background:white;
  border-radius:24px;
  padding:32px;
  text-align:center;
  box-shadow:0 12px 35px rgba(0,0,0,.08);
  transition:.3s;
  border:1px solid #e5e7eb;
}

.card-animate:hover{
  transform:translateY(-10px);
  box-shadow:0 25px 65px rgba(0,0,0,.15);
}

.card-animate h5{
  font-weight:800;
  margin-bottom:12px;
}

/* ================= KONTAK ================= */
#kontak{
  background:linear-gradient(135deg,#f8fafc,#eef2ff);
}

#kontak .p-3{
  border-radius:18px;
  background:white;
  border:1px solid #e5e7eb;
}

/* ================= FOOTER ================= */
footer{
  background:linear-gradient(135deg, #60a5fa, #93c5fd);;
  color:#cbd5f5;
  text-align:center;
  padding:32px;
  font-size:14px;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
  header{
    padding:16px 20px;
  }
  nav{
    display:none;
  }

  .hero h2{
    font-size:36px;
  }
}
</style>

</head>

<body>

  <!-- HEADER -->
  <header>
    <h1>Notudesk</h1>
    <nav>
      <a href="#hero">Beranda</a>
      <a href="#tentang">Tentang</a>
      <a href="#kontak">Kontak</a>
    </nav>
  </header>

  <!-- HERO -->
  <section id="hero" class="hero">
  <h2>
    Catatan Rapat <span>Berkualitas</span><br>
    & Instan 
  </h2>
  <p>
    Catat, simpan, dan kelola notulen rapat secara modern, cepat, dan aman berbasis web.
  </p>
  <button data-bs-toggle="modal" data-bs-target="#loginModal">
    Masuk ke Akun Anda
  </button>
</section>


  <!-- MODAL LOGIN -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content shadow">

        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Form Login</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <?php if (isset($error)) : ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
       <form  method="POST">
            <div class="text-center mb-4">
              <h3 class="fw-bold">Notudeks</h3>
            </div>

            <div class="mb-3">
                <label for="user" class="form-label">Username</label>
                <input type="text" class="form-control" id="user" name="user" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
            </div>
             <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
          <p class="text-center mt-3">
                        belum punya akun? <a href="register.php">register di sini</a>
                    </p>
        </div>

      </div>
    </div>
  </div>

  <!-- SECTION TENTANG -->
  <section id="tentang">
    <div class="container">
      <h2 class="fw-bold text-center mb-4">Tentang Notudeks</h2>

      <p class="text-center mb-4">
        Notudeks adalah platform digital untuk membantu Anda membuat, menyimpan, dan mengelola notulen rapat
        dengan lebih mudah dan terstruktur.
      </p>

      <div class="row g-4 mt-4">
        <div class="col-md-4">
          <div class="card-animate">
            <h5 class="fw-bold">📄 Pencatatan Cepat</h5>
            <p>Mencatat poin rapat dengan mudah menggunakan tampilan sederhana & rapi.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-3 shadow-sm bg-white rounded-3 card-animate card-hover">
            <h5 class="fw-bold">☁ Penyimpanan Aman</h5>
            <p>Semua notulen tersimpan aman dan dapat diakses kapan saja.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-3 shadow-sm bg-white rounded-3 card-animate card-hover">
            <h5 class="fw-bold">🔗 Berbagi Mudah</h5>
            <p>Bagikan notulen rapat ke anggota tim secara instan.</p>
          </div>
        </div>
      </div>
    </div>
    
  </section>

  <!-- KONTAK -->
  <section id="kontak">
    <div class="container text-center">
      <h2 class="fw-bold mb-3">Kontak Kami</h2>

      <p class="text-secondary mb-4">Hubungi kami melalui kontak atau media sosial berikut.</p>

      <div class="d-flex flex-column align-items-center gap-3">

        <div class="p-3 rounded-3 bg-white shadow-sm d-flex align-items-center gap-2">
          <i class="fas fa-phone text-primary fs-4"></i>
          <span class="fw-semibold">0812-3456-7890</span>
        </div>

        <div class="p-3 rounded-3 bg-white shadow-sm d-flex align-items-center gap-2">
          <i class="fas fa-envelope text-primary fs-4"></i>
          <span class="fw-semibold">support@notudeks.com</span>
        </div>

       <div class="d-flex justify-content-center gap-3 fs-4">
        <a href="#" style="color:#1877f2;"><i class="fa-brands fa-facebook social-icon"></i></a>   
        <a href="#" style="color:#e4405f;"><i class="fa-brands fa-instagram social-icon"></i></a>  
        <a href="#" style="color:#1da1f2;"><i class="fa-brands fa-twitter social-icon"></i></a>    
      </div>


          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>© 2025 NOTUDEKS — Semua Hak Dilindungi</footer>

  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- ANIMASI JAVASCRIPT -->
  <script>
    const fadeElements = document.querySelectorAll('.fade-in');
    const cards = document.querySelectorAll('.card-animate');

    function checkScroll() {
      fadeElements.forEach(el => {
        if (el.getBoundingClientRect().top < window.innerHeight - 80) {
          el.classList.add('show');
        }
      });

      cards.forEach(card => {
        if (card.getBoundingClientRect().top < window.innerHeight - 80) {
          card.classList.add('show');
        }
      });
    }

    window.addEventListener('scroll', checkScroll);
    window.addEventListener('load', checkScroll);
  </script>

<?php if (isset($error)) : ?>
<script>
  var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
  loginModal.show();
</script>
<?php endif; ?>


</body>

</html>
