<?php
include 'koneksi.php';

$query = "
    SELECT p.id_produk, p.nama_produk, p.ukuran, p.harga, SUM(d.jumlah) AS total_terjual
    FROM detail_transaksi d
    JOIN produk p ON d.id_produk = p.id_produk
    GROUP BY p.id_produk
    ORDER BY total_terjual DESC
    LIMIT 5
";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css" />
  <title>Produk Terlaris</title>
</head>

<body>
<div class="container">
  <h2>🔥 5 Produk Terlaris 🔥</h2>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Ukuran</th>
        <th>Harga</th>
        <th>Total Terjual</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row['nama_produk']}</td>
                <td>{$row['ukuran']}</td>
                <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                <td>{$row['total_terjual']}</td>
              </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>

  <div style="text-align:center;">
    <a href="produk.php" class="back-btn">← Kembali ke Produk</a>
  </div>
</div>

</body>
</html>
