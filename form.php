<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title mb-4 text-center">Form Tambah Produk</h4>
            <form action="proses.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori Produk</label>
              <select class="form-select" name="kategori" id="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Komputer & Aksesoris">Komputer & Aksesoris</option>
                <option value="Fashion">Fashion</option>
                <option value="Elektronik">Elektronik</option>
              </select>
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="harga" class="form-label">Harga Produk</label>
                <input type="number" name="harga" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
              </div>
              <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Produk</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Bootstrap -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Berhasil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Produk berhasil diinput!
        </div>
        <div class="modal-footer">
          <a href="tampil.php" class="btn btn-success">Lihat Produk</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali ke Form</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Script Bootstrap & Modal Show -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("success") === "1") {
      const successModal = new bootstrap.Modal(document.getElementById("successModal"));
      successModal.show();
      // Hapus param setelah modal muncul
      window.history.replaceState({}, document.title, "form.php");
    }
  </script>
</body>
</html>
