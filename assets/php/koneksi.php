<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "loginsignup";

// Membuat koneksi menggunakan try-catch untuk menangkap error
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Optional: Set charset ke utf8 agar aman untuk input data berbahasa non-latin
$conn->set_charset("utf8");
