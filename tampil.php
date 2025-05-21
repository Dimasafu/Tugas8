<?php
include 'db.php';

$sql = "SELECT * FROM produk";
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

    <form method="GET" class="mb-4">
      <div class="row">
        <div class="col-md-4">
          <select name="kategori" class="form-select">
            <option value="">Semua Kategori</option>
            <?php
            $kategori_query = "SELECT DISTINCT kategori FROM produk";
            $kategori_result = $conn->query($kategori_query);
            while ($kat = $kategori_result->fetch_assoc()) {
              $selected = isset($_GET['kategori']) && $_GET['kategori'] == $kat['kategori'] ? 'selected' : '';
              echo "<option value='" . $kat['kategori'] . "' $selected>" . $kat['kategori'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary">Filter</button>
        </div>
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
