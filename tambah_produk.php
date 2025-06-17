<?php
include 'koneksi.php';

$adminPassword = "KACAW"; // Ganti sesuai keinginan
$showForm = false;
$error = "";

// form password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["password"])) {
    if ($_POST["password"] === $adminPassword) {
        $showForm = true;
    } else {
        $error = "Password salah!";
    }
}

// form tambah produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_produk"])) {
    $id_produk = $_POST["id_produk"];
    $nama_produk = $_POST["nama_produk"];
    $ukuran = $_POST["ukuran"];
    $stok = $_POST["stok"];
    $harga = $_POST["harga"];
    $id_kategori = $_POST["id_kategori"];

    // upload gambar
    $gambar = $_FILES["gambar"]["tmp_name"];
    $gambar_name = $_FILES["gambar"]["name"];
    $ext = strtolower(pathinfo($gambar_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];

    if (in_array($ext, $allowed_ext)) {
        $target = "image/" . $id_produk . "." . $ext;

        if (move_uploaded_file($gambar, $target)) {
            // Simpan data ke database
            $query = "INSERT INTO produk (id_produk, id_kategori, nama_produk, ukuran, stok, harga) VALUES ('$id_produk', '$id_kategori', '$nama_produk', '$ukuran', $stok, $harga)";

            if (mysqli_query($koneksi, $query)) {
                echo "<script>alert('Produk dan gambar berhasil ditambahkan!'); window.location.href='produk.php';</script>";
                exit;
            } else {
                $error = "Gagal menyimpan ke database: " . mysqli_error($koneksi);
            }
        } else {
            $error = "Gagal mengunggah gambar.";
        }
    } else {
        $error = "Format gambar tidak didukung (hanya jpg, jpeg, png, webp).";
    }

    $showForm = true; // tetap tampilkan form kalau gagal
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk - Rebant</title>
    <link rel="stylesheet" href="style.css">
    <style>
       

    </style>
</head>
<body>

<?php if (!$showForm): ?>
    <div class="form-box">
        <h2>Masukkan Password Admin</h2>
        <form method="post">
            <input type="password" name="password" placeholder="Password admin" required>
            <button type="submit">Submit</button>
        </form>
        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
    </div>

<?php else: ?>
    <div class="form-box">
        <h2>Form Tambah Produk</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="id_produk" placeholder="ID Produk (misal: P001)" required>
            <input type="text" name="nama_produk" placeholder="Nama Produk" required>
            <input type="text" name="ukuran" placeholder="Ukuran (misal: 30x40)" required>
            <input type="number" name="stok" placeholder="Stok" required>
            <input type="number" name="harga" placeholder="Harga (misal: 50000)" required>
            <input type="text" name="id_kategori" placeholder="ID Kategori (misal: K001)" required>

            <label for="gambar" class="custom-file-upload">📁 Upload Gambar</label>
            <input type="file" name="gambar" id="gambar" accept="image/*" required>


            <button type="submit" name="submit_produk" class="btn-tbh" style="width= 700px">Tambah Produk</button>
        </form>

    </div>
<?php endif; ?>

</body>
</html>
