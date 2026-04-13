<?php
session_start();
$page = 'users';
include '../../../config/koneksi.php';

// cek login & admin
if (!isset($_SESSION['user']) || $_SESSION['role'] != 1) {
    header("Location: /taskhub/pages/auth/login/login.php");
    exit;
}

// ambil data user
$users = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Users</title>
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <?php include '../layout/sidebar.php'; ?>

    <div class="main">

        <!-- NAVBAR -->
        <?php include '../layout/navbar.php'; ?>

        <!-- CONTENT -->
        <div class="content">

            <div class="table-box">
                <h3>Data Users</h3>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($u = mysqli_fetch_assoc($users)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <td><?= htmlspecialchars($u['username']) ?></td>

                            <td>
                                <?php if ($u['role_id'] == 1) { ?>
                                    <span class="badge done">Admin</span>
                                <?php } else { ?>
                                    <span class="badge open">User</span>
                                <?php } ?>
                            </td>

                            <td>

                                <!-- EDIT -->
                                <button 
                                    class="btn-edit"
                                    onclick="editUser(
                                        <?= $u['id'] ?>,
                                        '<?= htmlspecialchars($u['username'], ENT_QUOTES) ?>',
                                        '<?= $u['role_id'] ?>'
                                    )"
                                >
                                <i class="fas fa-pen-to-square"></i>
                                </button>

                                <!-- DELETE -->
                                <button onclick="deleteUser(<?= $u['id'] ?>)" class="btn-delete">
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
<?php include '../layout/modal.php'; ?>

<!-- JS -->
<script src="../../../assets/js/admin.js"></script>

</body>
</html>