<?php
session_start();
$page = 'dashboard';
include '../../config/koneksi.php';

// cek login & admin
if (!isset($_SESSION['user']) || $_SESSION['role'] != 1) {
    header("Location: /taskhub/pages/auth/login/login.php");
    exit;
}

$nama = $_SESSION['user'];
$inisial = strtoupper(substr($nama, 0, 1));

// ambil user untuk dropdown/modal
$users = mysqli_query($koneksi, "SELECT id, username FROM users");

// statistik
$totalUsers = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users"))['total'];
$totalTasks = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tasks"))['total'];
$open       = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tasks WHERE status='open'"))['total'];
$progress   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tasks WHERE status='in_progress'"))['total'];
$done       = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tasks WHERE status='done'"))['total'];

// ambil data task + user
$tasks = mysqli_query($koneksi, "
    SELECT tasks.*, users.username 
    FROM tasks 
    LEFT JOIN users ON tasks.user_id = users.id
    ORDER BY tasks.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .badge.open { color: red; font-weight: bold; }
        .badge.in_progress { color: orange; font-weight: bold; }
        .badge.done { color: green; font-weight: bold; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .table-box {
            margin-top: 20px;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <?php include 'layout/sidebar.php'; ?>

    <div class="main">

        <!-- NAVBAR -->
        <?php include 'layout/navbar.php'; ?>

        <!-- CONTENT -->
        <div class="content">

            <!-- CARD -->
            <div class="cards">
                <div class="card">Total Users<br><h2><?= $totalUsers ?></h2></div>
                <div class="card">Total Task<br><h2><?= $totalTasks ?></h2></div>
                <div class="card">Open<br><h2><?= $open ?></h2></div>
                <div class="card">Progress<br><h2><?= $progress ?></h2></div>
                <div class="card">Done<br><h2><?= $done ?></h2></div>
            </div>

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
                                <i class="fa fa-eye"></i>
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
                                <i class="fa fa-eye"></i>
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
</div>

<!-- MODAL -->
<?php include 'layout/modal.php'; ?>

<!-- JS -->
<script src="../../assets/js/admin.js"></script>

<!-- LOGOUT ALERT -->
<script>
function confirmLogout() {
    Swal.fire({
        title: 'Yakin logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../auth/logout/logout.php';
        }
    });
}
</script>

</body>
</html>