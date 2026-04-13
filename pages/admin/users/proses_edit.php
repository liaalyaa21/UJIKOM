<?php
include '../../../config/koneksi.php';

$id       = $_POST['id'];
$username = $_POST['username'];
$role_id  = $_POST['role_id'];

mysqli_query($koneksi, "UPDATE users SET 
username='$username',
role_id='$role_id'
WHERE id='$id'");

header("Location: users.php?status=edit");