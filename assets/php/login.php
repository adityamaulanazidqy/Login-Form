<?php
session_start();
include 'koneksi.php'; // Sesuaikan dengan koneksi database

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Cek apakah email ada di database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Jika berhasil login
            $_SESSION['user_id'] = $user['id'];
            echo json_encode(['status' => 'success']);
        } else {
            // Jika password salah
            echo json_encode(['status' => 'error', 'message' => 'Invalid Password']);
        }
    } else {
        // Jika email tidak ditemukan
        echo json_encode(['status' => 'error', 'message' => 'Email not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in both fields']);
}
