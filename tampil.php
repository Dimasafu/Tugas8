<?php
include 'db.php';

// Ambil parameter pencarian dan filter
$search = $_GET['search'] ?? '';
$kategori = $_GET['kategori'] ?? '';

// Query dasar
$sql = "SELECT * FROM produk WHERE 1";

// Filter kategori jika ada
if (!empty($kategori)) {
    $sql .= " AND kategori = '" . $conn->real_escape_string($kategori) . "'";
}

// Pencarian nama/deskripsi
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql .= " AND (nama LIKE '%$search%')";
}

$result = $conn->query($sql);

if (!$result) {
    die("Query error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Daftar Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
  <div class="container">
    <p class="text-center mb-4">
      <a href="form.php" class="btn btn-primary">Tambah Produk Baru</a>
      <a href="kelola.php" class="btn btn-secondary">Kelola Produk</a>
    </p>

    <form method="GET" class="row g-2 mb-4">
  <div class="col-md-4">
    <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?= htmlspecialchars($search) ?>">
  </div>
  <div class="col-md-4">
    <select name="kategori" class="form-select" onchange="this.form.submit()">
      <option value="">Semua Kategori</option>
      <option value="Komputer & Aksesoris" <?= $kategori == 'Komputer & Aksesoris' ? 'selected' : '' ?>>Komputer & Aksesoris</option>
      <option value="Fashion" <?= $kategori == 'Fashion' ? 'selected' : '' ?>>Fashion</option>
      <option value="Elektronik" <?= $kategori == 'Elektronik' ? 'selected' : '' ?>>Elektronik</option>
    </select>
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-primary w-100">Cari</button>
  </div>
</form>

    <h2 class="mb-4">Daftar Produk</h2>
    <div class="row">
      <?php 
      if (isset($_GET['kategori']) && $_GET['kategori'] != '') {
        $kategori = $conn->real_escape_string($_GET['kategori']);
        $sql = "SELECT * FROM produk WHERE kategori = '$kategori'";
        $result = $conn->query($sql);
      }
      
      while ($row = $result->fetch_assoc()): 
      ?>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="uploads/<?= $row['gambar'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
            <div class="card-body">
              <p class="card-text"><strong>Kategori:</strong> <?= $row['kategori'] ?></p>
              <h5 class="card-title"><?= $row['nama'] ?></h5>
              <h6 class="card-subtitle mb-2 text-muted">Rp<?= number_format($row['harga']) ?></h6>
              <p class="card-text"><?= $row['deskripsi'] ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
