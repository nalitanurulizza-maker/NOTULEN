const form = document.getElementById('notulenForm');
    const list = document.getElementById('notulenList');
    let arsip = JSON.parse(localStorage.getItem('arsipNotulen')) || [];

    function tampilkan() {
      list.innerHTML = '';
      arsip.forEach((n, i) => {
        const row = `<tr>
          <td>${n.judul}</td>
          <td>${n.tanggal}</td>
          <td>${n.isi}</td>
          <td><button class="delete-btn" onclick="hapus(${i})">Hapus</button></td>
        </tr>`;
        list.innerHTML += row;
      });
    }

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const data = {
        judul: document.getElementById('judul').value,
        tanggal: document.getElementById('tanggal').value,
        isi: document.getElementById('isi').value,
      };
      arsip.push(data);
      localStorage.setItem('arsipNotulen', JSON.stringify(arsip));
      form.reset();
      tampilkan();
    });

    function hapus(index) {
      arsip.splice(index, 1);
      localStorage.setItem('arsipNotulen', JSON.stringify(arsip));
      tampilkan();
    }

    tampilkan();

    // Navigasi antar halaman
    function tampilkanHalaman(nama) {
      document.querySelectorAll('[id^="halaman-"]').forEach(el => el.style.display = 'none');
      document.getElementById('halaman-' + nama).style.display = 'block';

      document.querySelectorAll('.menu a').forEach(link => link.classList.remove('active'));
      event.target.classList.add('active');
    }