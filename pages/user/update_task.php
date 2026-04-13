<?php
include '../../config/koneksi.php';

$id = $_POST['id'];
$title = $_POST['title'];
$desc = $_POST['description'];
$deadline = $_POST['deadline'];
$status = $_POST['status'];

// upload file
if (!empty($_FILES['attachment']['name'])) {

    $file = $_FILES['attachment']['name'];
    $tmp = $_FILES['attachment']['tmp_name'];

    move_uploaded_file($tmp, "../../assets/upload/" . $file);

    $query = mysqli_query($koneksi, "
        UPDATE tasks SET
        title='$title',
        description='$desc',
        deadline='$deadline',
        status='$status',
        attachment='$file'
        WHERE id=$id
    ");

} else {

    $query = mysqli_query($koneksi, "
        UPDATE tasks SET
        title='$title',
        description='$desc',
        deadline='$deadline',
        status='$status'
        WHERE id=$id
    ");
}

// 🔥 redirect + status
if ($query) {
    header("Location: dashboard.php?status=edit");
} else {
    header("Location: dashboard.php?status=gagal");
}
exit;