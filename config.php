<?php
// config.php
// Konfigurasi koneksi database
$host     = 'localhost';
$user     = 'root';       // Ganti dengan username database Anda
$password = '';           // Ganti dengan password database Anda
$database = 'nintendo'; // Ganti dengan nama database yang telah dibuat

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>