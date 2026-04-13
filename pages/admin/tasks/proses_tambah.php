<?php
include '../../../config/koneksi.php';

// ambil data
$title       = $_POST['title'];
$description = $_POST['description'];
$deadline    = $_POST['deadline'];
$user_id     = $_POST['user_id'];
$status      = $_POST['status'];

// upload file
$attachment = '';
if (isset($_FILES['attachment']) && $_FILES['attachment']['name'] != '') {

    $namaFile = $_FILES['attachment']['name'];
    $tmp      = $_FILES['attachment']['tmp_name'];

    // bikin nama unik
    $attachment = time() . '_' . $namaFile;

    move_uploaded_file($tmp, "../../../assets/upload/" . $attachment);
}

// simpan ke database
$query = mysqli_query($koneksi, "INSERT INTO tasks 
(title, description, deadline, user_id, attachment, status) 
VALUES 
('$title', '$description', '$deadline', '$user_id', '$attachment', '$status')");

// redirect dengan status
if ($query) {
    header("Location: tasks.php?status=add");
} else {
    header("Location: tasks.php?status=gagal");
}
exit;