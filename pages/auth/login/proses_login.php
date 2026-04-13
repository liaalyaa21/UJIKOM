<?php
session_start();
include '../../../config/koneksi.php';

// ambil input
$username = $_POST['username'];
$password = $_POST['password'];

// cek ke database
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

// cek data ada atau tidak
if ($data) {

    // ✅ cek password HASH
    if (password_verify($password, $data['password'])) {

        // simpan session
        $_SESSION['user'] = $data['username'];
        $_SESSION['role'] = $data['role_id'];

        // redirect sesuai role
        if ($data['role_id'] == 1) {
            header("Location: /taskhub/pages/admin/dashboard.php");
        } else {
            header("Location: /taskhub/pages/user/dashboard.php");
        }
        exit;

    } else {
        header("Location: login.php?error=Password salah!");
        exit;
    }

} else {
    header("Location: login.php?error=Username tidak ditemukan!");
    exit;
}
?>