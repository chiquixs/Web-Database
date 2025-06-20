<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Daftar Produk - Rebant</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

</head>
<body>
  <h1 style="text-align:center; margin-top:30px; color:white; font-family: 'Poppins', sans-serif;"> Product List </h1>
<div style="text-align: center; margin-top: 30px; font-family: 'Poppins', sans-serif;">
  <a href="produk-kosong.php" class="btn-kosong">Never-Bought Products</a>
  <a href="produk_terlaris.php" class="btn-terlaris">🔥 Best-Selling Products 🔥</a>
  <a href="kategori-produk.php" class="btn-kategori">Products Category</a>
</div>

  <div class="produk-container">
    <?php
    $query = "SELECT * FROM produk";
    $result = mysqli_query($koneksi, $query);

    while($row = mysqli_fetch_assoc($result)) {
      echo "<div class='produk-card'>";
      echo "<img src='image/{$row['id_produk']}.jpg' alt='{$row['nama_produk']}'>";
      echo "<h3>{$row['nama_produk']}</h3>";
      echo "<p>Size   : {$row['ukuran']}</p>";
      echo "<p>Stock : {$row['stok']} pcs</p>"; 
      echo "<p>Price   : Rp " . number_format($row['harga'], 0, ',', '.') . "</p>";
      echo "<a href='form-pembelian.php?produk={$row['id_produk']}&nama=" . urlencode($row['nama_produk']) . "&harga={$row['harga']}&ukuran=" . urlencode($row['ukuran']) . "' class='btn-beli'>Buy Now</a>";
      echo "</div>";
    }
    ?>
  </div>
</body>
</html>

