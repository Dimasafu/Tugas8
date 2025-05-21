<?php

// deklarasi variabel koneksi
$host = "localhost";
$username = "root";
$password = "";
$database = "tugas7";
$port = "3308";

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "tugas7","3308");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

//close koneksi
function closeConnection($conn) {
       mysqli_close($conn);
    }

?>