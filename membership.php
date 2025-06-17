<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $kategori = $_POST['kategori'];

    // menyimpan
    mysqli_query($koneksi, "INSERT INTO member (nama, umur, kategori) VALUES ('$nama', $umur, '$kategori')");

    // ambil id member terakir
    $id_member = mysqli_insert_id($koneksi);

    echo "<script>alert('Berhasil menjadi member!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Membership - Rebant</title>

</head>
<body>
  <div class="container">
    <h2>Join Our Membership Now</h2>
    <form action="" method="post">
      <input type="text" name="nama" placeholder="Nama Lengkap" required />
      <input type="number" name="umur" placeholder="Umur" required />

      <select name="kategori" required>
        <option value="" disabled selected>Pilih Kategori</option>
        <option value="gold">Gold</option>
        <option value="silver">Silver</option>
        <option value="bronze">Bronze</option>
      </select>

      <button type="submit">Daftar Sekarang</button>
    </form>
  </div>
</body>
</html>
