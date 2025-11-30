// Tunggu sampai halaman siap
document.addEventListener("DOMContentLoaded", function () {
  // Ambil elemen form
  const form = document.querySelector("#loginModal form");
  const usernameInput = document.getElementById("username");
  const passwordInput = document.getElementById("password");
  const rememberCheckbox = document.getElementById("rememberMe");

  // Saat form dikirim
  form.addEventListener("submit", function (e) {
    e.preventDefault(); // cegah reload halaman

    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    // 🔹 Daftar akun contoh
    const users = {
      admin: {
        username: "",
        password: "",
        redirect: "dashboard_admin.html",
      },
      peserta: {
        username: "peserta",
        password: "abcde",
        redirect: "dashboardpeserta.html",
      },

    };

    // 🔹 Validasi login
    if (users[username] && users[username].password === password) {
      const userData = users[username];

      // Jika "ingat saya" dicentang
      if (rememberCheckbox.checked) {
        localStorage.setItem("rememberedUser", username);
      } else {
        localStorage.removeItem("rememberedUser");
      }

      // Simpan data login
      localStorage.setItem("username", userData.username);
      localStorage.setItem("role", username);

      alert(`Selamat datang, ${userData.username}!`);

      // Tutup modal login (kalau pakai Bootstrap)
      const modal = bootstrap.Modal.getInstance(document.getElementById("loginModal"));
      if (modal) modal.hide();

      // Arahkan ke halaman sesuai role
      window.location.href = userData.redirect;
    } else {
      alert("Username atau password salah!");
    }
  });

  // 🔹 Isi otomatis jika user pernah centang "ingat saya"
  const rememberedUser = localStorage.getItem("rememberedUser");
  if (rememberedUser && users[rememberedUser]) {
    usernameInput.value = users[rememberedUser].username;
    rememberCheckbox.checked = true;
  }
});
