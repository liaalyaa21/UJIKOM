<?php
include '../../../config/koneksi.php';

$id = $_GET['id'];

// ambil data dulu (buat hapus file)
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT attachment FROM tasks WHERE id='$id'"));

// hapus file kalau ada
if ($data && $data['attachment']) {
    $filePath = "../../../assets/upload/" . $data['attachment'];

    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

// hapus data
$query = mysqli_query($koneksi, "DELETE FROM tasks WHERE id='$id'");

// redirect
if ($query) {
    header("Location: tasks.php?status=delete");
} else {
    header("Location: tasks.php?status=gagal");
}