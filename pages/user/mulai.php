<?php
include '../../config/koneksi.php';

$id = $_POST['id'];
$status = $_POST['status'];

mysqli_query($koneksi, "
    UPDATE tasks SET status='$status'
    WHERE id=$id
");