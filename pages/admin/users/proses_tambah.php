<?php
include '../../../config/koneksi.php';

// ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];
$role_id  = $_POST['role_id'];

// validasi sederhana
if ($username == '' || $password == '' || $role_id == '') {
    header("Location: users.php?status=kosong");
    exit;
}

// hash password (WAJIB)
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// insert ke database
$query = mysqli_query($koneksi, "INSERT INTO users (username, password, role_id) 
VALUES ('$username', '$passwordHash', '$role_id')");

// redirect
if ($query) {
    header("Location: users.php?status=sukses");
} else {
    header("Location: users.php?status=gagal");
}
exit;