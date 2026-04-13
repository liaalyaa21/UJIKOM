<?php
session_start();
$page ='tasks';
include '../../../config/koneksi.php';

// cek login & admin
if (!isset($_SESSION['user']) || $_SESSION['role'] != 1) {
    header("Location: /taskhub/pages/auth/login/login.php");
    exit;
}

$users = mysqli_query($koneksi, "SELECT * FROM users");

$nama = $_SESSION['user'];
$inisial = strtoupper(substr($nama, 0, 1));

// ambil data task + join user
$tasks = mysqli_query($koneksi, "
    SELECT tasks.*, users.username 
    FROM tasks 
    LEFT JOIN users ON tasks.user_id = users.id
    ORDER BY tasks.id DESC
");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="layout">
        <!-- SIDEBAR -->
        <?php include '../layout/sidebar.php'; ?>

        <div class="main">
            <!-- Navbar -->
            <?php include '../layout/navbar.php'; ?>

        <div class="content">
            <!-- TABLE TASK -->
            <div class="table-box">
                <h3>Task List</h3>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>User</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Lampiran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($t = mysqli_fetch_assoc($tasks)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $t['title'] ?></td>
                            <td><?= $t['username'] ?? '-' ?></td>
                            <td><?= $t['deadline'] ?></td>

                            <td>
                                <span class="badge <?= $t['status'] ?>">
                                    <?= $t['status'] ?>
                                </span>
                            </td>

                            <td>
                                <button onclick="openAttachment('<?= $t['attachment'] ?>')" class="btn-view">
                                <i class="fas fa-eye"></i>
                                </button>

                                <?php $base = "/taskhub/assets/upload/"; ?>

                                <a href="<?= $base . rawurlencode($t['attachment']) ?>"
                                download
                                class="btn-download"
                                title="Download file">
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>

                            <!-- 🔥 ACTION -->
                            <td>
                                <button onclick="viewTask('<?= $t['title'] ?>','<?= $t['description'] ?>','<?= $t['deadline'] ?>','<?= $t['username'] ?>','<?= $t['status'] ?>','<?= $t['attachment'] ?>')" class="btn-view">
                                <i class="fas fa-eye"></i>
                                </button>
                                
                                <button onclick="editTask(<?= $t['id'] ?>, '<?= $t['title'] ?>', '<?= $t['description'] ?>', '<?= $t['deadline'] ?>', '<?= $t['user_id'] ?>', '<?= $t['status'] ?>')" class="btn-edit">
                                <i class="fa-regular fa-pen-to-square"></i>
                                </button>

                                <button onclick="deleteTask(<?= $t['id'] ?>)" class="btn-delete">
                                <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include '../layout/modal.php'; ?> 
    
    <script src="/taskhub/assets/js/admin.js"></script>

</body>
</html>
