<?php
session_start(); // Memulai sesi

// Hapus semua variabel sesi
$_SESSION = array();

// Jika Anda ingin menghancurkan sesi secara permanen, hapus cookie sesi
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Hancurkan sesi
session_destroy();

// Arahkan pengguna kembali ke halaman login
header("Location: ../../index.php");
exit;
