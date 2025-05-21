<?php
include 'db.php';
$id = $_GET['id'];
$query = $conn->query("SELECT * FROM produk WHERE id = $id");
$data = $query->fetch_assoc();

// Tangani update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $deskripsi = $_POST['deskripsi'];
  $kategori = $_POST['kategori'];

  // Update tanpa gambar
  $conn->query("UPDATE produk SET nama='$nama', harga='$harga', deskripsi='$deskripsi', kategori='$kategori' WHERE id=$id");
  header("Location: kelola.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h2>Edit Produk</h2>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" required><?= $data['deskripsi']; ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori" class="form-select" required>
          <option value="">-- Pilih Kategori --</option>
          <option value="Komputer & Aksesoris" <?= $data['kategori'] === 'Komputer & Aksesoris' ? 'selected' : '' ?>>Komputer & Aksesoris</option>
          <option value="Fashion" <?= $data['kategori'] === 'Fashion' ? 'selected' : '' ?>>Fashion</option>
          <option value="Elektronik" <?= $data['kategori'] === 'Elektronik' ? 'selected' : '' ?>>Elektronik</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      <a href="kelola.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</body>
</html>
