<?php
include 'koneksi.php';

$query = "
SELECT p.nama_produk, k.nama_kategori 
FROM produk p 
JOIN kategori k on p.id_kategori = k.id_kategori 
";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Kategori Produk</title>
</head>
<body>
    <div class="container">
        <h2>Kategori Produk</h2>

    <table>
        <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Kategori</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['nama_produk']}</td>
                    <td>{$row['nama_kategori']}</td>
                </tr>";
            $no++;
        }
        ?>
        </tbody>
    </table>

    <div style="text-align:center;">
        <a href="produk.php" class="back-btn">← Back</a>
    </div>
    </div>
</body>
</html>