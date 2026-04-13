<?php
include '../../../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// cek username sudah ada atau belum
$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

if (mysqli_num_rows($cek) > 0) {
    header("Location: signup.php?error=Username sudah digunakan!");
    exit;
}

// default role = user
$role_id = 2;

// hash password (WAJIB)
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// insert ke database
$query = mysqli_query($koneksi, "INSERT INTO users (username, password, role_id) 
VALUES ('$username', '$passwordHash', '$role_id')");

if ($query) {
    header("Location: signup.php?success=1");
    exit;
} else {
    die("Error: " . mysqli_error($koneksi));
}
?>