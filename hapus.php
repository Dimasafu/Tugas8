<?php
include 'db.php';
$id = $_GET['id'];

// Ambil nama file gambar jika ingin menghapus file juga (opsional)
$query = $conn->query("SELECT gambar FROM produk WHERE id = $id");
$data = $query->fetch_assoc();
if ($data && file_exists("uploads/" . $data['gambar'])) {
  unlink("uploads/" . $data['gambar']); // Hapus file gambar
}

// Hapus dari database
$conn->query("DELETE FROM produk WHERE id = $id");
header("Location: kelola.php");
?>
