<?php
include 'koneksi.php';

$nama = $_GET['nama'] ?? '';
$ukuran = $_GET['ukuran'] ?? '';
$harga = $_GET['harga'] ?? '';
$produk = $_GET['produk'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css" />
  <title>Form Pembelian - Rebant</title>
</head>

<body>
  <div class="container">
    <h2>Form Pembelian</h2>

    <div class="produk-detail">
    <?php
    if ($nama && $ukuran && $harga) {
      echo "<h3>$nama</h3>";
      echo "<p>Ukuran: $ukuran</p>";
      echo "<p>Harga: Rp " . number_format($harga, 0, ',', '.') . "</p>";
    } else {
      echo "<p>Produk tidak ditemukan.</p>";
    }
    ?>
  </div>

  <form id="pembelianForm" method="post">
    <input type="text" name="nama" placeholder="Nama Pembeli" required />
    <input type="text" name="no_hp" placeholder="Nomor HP" required />
    <input type="email" name="email" placeholder="Email" required />
    <textarea name="alamat" rows="3" placeholder="Alamat Lengkap" required></textarea>
    <label>Jumlah:</label>
    
    <div style="display:flex; gap:10px;" class="btn-form">
      <button type="button" onclick="kurangi()">-</button>
      <input type="number" name="jumlah" id="jumlah" value="1" min="1" style="width: 50px;" />
      <button type="button" onclick="tambah()">+</button>
    </div>

    <input type="hidden" name="id_produk" value="<?= htmlspecialchars($produk) ?>">
    <input type="hidden" name="nama_produk" value="<?= htmlspecialchars($nama) ?>">
    <input type="hidden" name="harga_produk" value="<?= htmlspecialchars($harga) ?>">
    <button type="submit" name="submit" class="btn-pesan">Pesan Sekarang</button>
  </form>

  <?php
  

if (isset($_POST['submit'])) {
  $namaPembeli = $_POST['nama'];
  $no_hp = $_POST['no_hp'];
  $email = $_POST['email'];
  $alamat = $_POST['alamat'];
  $jumlah = (int)$_POST['jumlah'];
  $id_produk = $_POST['id_produk'];
  $harga = (int)$_POST['harga_produk'];
  $subtotal = $harga * $jumlah;

    // 1. cek stok 
    $cekStok = mysqli_query($koneksi, "SELECT stok FROM produk WHERE id_produk = '$id_produk'");
    $dataStok = mysqli_fetch_assoc($cekStok);

    if (!$dataStok || $dataStok['stok'] < $jumlah) {
      echo "<div style='color:red; margin-top:20px; text-align:center;'>Stok tidak mencukupi. Silakan kurangi jumlah pembelian.</div>";
      exit;
    }

    // 2. cek apakah pembeli member
    $cekMember = mysqli_query($koneksi, "SELECT id_member FROM member WHERE nama = '$namaPembeli' LIMIT 1");
    $dataMember = mysqli_fetch_assoc($cekMember);
    $id_member = $dataMember ? $dataMember['id_member'] : 'NULL';

    // 3. cek apakah pembeli sudah ada
    $cekPembeli = mysqli_query($koneksi, "
      SELECT id_pembeli FROM pembeli 
      WHERE nama = '$namaPembeli' AND email = '$email' AND alamat = '$alamat' AND no_hp = '$no_hp'
      LIMIT 1
    ");

    if (mysqli_num_rows($cekPembeli) > 0) {
      $dataPembeli = mysqli_fetch_assoc($cekPembeli);
      $id_pembeli = $dataPembeli['id_pembeli'];
    } else {
      $insertPembeli = mysqli_query($koneksi, "
        INSERT INTO pembeli (nama, no_hp, alamat, email, id_member)
        VALUES ('$namaPembeli', '$no_hp', '$alamat', '$email', $id_member)
      ");
      $id_pembeli = mysqli_insert_id($koneksi);
    }

    // 4. masukkan data ke tabel transaksi
    $queryTransaksi = "INSERT INTO transaksi (id_pembeli, id_member, tanggal_transaksi) VALUES ($id_pembeli, $id_member, NOW())";
    $simpanTransaksi = mysqli_query($koneksi, $queryTransaksi);

    if ($simpanTransaksi) {
      $id_transaksi = mysqli_insert_id($koneksi); // ambil id transaksi

    // 5. simpan ke tabel detail_transaksi
    $queryDetail = "INSERT INTO detail_transaksi (id_transaksi, id_produk, jumlah, subtotal) VALUES ($id_transaksi, '$id_produk', $jumlah, $subtotal)";
    $simpanDetail = mysqli_query($koneksi, $queryDetail);

    if ($simpanDetail) {
    // 6. kurangi stok
      $updateStok = mysqli_query($koneksi, "
        UPDATE produk SET stok = stok - $jumlah 
        WHERE id_produk = '$id_produk'
      ");

      if ($updateStok) {
        echo "<div style='margin-top:20px; text-align:center; font-weight:bold; color:green'>";
        echo "Transaksi berhasil disimpan!<br>Total yang harus dibayar: Rp " . number_format($subtotal, 0, ',', '.');
        echo "</div>";
      } else {
        echo "<div style='color:red; margin-top:20px; text-align:center;'>Gagal mengurangi stok produk.</div>";
      }

    } else {
      echo "<div style='color:red; margin-top:20px; text-align:center;'>Gagal menyimpan detail transaksi.</div>";
    }

  } else {
    echo "<div style='color:red; margin-top:20px; text-align:center;'>Gagal menyimpan transaksi.</div>";
  }
}
  ?>
</div>

<script>
  function tambah() {
    let input = document.getElementById("jumlah");
    input.value = parseInt(input.value) + 1;
  }

  function kurangi() {
    let input = document.getElementById("jumlah");
    if (parseInt(input.value) > 1) {
      input.value = parseInt(input.value) - 1;
    }
  }
</script>

</body>
</html>
