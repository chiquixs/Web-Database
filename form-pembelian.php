<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css" />
  <title>Form Pembelian - Rebant</title>
</head>
<body>

<div class="container">
  <h2>Form Pembelian</h2>
  <div class="produk-detail" id="produkDetail">
    <!-- Detail produk akan muncul di sini -->
  </div>

  <form id="pembelianForm" action="#" method="post">
    <input type="text" name="nama" placeholder="Nama Pembeli" required />
    <input type="text" name="no_hp" placeholder="Nomor HP" required />
    <textarea name="alamat" rows="3" placeholder="Alamat Lengkap" required></textarea>
    <button type="submit">Pesan Sekarang</button>
  </form>
</div>

<script>
  // Data produk dummy (sama seperti di pembelian.html)
  const produkData = {
    "titik_kumpul": {
      "nama": "Titik Kumpul",
      "ukuran": "30x40",
      "harga": 50000,
      "gambar": "gambar1.jpg"
    },
    "rumah_idaman": {
      "nama": "Rumah Idaman",
      "ukuran": "40x60",
      "harga": 75000,
      "gambar": "gambar2.jpg"
    }
    // bisa tambah produk lain di sini
  };

  // Ambil parameter produk dari URL
  const urlParams = new URLSearchParams(window.location.search);
  const produkKey = urlParams.get('produk');

  const produkDetailDiv = document.getElementById('produkDetail');

  if (produkKey && produkData[produkKey]) {
    const p = produkData[produkKey];
    produkDetailDiv.innerHTML = `
      <img src="${p.gambar}" alt="${p.nama}">
      <h3>${p.nama}</h3>
      <p>Ukuran: ${p.ukuran}</p>
      <p>Harga: Rp${p.harga.toLocaleString('id-ID')}</p>
    `;
  } else {
    produkDetailDiv.innerHTML = '<p>Produk tidak ditemukan.</p>';
  }

  // Optional: submit form handler (untuk testing)
  document.getElementById('pembelianForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Form pembelian berhasil dikirim! (fitur backend menyusul)');
  });
</script>

</body>
</html>
