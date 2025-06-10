<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="style.css" />
    <title>Pilih Produk - Rebant</title>
</head>
<body>
    <h1 style="text-align: center; margin-top: 30px;">Pilih Produk yang Ingin Dibeli</h1>

    <div class="produk-container">
        <!-- Produk dummy, nanti bisa diganti database -->
    <div class="produk-card">
        <img src="image/gambar1.jpg" alt="Produk A">
        <h3>Titik Kumpul</h3>
        <p>Ukuran: 30x40</p>
        <p>Rp50.000</p>
        <button onclick="window.location.href='form-pembelian.html?produk=titik_kumpul'">Beli</button>
    </div>

    <div class="produk-card">
        <img src="gambar2.jpg" alt="Produk B">
        <h3>Rumah Idaman</h3>
        <p>Ukuran: 40x60</p>
        <p>Rp75.000</p>
        <button onclick="window.location.href='form-pembelian.html?produk=rumah_idaman'">Beli</button>
    </div>
    <div class="produk-card">
  <img src="image/gambar1.jpg" alt="Titik Kumpul">
  <h3>Titik Kumpul</h3>
  <p>Ukuran: 30x40</p>
  <p>Rp50.000</p>
  <!-- tombol beli mengarah ke form-pembelian.php -->
  <button onclick="window.location.href='form-pembelian.php?produk=titik_kumpul'">Beli</button>
</div>

    <!-- Tambah lagi produk lain di sini -->
    </div>
</body>
</html>
