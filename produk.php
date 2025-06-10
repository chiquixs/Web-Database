

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
  <h2 style="text-align:center; margin-top:30px;">Daftar Produk Rebant</h2>

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
      echo "<button>Beli</button>";
      echo "</div>";
    }
    ?>
  </div>
</body>
</html>

