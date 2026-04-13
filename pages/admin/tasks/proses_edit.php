<?php
include '../../../config/koneksi.php';

// ambil data
$id          = $_POST['id'];
$title       = $_POST['title'];
$description = $_POST['description'];
$deadline    = $_POST['deadline'];
$user_id     = $_POST['user_id'];
$status      = $_POST['status'];

// cek apakah upload file baru
if (!empty($_FILES['attachment']['name'])) {

    $fileName = $_FILES['attachment']['name'];
    $tmp      = $_FILES['attachment']['tmp_name'];

    // folder upload
    $path = "../../../assets/upload/" . $fileName;

    move_uploaded_file($tmp, $path);

    // update + file
    $query = mysqli_query($koneksi, "UPDATE tasks SET
        title='$title',
        description='$description',
        deadline='$deadline',
        user_id='$user_id',
        status='$status',
        attachment='$fileName'
        WHERE id='$id'
    ");

} else {

    // update tanpa ubah file
    $query = mysqli_query($koneksi, "UPDATE tasks SET
        title='$title',
        description='$description',
        deadline='$deadline',
        user_id='$user_id',
        status='$status'
        WHERE id='$id'
    ");
}

// redirect
if ($query) {
    header("Location: tasks.php?status=edit");
} else {
    header("Location: tasks.php?status=gagal");
}