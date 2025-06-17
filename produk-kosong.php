<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css" />
  <title>Produk Belum Pernah Dibeli</title>
</head>

<body>
  <div class="container">
    <h2>🛒 Orang Lain Belum Punya 🛒</h2>

    <table>
      <tr>
        <th>ID Produk</th>
        <th>Nama Produk</th>
        <th>Ukuran</th>
        <th>Harga</th>
        <th>Stok</th>
      </tr>
      <?php
      $query = "
        SELECT p.id_produk, p.nama_produk, p.ukuran, p.harga, p.stok
        FROM produk p
        LEFT JOIN detail_transaksi dt ON p.id_produk = dt.id_produk
        WHERE dt.id_produk IS NULL
      ";
      $result = mysqli_query($koneksi, $query);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
            <td>{$row['id_produk']}</td>
            <td>{$row['nama_produk']}</td>
            <td>{$row['ukuran']}</td>
            <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
            <td>{$row['stok']}</td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='5'>Semua produk sudah pernah dibeli</td></tr>";
      }
      ?>
    </table>

    <div style="text-align:center;">
      <a href="produk.php" class="back-btn">← Back</a>
    </div>
  </div>

</body>
</html>
