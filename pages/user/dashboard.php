<?php
session_start();
include '../../config/koneksi.php';

// cek login
if (!isset($_SESSION['user'])) {
    hheader("Location: /taskhub/pages/auth/login/login.php");
    exit;
}

// cek role user
if ($_SESSION['role'] != 2) {
    header("Location: /taskhub/pages/auth/login/login.php");
    exit;
}

$username = $_SESSION['user'];

// ambil user id
$getUser = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$dataUser = mysqli_fetch_assoc($getUser);
$user_id = $dataUser['id'];

// ambil task per status (kanban)
$open = mysqli_query($koneksi, "SELECT * FROM tasks WHERE user_id='$user_id' AND status='open'");
$progress = mysqli_query($koneksi, "SELECT * FROM tasks WHERE user_id='$user_id' AND status='in_progress'");
$done = mysqli_query($koneksi, "SELECT * FROM tasks WHERE user_id='$user_id' AND status='done'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User</title>
    <link rel="stylesheet" href="/taskhub/assets/css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <h2>Task<span>Hub</span></h2>
    </div>
    <div class="nav-right">
        <!-- USER -->
        <span class="user-name">
            <i class="fa-regular fa-user"></i>
            Halo <?= $username ?> |
        </span>
        <a href="#" onclick="confirmLogout()">Logout</a>
    </div>
</nav>

<div class="container">
    <div class="kanban">
        <!-- OPEN -->
        <div class="column">
            <div class="column-header open-header">
                Open (<?= mysqli_num_rows($open); ?>)
            </div>

            <?php while ($row = mysqli_fetch_assoc($open)) { ?>
                <div class="task-card">
                    <div class="card-top">
                        <h4><?= htmlspecialchars($row['title']); ?></h4>
                    </div>

                    <div class="card-body">
                        <p>📅 <?= $row['deadline']; ?></p>
                    </div>

                    <div class="card-footer">
                        <button class="btn detail" onclick="openDetailModal(
                            '<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($row['description'], ENT_QUOTES) ?>',
                            '<?= $row['deadline'] ?>',
                            '<?= $row['status'] ?>',
                            '<?= htmlspecialchars($row['attachment'], ENT_QUOTES) ?>' )">
                            Detail
                        </button>
                        <button class="btn edit" onclick="mulaiTask(<?= $row['id'] ?>)">
                            Kerjakan
                        </button>
                    </div>
                </div>
            <?php } ?>

            <?php if (mysqli_num_rows($open) == 0) echo "<div class='empty'>Tidak ada tugas</div>"; ?>
        </div>


        <!-- PROGRESS -->
        <div class="column">
            <div class="column-header progress-header">
                Progress (<?= mysqli_num_rows($progress); ?>)
            </div>

            <?php while ($row = mysqli_fetch_assoc($progress)) { ?>
                <div class="task-card">
                    <div class="card-top">
                        <h4><?= htmlspecialchars($row['title']); ?></h4>
                    </div>

                    <div class="card-body">
                        <p>📅 <?= $row['deadline']; ?></p>
                    </div>

                    <div class="card-footer">
                        <button class="btn detail" onclick="openDetailModal(
                            '<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($row['description'], ENT_QUOTES) ?>',
                            '<?= $row['deadline'] ?>',
                            '<?= $row['status'] ?>',
                            '<?= htmlspecialchars($row['attachment'], ENT_QUOTES) ?>' )">
                            Detail
                        </button>
                        <button class="btn edit"onclick="openEditModal(
                            <?= $row['id'] ?>,
                            '<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($row['description'], ENT_QUOTES) ?>',
                            '<?= $row['deadline'] ?>',
                            '<?= $row['status'] ?>'
                        )">
                        Edit
                        </button>
                    </div>
                </div>
            <?php } ?>

            <?php if (mysqli_num_rows($progress) == 0) echo "<div class='empty'>Tidak ada progress</div>"; ?>
        </div>


        <!-- DONE -->
        <div class="column">
            <div class="column-header done-header">
                Done (<?= mysqli_num_rows($done); ?>)
            </div>

            <?php while ($row = mysqli_fetch_assoc($done)) { ?>
                <div class="task-card">
                    <div class="card-top">
                        <h4><?= htmlspecialchars($row['title']); ?></h4>
                    </div>

                    <div class="card-body">
                        <p>📅 <?= $row['deadline']; ?></p>
                    </div>

                    <div class="card-footer">
                        <button class="btn detail" onclick="openDetailModal(
                            '<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($row['description'], ENT_QUOTES) ?>',
                            '<?= $row['deadline'] ?>',
                            '<?= $row['status'] ?>',
                            '<?= htmlspecialchars($row['attachment'], ENT_QUOTES) ?>' )">
                            Detail
                        </button>
                    </div>
                </div>
            <?php } ?>

            <?php if (mysqli_num_rows($done) == 0) echo "<div class='empty'>Belum ada yang selesai 🎉</div>"; ?>
        </div>
    </div>
</div>

<!-- MODAL -->
<?php include 'modal.php'; ?>

<script>
    const statusUpdate = "<?= $_GET['status'] ?? '' ?>";
</script

<!-- JS -->
<script src="../../assets/js/user.js"></script>


</body>
</html>