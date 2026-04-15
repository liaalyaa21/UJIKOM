<?php
include '../../config/koneksi.php';

$id = (int) $_POST['id'];
$status = $_POST['status'];

// ambil data lama
$getTask = mysqli_query($koneksi, "SELECT status, attachment FROM tasks WHERE id=$id");
$old = mysqli_fetch_assoc($getTask);

// ❌ larang progress → open
if ($old['status'] === "in_progress" && $status === "open") {
    header("Location: dashboard.php?status=tidak_boleh_kembali");
    exit;
}

// upload file
$file = $_FILES['attachment']['name'];
$tmp = $_FILES['attachment']['tmp_name'];

move_uploaded_file($tmp, "../../assets/upload/" . $file);

// update
$query = mysqli_query($koneksi, "
    UPDATE tasks SET
    status='$status',
    attachment='$file'
    WHERE id=$id
");

// redirect
if ($query) {
    header("Location: dashboard.php?status=edit");
} else {
    header("Location: dashboard.php?status=gagal");
}
exit;