<?php
include 'db.php';

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$gambar = $_FILES['gambar'];
$kategori = $_POST['kategori'];

if ($nama == "" || $harga == "" || $deskripsi == "" || $gambar['name'] == "" || $kategori == "") {
    die("Semua kolom harus diisi!");
}

$target_dir = "uploads/";
if (!file_exists($target_dir)) mkdir($target_dir);
$gambar_name = time() . "_" . basename($gambar["name"]);
$target_file = $target_dir . $gambar_name;
move_uploaded_file($gambar["tmp_name"], $target_file);

$sql = "INSERT INTO produk (nama, harga, deskripsi, gambar, kategori) VALUES ('$nama', '$harga', '$deskripsi', '$gambar_name', '$kategori')";
$conn->query($sql);
$conn->close();

// Kembali ke form dengan indikator berhasil
header("Location: form.php?success=1");
exit();
?>
