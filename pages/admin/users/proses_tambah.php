<?php
include '../../../config/koneksi.php';

// ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];
$role_id  = $_POST['role_id'];

// validasi kosong
if ($username == '' || $password == '' || $role_id == '') {
    header("Location: users.php?status=kosong");
    exit;
}

// 🔥 CEK USERNAME SUDAH ADA ATAU BELUM
$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

if (mysqli_num_rows($cek) > 0) {
    // ❌ username sudah dipakai
    header("Location: users.php?status=duplikat");
    exit;
}

// hash password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// insert ke database
$query = mysqli_query($koneksi, "INSERT INTO users (username, password, role_id) 
VALUES ('$username', '$passwordHash', '$role_id')");

// redirect
if ($query) {
    header("Location: users.php?status=add");
} else {
    header("Location: users.php?status=gagal");
}
exit;
?>