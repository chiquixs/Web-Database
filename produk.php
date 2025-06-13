<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Daftar Produk - Rebant</title>
  <link rel="stylesheet" href="style.css" />
  
</head>
<body>
  <h2 style="text-align:center; margin-top:30px; color:white;">Daftar Produk Rebant</h2>

<div style="text-align: center; margin-top: 30px;">
  <a href="produk_terlaris.php" class="btn-terlaris">🔥 Lihat Produk Terlaris 🔥</a>
  <a href="produk-kosong.php" class="btn-kosong">🛒 Produk Belum Pernah Dibeli</a>
</div>

  <div class="produk-container">
    <?php
    $query = "SELECT * FROM produk";
    $result = mysqli_query($koneksi, $query);

    while($row = mysqli_fetch_assoc($result)) {
      echo "<div class='produk-card'>";
      echo "<img src='image/{$row['id_produk']}.jpg' alt='{$row['nama_produk']}'>";
      echo "<h3>{$row['nama_produk']}</h3>";
      echo "<p>Ukuran: {$row['ukuran']}</p>";
      echo "<p>Stok: {$row['stok']} pcs</p>"; 
      echo "<p>Harga: Rp " . number_format($row['harga'], 0, ',', '.') . "</p>";
      echo "<a href='form-pembelian.php?produk={$row['id_produk']}&nama=" . urlencode($row['nama_produk']) . "&harga={$row['harga']}&ukuran=" . urlencode($row['ukuran']) . "' class='btn-beli'>Beli Sekarang</a>";
      echo "</div>";
    }
    ?>
  </div>
</body>
</html>

