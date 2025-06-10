<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];

    // Simpan ke tabel pembeli
    $query = "INSERT INTO pembeli (nama, no_hp, alamat, email) VALUES ('$nama', '$no_hp', '$alamat', '$email')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Login berhasil!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - Rebant</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="login-container">
    <h2>Login Pembeli</h2>
    <form action="" method="post">
      <input type="text" name="nama" placeholder="Nama Lengkap" required />
      <input type="text" name="no_hp" placeholder="Nomor HP" required />
       <input type="text" name="email" placeholder="Email" required />
      <textarea name="alamat" placeholder="Alamat" required></textarea>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
