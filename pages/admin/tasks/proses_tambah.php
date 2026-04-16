<?php
include '../../../config/koneksi.php';

// ambil data
$title       = $_POST['title'];
$description = $_POST['description'];
$deadline    = $_POST['deadline'];
$user_id     = $_POST['user_id'];
$status      = $_POST['status'];


// simpan ke database
$query = mysqli_query($koneksi, "INSERT INTO tasks 
(title, description, deadline, user_id, status) 
VALUES 
('$title', '$description', '$deadline', '$user_id', '$status')");

// redirect dengan status
if ($query) {
    header("Location: tasks.php?status=add");
} else {
    header("Location: tasks.php?status=gagal");
}
exit;