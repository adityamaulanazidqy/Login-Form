<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi database sudah diatur

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validasi apakah password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
        exit;
    }

    // Cek apakah email sudah terdaftar
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result) > 0) {
        // Email sudah terdaftar
        echo json_encode(['status' => 'error', 'message' => 'Email already registered']);
    } else {
        // Hash password sebelum menyimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk menyimpan user baru
        $query = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

        if (mysqli_query($conn, $query)) {
            echo json_encode(['status' => 'success', 'message' => 'Account created successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error creating account']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields']);
}
